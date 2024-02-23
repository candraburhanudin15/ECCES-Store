@extends('layouts.dashboard')
@section('title')
 Store-Settings
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
            <h2 class="dashboard-title">Store Settings</h2>
            <p class="dashboard-subtitle">Make store that profitable</p>
            </div>
            <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                <form action="{{ route('dashboard-settings-redirect','dashboard-settings-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Nama Toko</label>
                            <input
                                name="store_name"
                                title="nama Toko"
                                type="text"
                                class="form-control"
                                aria-describedby="namatoko"
                                value="{{ $user->store_name }}"
                                autofocus
                            />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Kategori</label>
                            <select
                            name="category"
                            class="form-control"
                            title="category"
                            >
                            @foreach ($categories as $category)
                            <option value="{{ $user->categories_id }}">Tidak diganti</option>
                            <option value="{{ $category->id }}">
                            {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                            <label>Store Status</label>
                            <p class="text-muted">
                                Apakah anda juga ingin membuka toko ?
                            </p>
                            <div
                                class="custom-control custom-radio custom-control-inline"
                            >
                                <input
                                type="radio"
                                class="custom-control-input"
                                name="store_status"
                                id="openStoreTrue"
                                v-model="is_store_open"
                                value="1"
                                {{ $user->store_status == 1 ? 'checked' : '' }}
                                />
                                <label
                                for="openStoreTrue"
                                class="custom-control-label"
                                >Buka</label
                                >
                            </div>
                            <div
                                class="custom-control custom-radio custom-control-inline"
                            >
                                <input
                                type="radio"
                                class="custom-control-input"
                                name="is_store_open"
                                id="openStoreFalse"
                                v-model="is_store_open"
                                :value="0"
                                {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}
                                />
                                <label
                                for="openStoreFalse"
                                class="custom-control-label"
                                >Sementara Tutup</label
                                >
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col text-right">
                            <button class="btn btn-success btn-save">
                            Save Now
                            </button>
                        </div>
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