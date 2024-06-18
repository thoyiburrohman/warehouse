@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/datepicker.min.css') }}">
@endpush
@section('title', 'Create Distribution Material')
@section('content')
    <div class="nxl-content">

        <form action="{{ route('distribution.material.store') }}" method="post">
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
                            <li class="breadcrumb-item"><a href="{{ route('distribution.material.index') }}">Distribution
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
                                            class="text-capitalize form-control" value="distribution">
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="warehouse_id" class="form-label">Warehouse</label>
                                        <input type="text" readonly id="warehouse_id" name="warehouse_id"
                                            class="text-capitalize form-control"
                                            value="{{ auth()->user()->warehouse->name }}">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-4 col-12">
                                        <label for="to_id" class="form-label">Nama Teknisi</label>
                                        <select class="form-control" id="to_id" name="to_id"
                                            data-select2-selector="privacy">
                                            <option data-icon="feather-user" value="">Select...</option>
                                            @foreach ($technician as $item)
                                                <option value="{{ $item->id }}" data-icon="feather-user"
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
                                    <div class="col-lg-2 col-12">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" readonly id="nik" name="nik"
                                            class="text-uppercase form-control" value="">
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <label for="divisi" class="form-label">Divisi</label>
                                        <input type="text" readonly id="divisi" name="divisi"
                                            class="text-uppercase form-control" value=" ">
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="mitra" class="form-label">Mitra</label>
                                        <input type="text" readonly id="mitra" name="mitra"
                                            class="text-uppercase form-control" value="">
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
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-12">
                                        <label for="order" class="form-label">No. Order</label>
                                        <input type="text" id="order" name="order"
                                            class="form-control @error('order') is-invalid @enderror"
                                            placeholder="12345678" value="{{ old('order') }}">
                                        @error('order')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="inet" class="form-label">No.
                                            Inet/Voice</label>
                                        <input type="text" id="inet" name="inet"
                                            class="form-control @error('inet') is-invalid @enderror"
                                            placeholder="12345678" value="{{ old('inet') }}">
                                        @error('inet')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="berita_acara" class="form-label">Berita Acara</label>
                                        <select class="form-control" id="berita_acara" name="berita_acara"
                                            data-select2-selector="tzone">
                                            <option value="nok" data-tzone="feather-x"
                                                {{ old('berita_acara') == 'nok' ? 'selected' : '' }}>
                                                NOK</option>
                                            <option value="ok" data-tzone="feather-check"
                                                {{ old('berita_acara') == 'ok' ? 'selected' : '' }}>
                                                OK</option>
                                        </select>
                                        @error('berita_acara')
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
                                                    <td class="text-uppercase">{{ $item->assets->segment }}</td>
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
