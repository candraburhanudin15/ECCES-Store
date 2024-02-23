@extends('layouts.dashboard')
@section('title')
 Store-Dashboard Transaction
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
            <h2 class="dashboard-title">Transactions</h2>
            <p class="dashboard-subtitle">
            Big result start from the small one
            </p>
        </div>
        <div class="dashboard-content">
    <div class="container col-12 mt-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="sell-tab" data-bs-toggle="tab" data-bs-target="#sellproduct" type="button" role="tab" aria-controls="sellproduct" aria-selected="true">Sell Product</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#buyproduct" type="button" role="tab" aria-controls="buyproduct" aria-selected="false">Buy Product</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="sellproduct" role="tabpanel" aria-labelledby="sellproduct-tab">
            @foreach ($sellTransactions as $selltransaction )
            <a
            href="{{ route('dashboard-transaction-details', $selltransaction->id) }}"
            class="card card-list"
            >
            <div class="card-body">
                <div class="row">
                <div class="col-md-1">
                    <img
                    @if ($selltransaction->product && $selltransaction->product->galleries->first())
                        src="{{ Storage::url($selltransaction->product->galleries->first()->photos) }}"
                    @else
                        src="/images/noimage.png"
                    @endif
                    class="w-75 rounded-2"
                    alt=""
                    />
                </div>
                <div class="col-md-4">{{ $selltransaction->product->name }}</div>
                <div class="col-md-3">{{ $selltransaction->product->user->store_name }}</div>
                <div class="col-md-3">{{ $selltransaction->created_at }}</div>
                <div class="col-md-1 d-md-block">
                    <img
                    src="/images/dashboard-arrow-right.svg"
                    alt="arrow"
                    />
                </div>
                </div>
            </div>
            </a>
            @endforeach
          </div>
          <div class="tab-pane fade" id="buyproduct" role="tabpanel" aria-labelledby="buyproduct-tab">
            @foreach ($buyTransactions as $buytransaction )
            <a
            href="{{ route('dashboard-transaction-details', $buytransaction->id) }}"
            class="card card-list"
            >
            <div class="card-body">
                <div class="row">
                <div class="col-md-1">
                    <img
                    @if ($buytransaction->product && $buytransaction->product->galleries->first())
                    src="{{ Storage::url($buytransaction->product->galleries->first()->photos) }}"
                    @else
                        src="/images/noimage.png"
                    @endif
                    class="w-75 rounded-2"
                    />
                </div>
                <div class="col-md-4">{{ $buytransaction->product->name }}</div>
                <div class="col-md-3">{{ $buytransaction->product->user->store_name }}</div>
                <div class="col-md-3">{{ $buytransaction->created_at }}</div>
                <div class="col-md-1 d-md-block">
                    <img
                    src="/images/dashboard-arrow-right.svg"
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
    </div>


@endsection