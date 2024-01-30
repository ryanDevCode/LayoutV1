@extends('layouts.custom.app')
@section('title', 'Access Denied')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                {{-- <div class="authentication-main"> --}}
                    <div class="login-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <i data-feather="lock" class="icon" style="width: 100px; height: 100px"></i>
                                    <h2>Access Denied</h2>
                                    <p>You don't have permission to access this page.</p>
                                    <a href="{{ $dashboardLink }}" class="btn btn-primary">Back to Dashboard</a>
                                </div>
                            </div>
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
@endsection
