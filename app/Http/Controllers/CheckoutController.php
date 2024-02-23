<?php
namespace App\Http\Controllers;
use Exception;
use Midtrans\Snap;
use Midtrans\Notification;
use Midtrans\Config;
use App\Models\Cart;
use App\Models\Transaction;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        //save users data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // proses checkout
        $code = "STORE-" . mt_rand(00000,99999);
        $carts = Cart::with(['product', 'user'])
        ->where('users_id', Auth::user()->id)
        ->get();
        
        //transaction create
        $transaction = Transaction::create([
            'users_id' => $user->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code'=>$code,
        ]);

        //delete_cart_data
        Cart::with(['product','user'])
        ->where('users_id',Auth::user()->id)->delete();


        //save transaction_detail   
        foreach ($carts as $cart){
            $trx = "STORE-" . mt_rand(00000,99999);
            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status' => 'PENDING',
                'resi' => '',
                'code'=>$trx,
            ]);
        }
        //midtrans configuration
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');    
        Config::$isSanitized = config('services.midtrans.isSanitized');  
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = array(
            'transaction_details' => array(
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),
            'enabled_payments' => array('gopay','bank_transfer'),
            'vtweb' => []
        );
        $snapToken = '';
        try {
            // Get Snap Payment Page URL
            $snapToken = Snap::getSnapToken($midtrans);

            //Redirect to Snap Payment Page
            return view('pages.checkout', [
                'carts' => $carts,
                'snapToken' => $snapToken,
                'transaction' => $transaction
            ]);
            
          }
        catch (Exception $e) {
            echo 'Terjadi Kesalahan' . $e->getMessage();
          }
        

    }
    


    public function callback(Request $request)
    {
    //set konfigurasi midtrans
    $serverKey = config('services.midtrans.serverKey');
    $hashed = hash("sha512",$request->signature_key.$request->order_id.$request->status_code.$request->payment_type.$request->fraud_status.$request->gross_amount.$serverKey);


    // Cari transaksi berdasarkan ID
    $transaction = Transaction::where('code', $request->order_id)->first();

   // Handle notification status
   if ($transaction !== null) {
    if ($request->transaction_status == 'capture') {
        if ($request->payment_type == 'credit_card') {
            if ( $request->fraud_status == 'challenge') {
                $transaction->update(['transaction_status' => 'PENDING']);
            } else {
                $transaction->update(['transaction_status' => 'SUCCESS']);
            }
        }
    } elseif ($request->transaction_status == 'settlement') {
        $transaction->update(['transaction_status' => 'SUCCESS']);
    } elseif ($request->transaction_status == 'pending') {
        $transaction->update(['transaction_status' => 'PENDING']);
    } elseif ($request->transaction_status == 'deny' || $request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
        $transaction->update(['transaction_status' => 'CANCELLED']);
    }
        // Simpan transaksi
        $transaction->save();

        return response()->json(['status' => 'ok'], 200);
    }
     else {
        Log::error('Hash tidak cocok untuk order ID: ' . $request->order_id);
        return response()->json(['error' => "Transaction code not found"], 400);
    }

}
}