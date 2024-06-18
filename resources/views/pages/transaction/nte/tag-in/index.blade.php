@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Tag In')
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
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>From Warehouse</th>
                                            <th>No. Transaksi</th>
                                            <th>Serial Number</th>
                                            <th>Owner</th>
                                            <th>Item Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tagIn as $items)
                                            <tr class="single-item">
                                                <td class="text-uppercase">{{ $items->date }}</td>
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
                                                <td class="text-uppercase">{{ $items->fromWarehouse->name }}</td>
                                                <td class="text-uppercase">{{ $items->number }}</td>
                                                <td class="text-uppercase">{{ $items->nte->serial_number }}</td>
                                                <td class="text-uppercase">{{ $items->nte->owner }}</td>
                                                <td class="text-uppercase">
                                                    {{ $items->nte->assetNte->name }}
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
