@extends('layouts.auth')
@section('title', 'Login Page')
@push('styles')
    <style>
        body {
            background: #8E0E00;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #ffc891, #8E0E00);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #ffc891, #8E0E00);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+,
                            Safari 7+ */
        }
    </style>
@endpush
@section('content')
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div
                        class="wd-80 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="{{ asset('images/logo.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-5">
                        <h2 class="fs-20 fw-bolder mb-4 text-center">Login</h2>
                        <h4 class="fs-13 fw-bold mb-2 text-center">Login to your account</h4>
                        <form action="{{ route('login.authentication') }}" method="post" class="w-100 mt-4 pt-2">
                            @csrf
                            <div class="mb-4">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ old('email') }}" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group field">
                                    <input type="password"
                                        class="form-control password @error('password') 'is-invalid' @enderror"
                                        id="newPassword" name="password" placeholder="Password" ">
                                                                                            @error('password')
        <div class="invalid-feedback">
                                                                                                                                                            {{ $message }}</div>
    @enderror
                                                                                            <div id="togglePassword"
                                                                                                class="input-group-text border-start bg-gray-2 c-pointer show-pass"
                                                                                                data-bs-toggle="tooltip" title="Show/Hide Password"><i class="feather-eye"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mt-4">
                                                                                        <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </main>
@endsection
@push('scripts')
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
