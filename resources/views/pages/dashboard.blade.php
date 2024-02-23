@extends('layouts.dashboard')
@section('title')
 Store-Dashboard
@endsection

@section('content')   
    <!-- section content -->
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <div class="dashboard-title">
            <h2 class="dashboard-title fw-bold">Dashboard</h2>
            <p class="dashboard-subtitle">
            Look what you have made today
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
            <div class="col-md-3">
                <div class="card mb-2">
                <div class="card-body">
                    <div class="dashboard-card-title mb-2"><span class="me-2 p-1 rounded-5 text-white" style="background-color: #54b862; "><i class="bi bi-currency-dollar"></i></span>Revenue</div>
                    <div class="dashboard-card-subtitle">Rp.{{ number_format($revenue ?? 0) }}</div>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-2">
                <div class="card-body">
                    <div class="dashboard-card-title mb-2"><span class="me-2 p-1 rounded-5 text-white" style="background-color: #54b862; "><i class="bi bi-currency-dollar"></i></span>Pending Transaction</div>
                    <div class="dashboard-card-subtitle">Rp.{{ number_format($revenuePending ?? 0) }}</div>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-2">
                <div class="card-body">
                    <div class="dashboard-card-title mb-2"><span class="me-2 p-1 rounded-5 text-white" style="background-color: #54b862; "><i class="bi bi-people-fill"></i></span>Customer</div>
                    <div class="dashboard-card-subtitle">{{ number_format($customer) }}</div>
                </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-2">
                <div class="card-body">
                    <div class="dashboard-card-title mb-2"><span class="me-2 p-1 rounded-5 text-white" style="background-color: #54b862; "><i class="bi bi-send-plus"></i></span>Transactions</div>
                    <div class="dashboard-card-subtitle">{{ $transaction_count }}</div>
                </div>
                </div>
            </div>
            </div>
            <div class="row mt-3">
            <div class="col-12 mt-2">
                <h5 class="mb-3">Recent Transactions</h5>
                @foreach ($trasaction_data as $transaction)
                <a
                href="{{ route('dashboard-transaction-details',$transaction->id) }}"
                class="card card-list"
                >
                <div class="card-body">
                    <div class="row align-items-center">
                    <div class="col-md-2 justify-content-center">
                        <img
                        @if ($transaction->product && $transaction->product->galleries->first())
                            src="{{ Storage::url($transaction->product->galleries->first()->photos) }}"
                        @else
                            src="/images/noimage.png"
                        @endif
                        class="w-75 rounded-2"
                        alt=""
                        />
                    </div>
                    <div class="col-md-3 ">{{ $transaction->product->name ?? 'no name'}}</div>
                    <div class="col-md-3 ">{{ $transaction->transaction->user->name ?? 'no name'}}</div>
                    <div class="col-md-3 ">{{ $transaction->created_at }}</div>
                    <div class="col-md-1 d-md-block ">
                        <img
                        src="./images/dashboard-arrow-right.svg"
                        alt="arrow"
                        />
                    </div>
                    </div>
                </div>
                </a>
                @endforeach
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection

