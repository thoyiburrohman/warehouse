@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/dataTables.bs5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/select2-theme.min.css') }}">
@endpush
@section('title', 'Edit User')
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
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                        <li class="breadcrumb-item">@yield('title')</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                </div>
            </div>
            <!-- [ page-header ] end -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                @method('put')
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="John Doe"
                                            value="{{ old('name') ? old('name') : $user->name }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="johndoe@mail.com"
                                            value="{{ old('email') ? old('email') : $user->email }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg 6 col-12">
                                        <label for="warehouse_id" class="form-label">Warehouse</label>
                                        <select class="form-control" id="warehouse_id" name="warehouse_id"
                                            data-select2-selector="status">
                                            @foreach ($warehouses as $item)
                                                <option value="{{ $item->id }}" data-bg="bg-info"
                                                    {{ $user->warehouse_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warehouse_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg 6 col-12">
                                        <label for="role_id" class="form-label">Role</label>
                                        <select class="form-control" id="role_id" name="role_id"
                                            data-select2-selector="status">
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->id }}" data-bg="bg-info"
                                                    {{ $user->role_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-12">
                                        <label for="newPassword" class="form-label">Password</label>
                                        <input type="password" id="newPassword" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="johndoe@mail.com" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label for="confirmPassword" class="form-label">Password Confirm</label>
                                        <div class="input-group field">
                                            <input type="password"
                                                class="form-control password @error('password') is-invalid @enderror"
                                                id="confirmPassword" name="password_confirmation" placeholder="Password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}</div>
                                            @enderror
                                            <div id="togglePassword"
                                                class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                                data-bs-toggle="tooltip" title="Show/Hide Password"><i
                                                    class="feather-eye"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="telegram" class="form-label">Telegram Id</label>
                                        <input type="text" id="telegram" name="telegram"
                                            class="form-control @error('telegram') is-invalid @enderror"
                                            value="{{ old('telegram') ? old('telegram') : $user->telegram }}">
                                        @error('telegram')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i
                                        class="feather-save me-2"></i>save</button>
                            </form>
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
    <script src="{{ asset('js/customers-init.min.js') }}"></script>
    <script>
        $('#togglePassword').click(function() {
            if ($('#newPassword').attr('type') == 'text') {
                $('#newPassword').attr('type', 'password');
                $('#confirmPassword').attr('type', 'password');
            } else {
                $('#newPassword').attr('type', 'text');
                $('#confirmPassword').attr('type', 'text');
            }
        });
    </script>
@endpush
