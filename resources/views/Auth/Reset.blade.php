@extends('layouts.custom.app')
@section('title', 'Reset Password')

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
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            <form class="needs-validation theme-form" novalidate action="{{ route('reset') }}" method="POST">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>Reset Password</h4>
                                        <p>Enter your details to reset your password</p>
                                    </div>

                                    <div class="mode">
                                        <svg width="30" height="30">
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#moon') }}"></use>
                                        </svg>
                                    </div>
                                </div>
                                <hr>
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Username</label>
                                        <input type="text" class="form-control" id="email" name="username" required
                                            placeholder="justin.kim" value="{{ old('username') }}">
                                        <div class="invalid-feedback"> Please enter your username! </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required
                                            placeholder="justin.kim@rkive.com" value="{{ old('email') }}">
                                        <div class="invalid-feedback"> Please enter your email! </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required
                                            placeholder="*********" value="{{ old('password') }}">
                                        <div class="invalid-feedback"> Please enter your password! </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation" class="col-form-label">Confirm
                                            Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required placeholder="*********"
                                            value="{{ old('password_confirmation') }}">
                                        <div class="invalid-feedback"> Please enter same password! </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox p-0">
                                            <input class="form--input m-0" id="invalidCheck" type="checkbox"
                                                required="" >
                                            <label class="form-check-label" for="invalidCheck">Agree to terms and
                                                conditions</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit">Reset</button>
                                </div>
                            </form>
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
