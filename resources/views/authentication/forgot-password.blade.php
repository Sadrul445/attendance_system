@extends('authentication.login.master')
@push('css')
    <style>
        .i-color {
            color: #0DB14B;
        }
    </style>
@endpush
@section('title', 'Forgot Password')
@section('content')
    <section>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <form method="POST" action="{{ route('password.email') }}"
                            class="theme-form login-form shadow rounded-3">
                            @csrf
                            <div style="text-align: center">
                                <img class="img-fluid my-4"
                                    src="{{ asset('assets/images/lap-attendance/logo/Logo Black.png') }}" alt="">
                            </div>
                            <div class="mb-4 text-sm text-gray-600">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email i-color"></i></span>
                                    <x-text-input class="form-control" type="email" name="email" required autofocus
                                        autocomplete="username" :value="old('email')" />
                                    @error('email')
                                        <div class="alert alert-danger mt-2 w-100">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="flex items-center justify-items-end mt-4 btn btn-primary">
                                {{ __('Email Password Reset Link') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
