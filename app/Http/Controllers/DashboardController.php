<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('product',  function($product){
                            $product->where('users_id', Auth::user()->id);
                        })
                        ->whereHas('transaction', function($transaction){
                            $transaction->where('transaction_status','SUCCESS');
                        });
        
        $revenue = $transactions->get()->reduce(function($carry, $item){
            return $carry + $item['price'];
        });

        $pendingTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('product',  function($product){
                            $product->where('users_id', Auth::user()->id);
                        })
                        ->whereHas('transaction', function($transaction){
                            $transaction->where('transaction_status','PENDING');
                        });
        $revenuePending =  $pendingTransactions->get()->reduce(function($carry, $item){
            return $carry + $item['price'];
        });

        $customer = User::count();
        return view('pages.dashboard',[
            'transaction_count' => $transactions->count(),
            'trasaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'revenuePending' => $revenuePending,
            'customer' => $customer
        ]);
    }
}
