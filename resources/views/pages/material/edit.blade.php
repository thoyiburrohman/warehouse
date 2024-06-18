@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Edit Material')
@section('content')
    <div class="nxl-content">

        <form action="{{ route('material.update', $material->id) }}" method="post">
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
                            <li class="breadcrumb-item"><a href="{{ route('material.index') }}">Material</a></li>
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

                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="asset_material_id" class="form-label">Id Material</label>
                                        <select class="form-control" id="asset_material_id" name="asset_material_id"
                                            data-select2-selector="privacy">
                                            <option data-icon="feather-home" value="">Select...</option>
                                            @foreach ($assets as $item)
                                                <option value="{{ $item->id }}" data-icon="feather-user"
                                                    {{ $material->asset_material_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('asset_material_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="name" class="form-label">Nama Material</label>
                                        <input type="text" id="name" class="form-control" readonly
                                            value="{{ $material->assets->name }}">
                                    </div>
                                </div>
                                @if (roleId() != 3)
                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-12">
                                            <label for="warehouse_id" class="form-label">Warehouse</label>
                                            <select class="form-control" id="warehouse_id" name="warehouse_id"
                                                data-select2-selector="privacy">
                                                <option data-icon="feather-home" value="">Select...</option>
                                                @foreach ($warehouses as $item)
                                                    <option value="{{ $item->id }}" data-icon="feather-user"
                                                        {{ $material->warehouse_id == $item->id ? 'selected' : '' }}>
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
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <input type="text" id="satuan" class="form-control" readonly
                                            value="{{ $material->assets->satuan }}">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="quantity" class="form-label">Jumlah</label>
                                        <input type="number" id="quantity" name="quantity"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            value="{{ old('quantity') ? old('quantity') : $material->quantity }}">
                                        @error('quantity')
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
        $('#asset_material_id').change(function(e) {
            var id = $(this).val();
            $.ajax({
                type: "get",
                url: "/asset-material/" + id,
                success: function(data) {
                    $('#name').val(data.name);
                    $('#satuan').val(data.satuan);

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
