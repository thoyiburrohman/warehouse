@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/datepicker.min.css') }}">
@endpush
@section('title', 'Create Tag Out')
@section('content')
    <div class="nxl-content">

        <form action="{{ route('tag-out.nte.store') }}" method="post" enctype="multipart/form-data">
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
                            <li class="breadcrumb-item"><a href="{{ route('tag-out.nte.index') }}">Tag Out</a>
                            </li>
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
                                    <div class="col-lg-4 col-12">
                                        <label for="number" class="form-label">No. Transaction</label>
                                        <input type="text" id="number" name="number"
                                            class="form-control @error('number') is-invalid @enderror"
                                            placeholder="WH-WH_20240525-085756-513-46789" value="{{ old('number') }}"
                                            required>
                                        @error('number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-12">
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
                                    <div class="col-lg-4 col-12">
                                        <label for="type" class="form-label">Type</label>
                                        <input type="text" readonly id="type" name="type"
                                            class="text-capitalize form-control" value="TAG Out">
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-6 col-12">
                                        <label for="warehouse_id" class="form-label">From Warehouse</label>
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
                                <div class="mb-3">
                                    <label for="import" class="form-label">Import</label>
                                    <label for="choose-file" class="custom-file-upload" id="choose-file-label"> Upload
                                        Document </label>
                                    <input name="file" type="file" id="choose-file" style="display: none">
                                </div>
                                <div class="row">
                                    <label class="form-label">Add Serial Number</label>
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
                                                <th>Serial Number</th>
                                                <th>Owner</th>
                                                <th>Item Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ntes as $item)
                                                <tr class="single-item">
                                                    <td>
                                                        <div class="item-checkbox ms-1">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" value="{{ $item->id }}"
                                                                    name="sn_id[]" class="custom-control-input checkbox"
                                                                    id="checkBox_{{ $item->id }}">
                                                                <label class="custom-control-label"
                                                                    for="checkBox_{{ $item->id }}"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-uppercase">{{ $item->serial_number }}</td>
                                                    <td class="text-uppercase">{{ $item->owner }}</td>
                                                    <td class="text-uppercase">
                                                        {{ $item->assetNte->name }}
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
        $(document).ready(function() {
            $(document).ready(function() {
                $("#choose-file").change(function() {
                    $(this).prev("label").clone();
                    var e = $("#choose-file")[0].files[0].name;
                    $(this).prev("label").text(e)
                })
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
