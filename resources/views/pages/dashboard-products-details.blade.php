@extends('layouts.dashboard')
@section('title')
 Store-Dashboard Product Detail
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
                  <h2 class="dashboard-title">Shirup Marzan</h2>
                  <p class="dashboard-subtitle">Product Details</p>
                </div>
                <div class="dashboard-content">
                  <div class="row">
                    <div class="col-12">
                      @if($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error )
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                      <form action="{{ route('dashboard-product-update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Product Name</label>
                                  <input
                                    title="product name"
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    aria-describedby="product name"
                                    value="{{ $product->name }}"
                                    autofocus
                                  />
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Price</label>
                                  <input
                                    title="price"
                                    name="price"
                                    type="number"
                                    class="form-control"
                                    aria-describedby="price"
                                    value="{{ $product->price }}"
                                    autofocus
                                  />
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>category</label>
                                  <select
                                    name="categories_id"
                                    class="form-control"
                                    title="category"
                                  >
                                  <option value="{{ $product->categories_id }}">{{ $product->category->name }}</option>
                                  @foreach ( $categories as $category )
                                  <option value="{{$category->id}}"> {{$category->name}} </option> 
                                  @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Description</label>
                                  <textarea
                                    class="form-control"
                                    placeholder="type here"
                                    name="description"
                                    id="editor"
                                  >{!! $product->description !!}</textarea>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col text-right">
                                <button type="submit" class="mt-4 w-100 btn btn-success btn-block">
                                  Save Now
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                           @foreach ($product->galleries as $gallery )
                           <div class="col-md-4 col-6">
                            
                            <div class="gallery-container mb-2">
                              <img
                                src="{{ Storage::url($gallery->photos) }}"
                                alt=""
                                class="rounded-2"
                                style="max-height: 150px;"
                              />
                              <a href="{{ route('dashboard-product-gallery-delete', $gallery->id) }}" class="delete-gallery">
                                <img src="/images/icon-delete.svg" alt="" />
                              </a>
                            </div>
                          </div>
                           @endforeach
                            <div class="col-12">
                             <form action="{{ route('dashboard-product-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="products_id" value="{{ $product->id }}">
                              <input
                              type="file"
                              name="photos"
                              id="file"
                              style="display: none"
                              onchange="form.submit()"
                            />
                            <button
                              type="button"
                              class="mt-2 btn btn-secondary btn-block"
                              onclick="thisFileUpload()"
                            >
                              Add Photo
                            </button>
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
          </div>
@endsection
@push('addon-script')
  <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor.create(document.querySelector("#editor"))
      .then((editor) => {
        console.log(editor);
      })
      .catch((error) => {
        console.error(error);
      });
  </script>
  <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
@endpush
