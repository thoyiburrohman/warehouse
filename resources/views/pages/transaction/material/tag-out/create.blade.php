@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/datepicker.min.css') }}">
@endpush
@section('title', 'Create Tag Out Material')
@section('content')
    <div class="nxl-content">

        <form action="{{ route('tag-out.material.store') }}" method="post">
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
                            <li class="breadcrumb-item"><a href="{{ route('tag-out.material.index') }}">Tag Out
                                    Material</a></li>
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
                                        <label for="date" class="form-label">Tanggal</label>
                                        <input id="date" name="date"
                                            class="form-control @error('date') is-invalid @enderror" required
                                            value="{{ old('date') }}">
                                        @error('date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="type" class="form-label">Type</label>
                                        <input type="text" readonly id="type" name="type"
                                            class="text-capitalize form-control" value="tag out">
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6 col-12">
                                        <label for="warehouse_id" class="form-label">Warehouse</label>
                                        <input type="text" readonly id="warehouse_id" name="warehouse_id"
                                            class="text-capitalize form-control"
                                            value="{{ auth()->user()->warehouse->name }}">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="to_id" class="form-label">Warehouse Destination</label>
                                        <select class="form-control" id="to_id" name="to_id"
                                            data-select2-selector="privacy">
                                            <option data-icon="feather-home" value="">Select...</option>
                                            @foreach ($warehouses as $item)
                                                <option value="{{ $item->id }}" data-icon="feather-home"
                                                    {{ old('to_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('to_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-12">
                                        <label for="reservation_number" class="form-label">Reservation ID</label>
                                        <input type="text" id="reservation_number" name="reservation_number"
                                            class="form-control @error('reservation_number') is-invalid @enderror"
                                            placeholder="12345678" value="{{ old('reservation_number') }}">
                                        @error('reservation_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="gi_number" class="form-label">GI Number</label>
                                        <input type="text" id="gi_number" name="gi_number"
                                            class="form-control @error('gi_number') is-invalid @enderror"
                                            placeholder="12345678" value="{{ old('gi_number') }}">
                                        @error('gi_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="rfc_number" class="form-label">RFC</label>
                                        <input type="text" id="rfc_number" name="rfc_number"
                                            class="form-control @error('rfc_number') is-invalid @enderror"
                                            placeholder="12345678" value="{{ old('rfc_number') }}">
                                        @error('rfc_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="form-label">Add Material:</label>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover" id="datatableCreate">
                                        <thead>
                                            <tr>
                                                <th class="wd-30">
                                                    {{-- <div class="btn-group mb-1">
                                                        <div class="custom-control custom-checkbox ms-1">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="checkAll">
                                                            <label class="custom-control-label" for="checkAll"></label>
                                                        </div>
                                                    </div> --}}
                                                </th>
                                                <th>Segment</th>
                                                <th>Id Material</th>
                                                <th>Nama Material</th>
                                                <th>Satuan</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($material as $item)
                                                <tr class="single-item">
                                                    <td>
                                                        <div class="item-checkbox ms-1">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="{{ $item->assets->id }}"
                                                                    name="id_material[]"
                                                                    class="custom-control-input checkbox"
                                                                    id="checkBox_{{ $item->id }}">
                                                                <label class="custom-control-label"
                                                                    for="checkBox_{{ $item->id }}"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-uppercase">
                                                        {{ $item->assets->segment }}
                                                    </td>
                                                    <td class="text-uppercase">{{ $item->assets->code }}</td>
                                                    <td class="text-uppercase">{{ $item->assets->name }}</td>
                                                    <td class="text-capitalize">{{ $item->assets->satuan }}</td>
                                                    <td class="text-capitalize ">
                                                        <input type="number"
                                                            class="quantity_{{ $item->assets->id }} form-control">

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
        $('.custom-control-input').click(function(e) {
            var id = $(this).val();
            if ($('.quantity_' + id).attr('name')) {
                $('.quantity_' + id).attr('name', '');
            } else {
                $('.quantity_' + id).attr('name', 'quantity[]');
            }
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
