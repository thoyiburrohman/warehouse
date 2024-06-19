@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
@endpush
@section('title', 'Dashboard')
@section('content')
    <div class="nxl-content">
        <div class="main-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="hstack justify-content-between mb-4">
                        <div>
                            <h5 class="mb-1">Stock NTE</h5>
                            <span class="fs-12 text-muted">Total ketersediaan NTE</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-2 col-lg-2 col-md-6">
                            <div class="card stretch stretch-full border-dashed ">
                                <div class="card-body rounded-3 text-center">
                                    <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ totalNte('ONT') }}</div>
                                    <p class="fs-12 fw-medium text-muted text-spacing-1 mb-0 text-truncate-1-line">
                                        Total ONT</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-lg-2 col-md-6">
                            <div class="card stretch stretch-full border-dashed ">
                                <div class="card-body rounded-3 text-center">
                                    <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ totalNte('STB') }}</div>
                                    <p class="fs-12 fw-medium text-muted text-spacing-1 mb-0 text-truncate-1-line">
                                        Total STB</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-lg-2 col-md-6">
                            <div class="card stretch stretch-full border border-dashed border-gray-5">
                                <div class="card-body rounded-3 text-center">
                                    <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ totalNte('ORBIT') }}</div>
                                    <p class="fs-12 fw-medium text-muted text-spacing-1 mb-0 text-truncate-1-line">
                                        Total Orbit</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-lg-2 col-md-6">
                            <div class="card stretch stretch-full border border-dashed border-gray-5">
                                <div class="card-body rounded-3 text-center">
                                    <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ totalNte('PLC') }}</div>
                                    <p class="fs-12 fw-medium text-muted text-spacing-1 mb-0 text-truncate-1-line">
                                        Total PLC</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-lg-2 col-md-6">
                            <div class="card stretch stretch-full border border-dashed border-gray-5">
                                <div class="card-body rounded-3 text-center">
                                    <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ totalNte('INDIBOX') }}</div>
                                    <p class="fs-12 fw-medium text-muted text-spacing-1 mb-0 text-truncate-1-line">
                                        Total Indibox</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-lg-2 col-md-6">
                            <div class="card stretch stretch-full border border-dashed border-gray-5">
                                <div class="card-body rounded-3 text-center">
                                    <div class="fs-4 fw-bolder text-dark mt-3 mb-1">{{ totalNte('ACCESS POINT') }}</div>
                                    <p class="fs-12 fw-medium text-muted text-spacing-1 mb-0 text-truncate-1-line">
                                        Total AP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- [Payment Records] start -->
                <div class="col-12">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Resume Stock</h5>
                            <div class="card-header-action">
                                <a href="{{ route('nte.tsel.export') }}" class="btn btn-sm btn-warning"><i
                                        class="feather-download me-2"></i>TSEL</a>
                                <a href="{{ route('nte.ebis.export') }}" class="btn btn-sm btn-danger"><i
                                        class="feather-download me-2"></i>EBIS</a>
                            </div>
                        </div>
                        <div class="card-body p-0 pt-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="datatable">
                                    <thead>
                                        @if (roleId() != 3)
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                @foreach ($warehouse as $item)
                                                    <th colspan="2">{{ $item->name }}</th>
                                                @endforeach
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Item Description</th>
                                                @for ($i = 0; $i < count($warehouse); $i++)
                                                    <th>Tsel</th>
                                                    <th>Ebis</th>
                                                @endfor
                                                <th>Total</th>
                                            </tr>
                                        @endif
                                        @if (roleId() == 3)
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Item Description</th>
                                                <th>Tsel</th>
                                                <th>Ebis</th>
                                                <th>Total</th>
                                            </tr>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @foreach ($assetNte as $item)
                                            <tr class="single-item">
                                                <td class="text-uppercase">{{ $item->type }}</td>
                                                <td class="text-uppercase">
                                                    {{ $item->name }}
                                                </td>
                                                @if (roleId() != 3)
                                                    @foreach ($warehouse as $items)
                                                        <td
                                                            class="text-uppercase {{ totalItemAssetNteTselGudang($item->id, $items->id) == 0 ? 'text-danger' : '' }}">
                                                            {{ totalItemAssetNteTselGudang($item->id, $items->id) }}</td>
                                                        <td
                                                            class="text-uppercase {{ totalItemAssetNteEbisGudang($item->id, $items->id) == 0 ? 'text-danger' : '' }}">
                                                            {{ totalItemAssetNteEbisGudang($item->id, $items->id) }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                                @if (roleId() == 3)
                                                    <td
                                                        class="text-uppercase {{ totalItemAssetNteTselGudang($item->id, warehouseId()) == 0 ? 'text-danger' : '' }}">
                                                        {{ totalItemAssetNteTselGudang($item->id, warehouseId()) }}</td>
                                                    <td
                                                        class="text-uppercase {{ totalItemAssetNteEbisGudang($item->id, warehouseId()) == 0 ? 'text-danger' : '' }}">
                                                        {{ totalItemAssetNteEbisGudang($item->id, warehouseId()) }}
                                                    </td>
                                                @endif
                                                <td class="text-uppercase fw-bold ">
                                                    {{ totalAssetNteGudang($item->id) }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot class="border-top">
                                        @if (roleId() != 3)
                                            <tr>
                                                <td></td>
                                                <td class="fw-bold">TOTAL</td>
                                                @for ($i = 1; $i <= count($warehouse); $i++)
                                                    <td class="fw-bold">{{ totalAssetNteTselGudang($i) }}</td>
                                                    <td class="fw-bold">{{ totalAssetNteEbisGudang($i) }}</td>
                                                @endfor
                                                <td class="fw-bold">{{ totalAssetNteAll() }}</td>
                                            </tr>
                                        @endif
                                        @if (roleId() == 3)
                                            <tr>
                                                <td class="fw-bold"></td>
                                                <td class="fw-bold">TOTAL</td>
                                                <td class="fw-bold">{{ totalAssetNteTselAll(warehouseId()) }}</td>
                                                <td class="fw-bold">{{ totalAssetNteEbisAll(warehouseId()) }}</td>
                                                <td class="fw-bold">{{ totalAssetNteAll() }}</td>
                                            </tr>
                                        @endif
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- [Payment Records] start -->
                <div class="col-12">
                    <div class="card stretch stretch-full">
                        <div class="card-header">
                            <h5 class="card-title">Resume Intech</h5>
                            <div class="card-header-action">
                                <a href="{{ route('nte.intech.export') }}" class="btn btn-sm btn-primary"><i
                                        class="feather-download me-2"></i>Download Intech</a>
                            </div>
                        </div>
                        <div class="card-body p-0 pt-2">
                            <div class="table-responsive">
                                <table class="table table-hover" id="datatableIntech">
                                    <thead>
                                        <tr>
                                            @if (roleId() != 3)
                                                <th>Warehouse</th>
                                            @endif
                                            <th>Serial Number</th>
                                            <th>Teknisi</th>
                                            <th>Unit</th>
                                            <th>Mitra</th>
                                            <th>Umur</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nteIntech as $item)
                                            <tr class="single-item">
                                                @if (roleId() != 3)
                                                    <td class="text-uppercase">{{ $item->fromWarehouse->name }}</td>
                                                @endif
                                                <td class="text-uppercase">{{ $item->nte->serial_number }}</td>
                                                <td class="text-uppercase">
                                                    {{ $item->toTechnician->name }}
                                                </td>
                                                <td class="text-uppercase">
                                                    {{ $item->toTechnician->division }}
                                                </td>
                                                <td class="text-uppercase">
                                                    {{ $item->toTechnician->mitra->name }}
                                                </td>
                                                <td class="text-uppercase">
                                                    {{ umurHari($item->id) }}
                                                </td>
                                                <td class="text-uppercase">
                                                    {{ Carbon\Carbon::parse($item->date)->format('d-M-y') }}
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
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendors/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.bs5.min.js') }}"></script>
    <script src="{{ asset('js/datatable-init.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#datatableIntech").DataTable({
                pageLength: 10,
                lengthMenu: [10, 20, 50, 100, 200, 500],
            });
        });
    </script>
@endpush
