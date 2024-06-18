@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Create Technician')
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
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
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
                            <form action="{{ route('technician.store') }}" method="post">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="John Doe"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" id="nik" name="nik"
                                            class="form-control @error('nik') is-invalid @enderror"
                                            placeholder="johndoe@mail.com" value="{{ old('nik') }}">
                                        @error('nik')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg 6 col-12">
                                        <label for="division" class="form-label">Divisi</label>
                                        <select class="form-control" id="division" name="division"
                                            data-select2-selector="status">
                                            <option value="psb bges" data-bg="bg-info"
                                                {{ old('division') == 'psb bges' ? 'selected' : '' }}>
                                                PSB BGES
                                            </option>
                                            <option value="psb cons" data-bg="bg-info"
                                                {{ old('division') == 'psb cons' ? 'selected' : '' }}>
                                                PSB CONS
                                            </option>
                                            <option value="ass cons" data-bg="bg-info"
                                                {{ old('division') == 'ass cons' ? 'selected' : '' }}>
                                                ASS CONS
                                            </option>
                                            <option value="ass bges" data-bg="bg-info"
                                                {{ old('division') == 'ass bges' ? 'selected' : '' }}>
                                                ASS BGES
                                            </option>
                                            <option value="migrasi" data-bg="bg-info"
                                                {{ old('division') == 'migrasi' ? 'selected' : '' }}>
                                                MIGRASI
                                            </option>
                                        </select>
                                        @error('division')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg 6 col-12">
                                        <label for="mitra_id" class="form-label">Mitra</label>
                                        <select class="form-control" id="mitra_id" name="mitra_id"
                                            data-select2-selector="privacy">
                                            @foreach ($mitra as $item)
                                                <option value="{{ $item->id }}" data-icon="feather-home"
                                                    {{ old('mitra_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('mitra_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="telegram" class="form-label">Telegram Id</label>
                                        <input type="text" id="telegram" name="telegram"
                                            class="form-control @error('telegram') is-invalid @enderror"
                                            value="{{ old('telegram') }}">
                                        @error('telegram')
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
@endpush
