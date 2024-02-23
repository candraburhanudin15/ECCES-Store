@extends('layouts.dashboard')
@section('title')
 Store-Dashboard Product
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
        <h2 class="dashboard-title">My Products</h2>
        <p class="dashboard-subtitle">Manage it well and get money</p>
        </div>
        <div class="dashboard-content">
        <div class="row mb-4">
            <div class="col-12">
            <a
                href="{{ route('dashboard-product-create') }}"
                class="btn btn-success btn-save"
            >
                Add New Product
            </a>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
                <a
                    href="{{ route('dashboard-product-details',$product->id) }}"
                    class="card card-dashboard-product d-block"
                >
                    <div class="card-body">
                    <img
                        class="w-100 mb-2"
                        @if($product->galleries && $product->galleries->first())
                            src="{{ Storage::url($product->galleries->first()->photos) }}"
                        @else
                            src="/images/noimage.png"
                        @endif
                        alt="product-image"
                    />
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product-category">{{ $product->category->name}}</div>
                    </div>
                </a>
                </div>
                
            @endforeach
        </div>
        </div>
    </div>
    </div>
</div>
@endsection