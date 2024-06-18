@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Material')
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
                            <a href="{{ route('material.import') }}" class="btn btn-secondary">
                                <i class="feather-upload me-2"></i>
                                <span>Import Material</span>
                            </a>
                            <a href="{{ route('material.create') }}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Material</span>
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
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="{{ route('material.edit', $item->id) }}"
                                                            class="avatar-text avatar-md btn-warning">
                                                            <i class="feather feather-edit"></i>
                                                        </a>
                                                        <a href="{{ route('material.delete', $item->id) }}"
                                                            class="btn-hapus avatar-text avatar-md btn-danger">
                                                            <i class="feather feather-trash"></i>
                                                        </a>

                                                    </div>
                                                </td>
                                                @if (roleId() == 1)
                                                    <td class="text-uppercase">{{ $item->warehouse->name }}</td>
                                                @endif
                                                <td class="text-uppercase">
                                                    {{ $item->assets->segment }}
                                                </td>
                                                <td class="text-uppercase">{{ $item->assets->code }}</td>
                                                <td class="text-uppercase">{{ $item->assets->name }}</td>
                                                <td class="text-capitalize">{{ $item->assets->satuan }}</td>
                                                <td class="text-capitalize">
                                                    {{ $item->quantity -
                                                        $totalDistribution->where('asset_material_id', $item->assets->id)->sum('quantity') -
                                                        $totalTagOut->where('asset_material_id', $item->assets->id)->sum('quantity') +
                                                        $totalTagIn->where('asset_material_id', $item->assets->id)->sum('quantity') }}
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
