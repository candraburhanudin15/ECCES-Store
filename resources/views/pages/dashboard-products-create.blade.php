@extends('layouts.dashboard')
@section('title')
 Store-Dashboard Product Create
@endsection
@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
<div class="container-fluid">
  <div class="dashboard-heading">
    <div class="dashboard-title">
      <h2 class="dashboard-title">Create New Product</h2>
      <p class="dashboard-subtitle">Create your own product</p>
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
          <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="users_id" value="{{ Auth::user()->id }}"/>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input
                        name="name"
                        title="product name"
                        type="text"
                        class="form-control"
                        aria-describedby="product name"    
                        autofocus
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Price</label>
                      <input
                        title="price"
                        type="number"
                        class="form-control"
                        aria-describedby="price"
                        name="price"
                        autofocus
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>category</label>
                      <select name="categories_id" class="form-control">
                        @foreach ( $categories as $category )
                        <option value="{{$category->id}}"> {{$category->name}} </option> 
                        @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea
                        class="form-control"
                        placeholder="type here"
                        name="description"
                        id="editor"
                      ></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label>Thumbnails</label>
                      <div class="form-group">
                        <label for="photo">Foto Produk</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <p class="text-muted">
                      Kamu dapat memilih lebih dari satu file
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button class="btn btn-success btn-block" type="submit">
                      Create Products
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
@endsection
@push('addon-script')
  <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor.create(document.querySelector("#editor"))
      .then((editor) => {
        console.log(editor);
      })
      .catch((error) => {
        console.error(error);
      });
  </script>
@endpush
