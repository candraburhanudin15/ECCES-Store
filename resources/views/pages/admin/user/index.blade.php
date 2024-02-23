@extends('layouts.admin')
@section('title')
 User
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
            <h2 class="dashboard-title">User</h2>
            <p class="dashboard-subtitle">
            List of Users
            </p>
        </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="card w-100 m-2 ">
                        <div class="card-body">
                            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">
                                + Tambah Kategori Baru
                            </a>
                            <div class="table table-responsive">
                                <table class="table-hover scroll-horizontal-vertical w-100 table-striped" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>email</th>
                                            <th>roles</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
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
    <script>
        var datatable = $('#crudTable').DataTable({
            processing:true,
            serverSide: true,
            ordering:true,
            ajax:{
                url: "{!! url()->current() !!}",
            },
            columns:[
                {data:'id', name:'id'},
                {data:'name', name:'name'},
                {data:'email', name: 'email'},
                {data:'roles', name:'roles'},
                {
                    data: 'action', 
                    name: 'action',
                    orderable: false,
                    searchable : false,
                    width: '15%'
                },
            ]

        })
    </script>
@endpush