@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Create NTE')
@section('content')
    <div class="nxl-content">

        <form action="{{ route('nte.store') }}" method="post">
            @csrf
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
                                                    {{ old('warehouse_id') == $item->id ? 'selected' : '' }}>
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
                                                    {{ old('asset_nte_id') == $item->id ? 'selected' : '' }}>
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
                                            required value="{{ old('serial_number') }}">
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
                                                {{ old('owner') == 'EBIS' ? 'selected' : '' }}>
                                                EBIS
                                            </option>
                                            <option value="TSEL" data-bg="bg-info"
                                                {{ old('owner') == 'TSEL' ? 'selected' : '' }}>
                                                TSEL
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
    <script src="{{ asset('vendors/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.bs5.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2-active.min.js') }}"></script>
    <script src="{{ asset('vendors/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datatable-init.min.js') }}"></script>
    <script>
        $('#to_id').change(function(e) {
            var id = $(this).val();
            $.ajax({
                type: "get",
                url: "/technician/" + id,
                success: function(data) {
                    $('#nik').val(data.nik);
                    $('#divisi').val(data.division);
                    $.ajax({
                        type: "get",
                        url: "/mitra/" + data.mitra_id,
                        success: function(data) {
                            $('#mitra').val(data.name);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var e = document.getElementById("date");
            new Datepicker(e, {
                clearBtn: !0,
                allowOneSidedRange: !0
            });
        });
    </script>
@endpush
