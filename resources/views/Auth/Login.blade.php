@extends('layouts.custom.app')
@section('title', 'Login an account')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div class="card w-25">
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif

                            <form class="needs-validation theme-form" novalidate action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>Sign in to your account</h4>
                                        {{-- <p>Enter your email or username and password to log in</p> --}}
                                    </div>

                                    <div class="mode">
                                        <svg width="30" height="30">
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#moon') }}"></use>
                                        </svg>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label for="username_or_email" class="col-form-label">Email Address or Username</label>
                                    <input type="text" class="form-control" id="username_or_email"
                                        name="username_or_email" required placeholder="Enter your email or username">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input type="password" class="form-control" id="password" name="password" required
                                            placeholder="*********">
                                    </div>
                                </div>

                                <div class="form-group mt-2 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="checkbox p-0">
                                            <input type="checkbox" id="checkbox1" name="remember">
                                            <label class="text-muted" for="checkbox1">Remember me</label>
                                        </div>
                                        <a class="ms-2 text-end" href="{{ route('reset') }}">Forgot password?</a>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block w-100">Sign in</button>
                                <div class="form-group">
                                    <p class="mt-2 text-center">Don't have an account? <a class="ms-2"
                                            href="{{ route('register') }}">Create Account</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <!-- Validation JS -->
    <script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
@endsection
