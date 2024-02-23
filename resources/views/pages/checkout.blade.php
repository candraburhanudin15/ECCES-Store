@extends('layouts.app')
@section('title')
 Store- Checkout Page
@endsection

@section('content')
    @push('prepend-script')
      <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    @endpush
    <!-- Page Content -->
    <div class="page-content page-cart">
    <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
    >
        <div class="container">
        <div class="row">
            <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Cart
                </li>
                </ol>
            </nav>
            </div>
        </div>
        </div>
    </section>
    <section class="store-cart">
        <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive rounded-2">
            <table
                class="table table-borderless table-cart table-striped"
                aria-describedby="Cart"
            >
                <thead class="table-dark text-center align-middle">
                <tr>
                    <th scope="col ">Image</th>
                    <th scope="col ">Name &amp; Seller</th>
                    <th scope="col ">Price</th>
                </tr>
                </thead>
                <tbody>
                    @php $totalPrice = 0 @endphp
                    @foreach ($carts as $cart)
                        <tr class=" text-center">
                            <td style="width: 20%;" class="align-middle">
                                @if($cart->product->galleries->isNotEmpty())
                                  <img
                                    src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                                    alt=""
                                    class="cart-image m-2" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 12px;"
                                  />
                                @else
                                    <img
                                    src="/images/noimage.png"
                                    alt=""
                                    class="cart-image"
                                    />
                                @endif
                            </td>
                              <td style="width: 35%;" class="align-middle">
                                <div class="product-title">{{ $cart->product->name }}</div>
                                <div class="product-subtitle">by {{ $cart->user->store_name }}</div>
                              </td>
                              <td style="width: 35%;" class="align-middle">
                                <div class="product-title">Rp.{{ number_format($cart->product->price) }}</div>
                                <div class="product-subtitle">IDR</div>
                              </td>
                        </tr>
                      @php
                        $totalPrice+= $cart->product->price;
                        //   $price = $cart->product->price * $cart->qty;
                      @endphp  
                    @endforeach
                </tbody>
                
            </table>
            </div>
        </div>
                <button
                    id="pay-button"
                    class="w-100 btn btn-success mt-4 px-4 btn-block  
                    @if($carts->isEmpty())
                        disabled
                    @else
                    @endif"
                >
                    Payment
                </button>
                </div>
            </div>
        <div id="snap-container"></div>
        </div>
    </section>
    </div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
@isset($snapToken)
  <script type="text/javascript">
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){
        /* You may add your own implementation here */
        window.location.href = "{{ route('success') }}";
      },
      onPending: function(result){
        /* You may add your own implementation here */
        alert("wating your payment!"); console.log(result);
      },
      onError: function(result){
        /* You may add your own implementation here */
        alert("payment failed!"); console.log(result);
      },
      onClose: function(){
        /* You may add your own implementation here */
        alert('you closed the popup without finishing the payment');
      }
    })
  });
</script>
@endisset
@endpush


