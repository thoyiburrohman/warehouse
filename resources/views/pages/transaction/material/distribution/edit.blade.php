@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Update Distribution Material')
@section('content')
    <div class="nxl-content">
        <form action="{{ route('distribution.material.update', $transactions->id) }}" method="post" id="distribution">
            @method('put')
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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('distribution.material.index') }}">Distribution</a></li>
                            <li class="breadcrumb-item">@yield('title')</li>
                        </ul>
                    </div>
                    <div class="page-header-right ms-auto">
                        <button type="submit" class="btn btn-primary rounded-3"><i
                                class="feather-save me-2"></i>Update</button>
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
                                            value="{{ old('date') ? old('date') : $transactions->date }}">
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
                                        <input type="text" readonly id="to_id" name="to_id"
                                            class="text-capitalize form-control"
                                            value="{{ $transactions->toTechnician->name }}">
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" readonly id="nik" name="nik"
                                            class="text-uppercase form-control"
                                            value="{{ $transactions->toTechnician->nik }}">
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <label for="divisi" class="form-label">Divisi</label>
                                        <input type="text" readonly id="divisi" name="divisi"
                                            class="text-uppercase form-control"
                                            value="{{ $transactions->toTechnician->division }}">
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="mitra" class="form-label">Mitra</label>
                                        <input type="text" readonly id="mitra" name="mitra"
                                            class="text-uppercase form-control"
                                            value="{{ $transactions->toTechnician->mitra->name }}">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-lg-4 col-12">
                                        <label for="reservation_number" class="form-label">Reservation Number</label>
                                        <input type="text" readonly id="reservation_number" name="reservation_number"
                                            class="text-capitalize form-control"
                                            value="{{ $transactions->reservation_number }}">
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="gi_number" class="form-label">GI Number</label>
                                        <input type="text" readonly id="gi_number" name="gi_number"
                                            class="text-uppercase form-control" value="{{ $transactions->gi_number }}">
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <label for="rfc_number" class="form-label">RFC</label>
                                        <input type="text" readonly id="rfc_number" name="rfc_number"
                                            class="text-uppercase form-control" value="{{ $transactions->rfc_number }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-4 col-12">
                                        <label for="order" class="form-label">No. Order</label>
                                        <input type="text" id="order" name="order"
                                            class="form-control @error('order') is-invalid @enderror"
                                            placeholder="12345678"
                                            value="{{ old('order') ? old('order') : $transactions->order }}">
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
                                            placeholder="12345678"
                                            value="{{ old('inet') ? old('inet') : $transactions->inet }}">
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
                                                {{ $transactions->berita_acara == 'nok' ? 'selected' : '' }}>
                                                NOK</option>
                                            <option value="ok" data-tzone="feather-check"
                                                {{ $transactions->berita_acara == 'ok' ? 'selected' : '' }}>
                                                OK</option>
                                        </select>
                                        @error('berita_acara')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <label class="form-label">Add Material:</label>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="datatableCreate">
                                            <thead>
                                                <tr>

                                                    <th>Id Material</th>
                                                    <th>Nama Material</th>
                                                    <th>Satuan</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transactions->detail as $item)
                                                    <tr class="single-item">
                                                        <td class="text-uppercase">{{ $item->assets->code }}</td>
                                                        <td class="text-uppercase">{{ $item->assets->name }}</td>
                                                        <td class="text-capitalize">{{ $item->assets->satuan }}</td>
                                                        <td class="text-capitalize ">
                                                            <input type="number" class="form-control"
                                                                value="{{ $item->quantity }}">
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
    <script src="{{ asset('js/datatable-init.min.js') }}"></script>
@endpush
