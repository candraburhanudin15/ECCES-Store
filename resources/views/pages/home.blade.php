@extends('layouts.app')
@section('title')
 Store-Homepage
@endsection

@section('content')   
<div class="page-content page-home">
<!-- Page Content -->
    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img
                            src="/images/banner.jpg"
                            class="d-block w-100"
                            alt="Carousel Image"
                            />
                        </div>
                        <div class="carousel-item">
                            <img
                            src="/images/banner.jpg"
                            class="d-block w-100"
                            alt="Carousel Image"
                            />
                        </div>
                        <div class="carousel-item">
                            <img
                            src="/images/banner.jpg"
                            class="d-block w-100"
                            alt="Carousel Image"
                            />
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                </div>        
            </div>
        </div>
    </section>
    <section class="store-trend-categories">
        <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up">
            <h5>Trend Categories</h5>
            </div>
        </div>
            <div class="row">
               @php $incrementCategory = 0 @endphp
               @forelse ($categories as $category)
                <div
                class="col col-md-3 col-lg-2"
                data-aos="fade-up"
                data-aos-delay="{{ $incrementCategory+=100 }}"
                >
                <a  class="component-categories d-block" href="{{ route('categories-detail', $category->slug) }}">
                    <div class="categories-image text-center">
                    <img
                        src="{{ Storage::url($category->photo) }}"
                        alt="Gadgets Categories"
                        style="width: 70%; "
                        
                    />
                    </div>
                    <p class="categories-text">
                     {{ $category->name }}
                    </p>
                </a>
                </div>
               @empty
                   <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                    No Category Found
                   </div>
               @endforelse
        </div>
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
        <div class="row">
            <div class="col-12" data-aos="fade-up">
            <h5>New Products</h5>
            </div>
        </div>
        <div class="row">
            @php $incrementProduct = 0 
            @endphp
            @forelse ($products as $product )
            <div
            class="col-6 col-md-4 col-lg-3"
            data-aos="fade-up"
            data-aos-delay="{{ $incrementProduct+=100 }}"
            >
            <a class="component-products d-block" href="{{ route('detail', $product->slug) }}">
                <div class="products-thumbnail">
                <div
                    class="products-image"
                    style="
                    @if($product->galleries && $product->galleries->first())
                        background-image: url('{{ Storage::url($product->galleries->first()->photos) }}');
                    @else
                        background-image: url('/images/noimage.png');
                    @endif
                    "
                ></div>
                </div>
                <div class="products-text">
                {{ $product->name }}
                </div>
                <div class="products-price">
                Rp. {{ number_format($product->price ?? 0) }}
                </div>
            </a>
            </div>
            @empty
            <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                No Products Found
               </div>
            @endforelse
         
        </div>
        </div>
    </section>
    </div>
@endsection