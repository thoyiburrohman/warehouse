@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Edit Asset Material')
@section('content')
    <div class="nxl-content">

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">@yield('title')</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('asset-material.index') }}">Asset Material</a>
                        </li>
                        <li class="breadcrumb-item">@yield('title')</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">

                </div>
            </div>

            <!-- [ page-header ] end -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <form action="{{ route('asset-material.update', $assetMaterial->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="code" class="form-label">Id Material</label>
                                        <input type="text" id="code" name="code"
                                            class="form-control @error('code') is-invalid @enderror" placeholder=""
                                            value="{{ old('code') ? old('code') : $assetMaterial->code }}">
                                        @error('code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="name" class="form-label">Nama Material</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') ? old('name') : $assetMaterial->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <select class="form-control" id="satuan" name="satuan"
                                            data-select2-selector="status">
                                            <option data-bg="bg-info" value="">Select...</option>
                                            <option value="m" data-bg="bg-info"
                                                {{ $assetMaterial->satuan == 'm' ? 'selected' : '' }}>
                                                Meter
                                            </option>
                                            <option value="pcs" data-bg="bg-info"
                                                {{ $assetMaterial->satuan == 'pcs' ? 'selected' : '' }}>
                                                Pcs
                                            </option>
                                        </select>
                                        @error('satuan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="segment" class="form-label">Segment</label>
                                        <select class="form-control" id="segment" name="segment"
                                            data-select2-selector="status">
                                            <option data-bg="bg-info" value="">Select...</option>
                                            <option value="PROVISIONING" data-bg="bg-info"
                                                {{ $assetMaterial->segment == 'PROVISIONING' ? 'selected' : '' }}>
                                                Provisioning
                                            </option>
                                            <option value="ASSURANCE" data-bg="bg-info"
                                                {{ $assetMaterial->segment == 'ASSURANCE' ? 'selected' : '' }}>
                                                Assurance
                                            </option>
                                            <option value="KONTRUKSI" data-bg="bg-info"
                                                {{ $assetMaterial->segment == 'KONTRUKSI' ? 'selected' : '' }}>
                                                Kontruksi / Gamas
                                            </option>

                                        </select>
                                        @error('segment')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary"><i
                                        class="feather-save me-2"></i>save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendors/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.bs5.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2-active.min.js') }}"></script>
    <script src="{{ asset('js/customers-init.min.js') }}"></script>
    </script>
@endpush
