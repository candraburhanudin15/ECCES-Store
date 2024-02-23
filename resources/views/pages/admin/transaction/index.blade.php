@extends('layouts.admin')
@section('title')
 Transaction
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
            <h2 class="dashboard-title">Transaction</h2>
            <p class="dashboard-subtitle">
            List of Transactions
            </p>
        </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="card w-100 m-2 ">
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table class="table-hover scroll-horizontal-vertical w-100 table-striped" id="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Dibuat</th>
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
                {data:'user.name', name: 'user.name'},
                {data:'total_price', name: 'total_price'},
                {data:'transaction_status', name:'transaction_status'},
                {data:'created_at', name:'created_at'},
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