@extends('layouts.custom.app')
@section('title', 'Register an account')

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
                            <form class="needs-validation theme-form" novalidate action="{{ route('register') }}"
                                method="POST">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4>Register an account</h4>
                                        <p>Enter your details to register</p>
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
                                    <div class="form-group col-md-6">
                                        <label for="firstName" class="col-form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name" required
                                            placeholder="Justin" value="{{ old('first_name') }}">
                                        <div class="invalid-feedback"> Please enter your first name! </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lastName" class="col-form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name" required
                                            placeholder="Kim" value="{{ old('last_name') }}">
                                        <div class="invalid-feedback"> Please enter your last name! </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="role" class="form-label">Role</label>
                                        <select name="role_code" class="form-select" required>
                                            <option selected disabled value="{{ old('role_code') }}">Select Role
                                            </option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->role_code }}">{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"> Please select your role! </div>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label for="department" class="form-label">Department</label>
                                        <select name="department_code" class="form-select" required>
                                            <option selected disabled value="{{ old('department_code') }}">Select
                                                Department
                                            </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->department_code }}">
                                                    {{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback"> Please select your department! </div>
                                    </div>
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
                                    <div class="form-check">
                                        <div class="checkbox p-0">
                                            <input class="form-check-input m-0" id="invalidCheck" type="checkbox"
                                                required="">
                                            <label class="form-check-label" for="invalidCheck">Agree to terms and
                                                conditions</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit">Register</button>
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
