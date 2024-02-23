@extends('layouts.dashboard')
@section('title')
 Store-Dashboard Transaction Details
@endsection

@section('content')   
<!-- page content -->
<div id="page-content-wrapper">
    <!-- section content -->
    <div
        class="section-content section-dashboard-home"
        data-aos="fade-up"
    >
        <div class="container-fluid">
        <div class="dashboard-heading">
            <div class="dashboard-title">
            <h2 class="dashboard-title">{{  $transaction->code }}</h2>
            <p class="dashboard-subtitle">Transactions Details</p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                        <img
                        @if ($transaction->product && $transaction->product->galleries->first())
                            src="{{ Storage::url($transaction->product->galleries->first()->photos) }}"
                        @else
                            src="/images/noimage.png"
                        @endif
                            class="img-products-transactions-details mb-3 rounded-2 w-100"
                            alt=""
                        />
                        </div>
                        <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12 col-md-6">
                            <div class="product-title mb-2">
                               Customer Name
                            </div>
                            <div class="product-subtitle">
                                {{ $transaction->transaction->user->name }}
                            </div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title mb-1">
                                Product Name
                            </div>
                            <div class="product-subtitle">
                                {{ $transaction->product->name }}
                            </div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title mb-1">
                                Date of Transaction
                            </div>
                            <div class="product-subtitle">
                                {{ $transaction->created_at }}
                            </div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title mb-1">
                                payment Status
                            </div>
                            <div class="product-subtitle text-success">
                                {{ $transaction->transaction->transaction_status }}
                            </div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title mb-1">
                                Total Amount
                            </div>
                            <div class="product-subtitle">RP. {{ number_format($transaction->transaction->total_price) }}</div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title mb-1">Mobile</div>
                            <div class="product-subtitle">
                                {{ $transaction->transaction->user->phone_number }}
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <form action="{{ route('dashboard-transaction-update',$transaction->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mt-4">
                            <div class="col-12">
                                <h5 class="product-subtitle">
                                Shipping Information
                                </h5>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="col-12 col-md-8">
                                <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Address 1
                                    </div>
                                    <div class="product-subtitle">
                                    {{ $transaction->transaction->user->address_one }}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Adrres 2
                                    </div>
                                    <div class="product-subtitle">
                                    {{ $transaction->transaction->user->address_two }}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Province
                                    </div>
                                    <div class="product-subtitle">
                                        {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name }}
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Regencie
                                    </div>
                                    <div class="product-subtitle">{{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name }}</div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Postal Code
                                    </div>
                                    <div class="product-subtitle">{{ $transaction->transaction->user->zip_code }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Country
                                    </div>
                                    <div class="product-subtitle">
                                        {{ $transaction->transaction->user->country }}
                                    </div>
                                </div>
                                @if ($transaction->product->users_id === Auth::user()->id)
                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Shipping Status
                                    </div>
                                    <select
                                    name="shipping_status"
                                    id="status"
                                    class="form-control"
                                    v-model="status"
                                    title="status"
                                    >
                                    <option value="PENDING">Pending</option>
                                    <option value="SHIPPING">Shipping</option>
                                    <option value="SUCCESS">Success</option>
                                    </select>
                                </div>
                                <template v-if="status == 'SHIPPING'">
                                    <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="product-title">
                                            Input Resi
                                        </div>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="resi"
                                            v-model="resi"
                                        />
                                        </div>
                                        <div class="col-md-6">
                                        <button
                                            class="btn btn-block mt-4 btn-update-resi" type="submit"
                                        >
                                            Update Resi
                                        </button>
                                        </div>
                                    </div>
                                    </div>
                                </template>
                                @else
                                <div class="col-12 col-md-6">
                                    <div class="product-title mb-1">
                                    Resi
                                    </div>
                                
                                <div v-if="resi" class="product-subtitle text-success" name="resi" v-text="resi"></div>
                                <div v-else class="product-subtitle text-muted">Tracking number will be uploaded soon</div>
                                </div>
                                @endif
                                </div>

                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row mt-4">
                                <div class="col-12 text-right" :class="{ 'd-none': {{ $transaction->product->users_id }} !== {{ Auth::user()->id }} }">
                                <button
                                    type="submit"
                                    class="btn btn-success btn-save mb-3"
                                >
                                    Update Status
                                </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('addon-script')
<script src="/vendor/vue/vue.js">
</script>
<script>
    let transactionDetails = new Vue({
      el: "#transactionDetails",
      data: {
        status: "{{ $transaction->shipping_status }}",
        resi: "{{ $transaction->resi }}",
      },
    });
</script>
@endpush
