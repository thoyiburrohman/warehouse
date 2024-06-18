@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Edit NTE')
@section('content')
    <div class="nxl-content">

        <form action="{{ route('nte.update', $nte->id) }}" method="post">
            @csrf
            @method('put')
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <!-- [ page-header ] start -->
                <div class="page-header">
                    <div class="page-header-left d-flex align-items-center">
                        <div class="page-header-title">
                            <h5 class="m-b-10">@yield('title')</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('nte.index') }}">Nte</a></li>
                            <li class="breadcrumb-item">@yield('title')</li>
                        </ul>
                    </div>
                    <div class="page-header-right ms-auto">
                        <button type="submit" class="btn btn-primary rounded-3"><i
                                class="feather-save me-2"></i>Save</button>
                    </div>
                </div>

                <!-- [ page-header ] end -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-lg-6 col-12">
                                        <label for="warehouse_id" class="form-label">Warehouse</label>
                                        <select class="form-control" id="warehouse_id" name="warehouse_id"
                                            data-select2-selector="privacy">
                                            <option data-icon="feather-home" value="">Select...</option>
                                            @foreach ($warehouses as $item)
                                                <option value="{{ $item->id }}" data-icon="feather-user"
                                                    {{ $nte->warehouse_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warehouse_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="asset_nte_id" class="form-label">Type</label>
                                        <select class="form-control" id="asset_nte_id" name="asset_nte_id"
                                            data-select2-selector="status">
                                            <option data-bg="bg-info" value="">Select...</option>
                                            @foreach ($assetNte as $item)
                                                <option value="{{ $item->id }}" data-bg="bg-info"
                                                    {{ $nte->asset_nte_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('asset_nte_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="serial_number" class="form-label">Serial Number</label>
                                        <input type="text" id="serial_number" name="serial_number"
                                            class="form-control @error('serial_number') is-invalid @enderror" placeholder=""
                                            required
                                            value="{{ old('serial_number') ? old('serial_number') : $nte->serial_number }}">
                                        @error('serial_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="owner" class="form-label">Owner</label>
                                        <select class="form-control" id="owner" name="owner"
                                            data-select2-selector="status">
                                            <option data-bg="bg-info" value="">Select...</option>
                                            <option value="EBIS" data-bg="bg-info"
                                                {{ $nte->owner == 'EBIS' ? 'selected' : '' }}>
                                                EBIS
                                            </option>
                                            <option value="TSEL" data-bg="bg-info"
                                                {{ $nte->owner == 'TSEL' ? 'selected' : '' }}>
                                                TSEL
                                            </option>
                                            <option value="telkom akses" data-bg="bg-info"
                                                {{ $nte->owner == 'telkom akses' ? 'selected' : '' }}>
                                                Telkom Akses
                                            </option>
                                            @error('owner')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- [ Main Content ] end -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2-active.min.js') }}"></script>
@endpush
