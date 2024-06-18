@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
@endpush
@section('title', 'Stock NTE')
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
                            <a href="{{ route('nte.import') }}" class="btn btn-secondary">
                                <i class="feather-upload me-2"></i>
                                <span>Import NTE</span>
                            </a>
                            <a href="{{ route('nte.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create NTE</span>
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
                                                <span class="text-truncate-1-line">Total Stock</span>
                                                <span class="fs-24 fw-bolder d-block">{{ count($ntes) }}</span>
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
                                                <span class="text-truncate-1-line">Stock Available</span>
                                                <span class="fs-24 fw-bolder d-block">{{ count($nteAvailable) }}</span>
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
                                                <i class="feather-x-circle"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Stock Dismantle</span>
                                                <span class="fs-24 fw-bolder d-block">{{ count($nteDismantle) }}</span>
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
                                                <i class="feather-trash"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Stock Unvailable</span>
                                                <span class="fs-24 fw-bolder d-block">{{ count($nteUnvailable) }}</span>
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
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text avatar-xl rounded">
                                                <i class="feather-user"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Stock Intech</span>
                                                <span class="fs-24 fw-bolder d-block">{{ count($nteIntech) }}</span>
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
                        <div class="col-xxl-3 col-md-6">
                            <div class="card stretch stretch-full">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text avatar-xl rounded">
                                                <i class="feather-check-circle"></i>
                                            </div>
                                            <a href="javascript:void(0);" class="fw-bold d-block">
                                                <span class="text-truncate-1-line">Stock Install</span>
                                                <span class="fs-24 fw-bolder d-block">{{ count($nteInstall) }}</span>
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
                            <div class="table-responsive">
                                <table class="table table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-end">Actions</th>
                                            @if (roleId() == 1)
                                                <th>Warehouse</th>
                                            @endif
                                            <th>Serial Number</th>
                                            <th>Owner</th>
                                            <th>Item Description</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ntes as $item)
                                            <tr class="single-item">
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        @if (roleId() == 1)
                                                            <a href="{{ route('nte.edit', $item->id) }}"
                                                                class="avatar-text avatar-md btn-warning">
                                                                <i class="feather feather-edit"></i>
                                                            </a>
                                                            <a href="{{ route('nte.delete', $item->id) }}"
                                                                class="btn-hapus avatar-text avatar-md btn-danger">
                                                                <i class="feather feather-trash"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('nte.dismantle', $item->id) }}"
                                                            class="btn-dismantle avatar-text avatar-md btn-warning">
                                                            <i class="feather feather-x-circle"></i>
                                                        </a>
                                                        <a href="{{ route('nte.damage', $item->id) }}"
                                                            class="btn-damage avatar-text avatar-md btn-danger">
                                                            <i class="feather feather-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                @if (roleId() == 1)
                                                    <td class="text-uppercase">{{ $item->warehouse->name }}</td>
                                                @endif
                                                <td class="text-uppercase">{{ $item->serial_number }}</td>
                                                <td class="text-uppercase">{{ $item->owner }}</td>
                                                <td class="text-uppercase">
                                                    {{ $item->assetNte->name }}
                                                </td>
                                                <td class="text-capitalize">
                                                    @if ($item->status == 'available')
                                                        <span class="badge bg-info">
                                                            {{ $item->status }}
                                                        </span>
                                                    @elseif($item->status == 'unvailable' || $item->status == 'dismantle')
                                                        <span class="badge bg-danger">
                                                            {{ $item->status }}
                                                        </span>
                                                    @else
                                                        @if ($item->status == 'intech')
                                                            <span class="badge bg-warning">
                                                                {{ $item->status }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-success">
                                                                {{ $item->status }}
                                                            </span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-capitalize">{{ $item->note }}</td>
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
    <!-- [ Main Content ] end -->
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendors/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/js/dataTables.bs5.min.js') }}"></script>
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
    <script>
        $('.btn-dismantle').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan dismantle!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0891b2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, dismantle!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
            });
        });
    </script>
    <script>
        $('.btn-damage').click(function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data akan unvailable!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0891b2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, damage!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
            });
        });
    </script>
@endpush
