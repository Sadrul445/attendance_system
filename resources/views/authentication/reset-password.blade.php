@extends('authentication.login.master')
@push('css')
    <style>
        .i-color {
            color: #0DB14B;
        }
    </style>
@endpush
@section('title', 'Reset Password')
@section('content')
    <section>
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <form method="POST" action="{{ route('password.store') }}"
                            class="theme-form login-form shadow rounded-3">
                            @csrf
                            <div style="text-align: center">
                                <img class="img-fluid my-4"
                                    src="{{ asset('assets/images/lap-attendance/logo/Logo Black.png') }}" alt="">
                            </div>
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                            <!-- Password -->
                            <div class="form-group">
                                <x-input-label for="password" :value="__('Password')" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock i-color"></i></span>

                                    <x-text-input id="password" class="form-control" type="password" name="password"
                                        required autocomplete="new-password" />
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>

                            {{-- Password-Confirmation --}}
                            <div class="form-group">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-lock i-color"></i></span>

                                    <x-text-input id="password_confirmation" class="form-control"
                                        type="password_confirmation" name="password_confirmation" required
                                        autocomplete="new-password" />
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
