@extends('authentication.registration.master')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
    <style>
        .i-color{
            color: #0089D0;
        }
        .logo{
            text-align: center;
        }
    </style>
@endpush
@section('title', 'Registration')
@section('content')
    <section>
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-card">
                        <form action="{{ route('register') }}" method="POST" class="theme-form login-form shadow rounded-3">
                            @csrf
                            <div class="logo mb-4">
                                <img class="img-fluid" src="{{ asset('assets/images/lap-attendance/logo/Logo Black.png') }}"
                                    alt="">
                            </div>
                            <h5>Create your account</h5>
                            <h6>Enter your personal details to create account</h6>
                            <!-- Name -->
                            <div class="form-group">
                                <x-input-label for="name" :value="__('Name')" />
                                <div class="small-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="icon-user i-color"></i></span>
                                        <x-text-input id="name" class="form-control" type="text" name="name"
                                            :value="old('name')" required autofocus autocomplete="name" />
                                    </div>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <div class="input-group">
                                    <span class="input-group-text"><i class="icon-email i-color"></i></span>

                                    <x-text-input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autocomplete="username" />
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
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox" />
                                    <label class="text-muted" for="checkbox1">Agree with <span>Privacy Policy
                                        </span></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <x-primary-button class="btn btn-primary btn-block">
                                    {{ __('register') }}
                                </x-primary-button>
                            </div>
                            <div class="login-social-title">
                                <h5>signup with</h5>
                            </div>
                            <div class="form-group">
                                <ul class="login-social">
                                    <li>
                                        <a href="#" target="_blank"><i class="i-color"
                                                data-feather="linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank"><i class="i-color"
                                                data-feather="twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank"><i class="i-color"
                                                data-feather="facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank"><i class="i-color"
                                                data-feather="instagram"> </i></a>
                                    </li>
                                </ul>
                            </div>
                            <p>Already have an account?<a class="ms-2 text-success" href="{{ route('login') }}">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('scripts')
        <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    @endpush
@endsection
