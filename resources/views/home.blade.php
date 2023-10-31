<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Welcome - Home</title>
</head>

<body>
    <div class="container">
        <div>
            <div class="card shadow rounded-pill my-4 w-25" style="border:black;border-radius:4px">
                <div class="card-body text-center">
                    <img class="img-fluid mx-auto" src="{{ asset('assets/images/lap-attendance/logo/Logo Black.png') }}"
                        alt="">
                </div>
            </div>
            <h2 class="my-4">
                Welcome to the Attendance System
            </h2>
            <div>
                @if (Route::has('login'))
                    <div>
                        @auth
                            @if (auth()->user()->role === 'employee')
                                <a href="{{ url('/employee/dashboard') }}" type="submit"
                                    class="btn btn-success px-4 rounded-3 shadow">Employee
                                    Dashboard</a>
                            @else
                                <a href="{{ url('/dashboard') }}" type="submit"
                                    class="btn btn-success px-4 rounded-3 shadow">Admin Dashboard</a>
                            @endif
                        @else
                            <div class="d-flex">
                                <div class="mx-1">
                                    <a href="{{ route('login') }}" type="submit"
                                        class="btn btn-success px-4 rounded-3 shadow">Log in</a>
                                </div>
                                <div class="px-3">
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" type="submit"
                                            class="btn btn-outline-primary px-4 rounded-3 shadow">Register</a>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
