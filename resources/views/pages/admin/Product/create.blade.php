@extends('layouts.admin')
@section('title')
 Product
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
            <h2 class="dashboard-title">Product</h2>
            <p class="dashboard-subtitle">
            Create New Product
            </p>
        </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error )
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card w-100 m-2 ">
                            <div class="card-body">
                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Nama Product</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pemilik Produk</label>
                                                <select name="users.id" class="form-control">
                                                    @foreach ( $users as $user )
                                                    <option value="{{$user->id}}"> {{$user->name}} </option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Kategori</label>
                                                <select name="categories.id" class="form-control">
                                                    @foreach ( $categories as $category )
                                                    <option value="{{$category->id}}"> {{$category->name}} </option> 
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="price">Harga Produk</label>
                                                <input type="text" name="price" class="form-control input-harga" required>
                                            </div>
                                        </div>       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="description">Deskripsi Produk</label>
                                                <textarea name="description" id='editor' required> </textarea>
                                            </div>
                                        </div>         
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success" id="saveNowButton"> Save Now</button>
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
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endpush