@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
@endpush
@section('title', 'Importing Technician')
@section('content')
    <div class="nxl-content">

        <form action="{{ route('technician.importing') }}" method="post" enctype="multipart/form-data">
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
                            <li class="breadcrumb-item"><a href="{{ route('technician.index') }}">Technician</a>
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
                                <div class="mb-3">
                                    <label for="import" class="form-label">Import</label>
                                    <label for="choose-file" class="custom-file-upload" id="choose-file-label"> Upload
                                        Document </label>
                                    <input name="file" type="file" id="choose-file" style="display: none">
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
@endpush
