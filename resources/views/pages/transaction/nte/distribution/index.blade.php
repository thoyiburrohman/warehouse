@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Distribution')
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
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item">@yield('title')</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne">
                                <i class="feather-bar-chart"></i>
                            </a>
                            <a href="{{ route('distribution.nte.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Distribution</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div id="collapseOne" class="accordion-collapse mb-3 collapse page-header-collapse">
                <div class="accordion-body pb-2" style="border-radius:10px">
                    <div class="row">
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text avatar-xl rounded">
                                                <i class="feather-list"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Total Distribution</span>
                                                <span class="fs-24 fw-bolder d-block">{{ $distributions->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="badge bg-soft-success text-success">
                                            <i class="feather-arrow-up fs-10 me-1"></i>
                                            <span>36.85%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text avatar-xl rounded">
                                                <i class="feather-check"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Install</span>
                                                <span
                                                    class="fs-24 fw-bolder d-block">{{ $distributionInstall->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="badge bg-soft-danger text-danger">
                                            <i class="feather-arrow-down fs-10 me-1"></i>
                                            <span>24.56%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text avatar-xl rounded">
                                                <i class="feather-x"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Intech</span>
                                                <span
                                                    class="fs-24 fw-bolder d-block">{{ $distributionIntech->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="badge bg-soft-success text-success">
                                            <i class="feather-arrow-up fs-10 me-1"></i>
                                            <span>33.29%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text avatar-xl rounded">
                                                <i class="feather-corner-down-left"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Return</span>
                                                <span
                                                    class="fs-24 fw-bolder d-block">{{ $distributionReturn->count() }}</span>
                                            </a>
                                        </div>
                                        <div class="badge bg-soft-danger text-danger">
                                            <i class="feather-arrow-down fs-10 me-1"></i>
                                            <span>42.47%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="row p-3 d-none" id="buttonBulk">
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <button class="avatar-text avatar-md btn-info">
                                                <i class="feather feather-repeat"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="text-end">Actions</th>
                                        <th>Berita Acara</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        @if (roleId() != 3)
                                            <th>Warehouse</th>
                                        @endif
                                        <th>No. Transaksi</th>
                                        <th>Serial Number</th>
                                        <th>Owner</th>
                                        <th>Item Description</th>
                                        <th>Nama Teknisi</th>
                                        <th>NIK Teknisi</th>
                                        <th>Mitra</th>
                                        <th>Divisi</th>
                                        <th>Order</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($distributions as $items)
                                        <tr class="single-item">
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('distribution.nte.return', $items->id) }}"
                                                        class="avatar-text avatar-md btn-secondary">
                                                        <i class="feather feather-corner-down-left"></i>
                                                    </a>
                                                    <a href="{{ route('distribution.nte.edit', $items->id) }}"
                                                        class="avatar-text avatar-md btn-warning">
                                                        <i class="feather feather-edit-3"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-capitalize">
                                                @if ($items->berita_acara == 'ok')
                                                    <span class="avatar-text avatar-md btn-success">
                                                        <i class="feather-check"></i>
                                                    </span>
                                                @else
                                                    <span class="avatar-text avatar-md btn-danger">
                                                        <i class="feather-x"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-capitalize">
                                                @if ($items->nte->status == 'available')
                                                    <span class="badge bg-info">
                                                        {{ $items->nte->status }}
                                                    </span>
                                                @elseif($items->status == 'unvailable' || $items->nte->status == 'dismantle')
                                                    <span class="badge bg-danger">
                                                        {{ $items->nte->status }}
                                                    </span>
                                                @else
                                                    @if ($items->nte->status == 'intech')
                                                        <span class="badge bg-warning">
                                                            {{ $items->nte->status }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-success">
                                                            {{ $items->nte->status }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-uppercase">{{ $items->date }}</td>
                                            @if (roleId() != 3)
                                                <td class="text-uppercase">{{ $items->fromWarehouse->name }}</td>
                                            @endif
                                            <td class="text-uppercase">{{ $items->number }}</td>
                                            <td class="text-uppercase">{{ $items->nte->serial_number }}</td>
                                            <td class="text-uppercase">{{ $items->nte->owner }}</td>
                                            <td class="text-uppercase">
                                                {{ $items->nte->assetNte->name }}
                                            </td>
                                            <td class="text-uppercase">{{ $items->toTechnician->name }}</td>
                                            <td class="text-uppercase">{{ $items->toTechnician->nik }}</td>
                                            <td class="text-uppercase">{{ $items->toTechnician->mitra->name }}</td>
                                            <td class="text-uppercase">{{ $items->toTechnician->division }}</td>
                                            <td class="text-uppercase">{{ $items->order }}</td>
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
    <!-- [ Main Content ] end -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendors/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.bs5.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2-active.min.js') }}"></script>
    <script src="{{ asset('js/datatable-init.min.js') }}"></script>
    <script>
        $('.btn-hapus').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0891b2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
            });
        });
    </script>
@endpush
