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
            <h2>
                Welcome to the Attendance System
            </h2>
            <div>
                @if (Route::has('login'))
                    <div>
                        @auth
                        @if (auth()->user()->role === 'employee')
                            <a href="{{ url('/employee/dashboard') }}"  type="submit" class="attendance-btn">Employee Dashboard</a>
                        @else
                        <a href="{{ url('/dashboard') }}"  type="submit" class="attendance-btn">Admin Dashboard</a>                         
                        @endif
                        @else
                            <a href="{{ route('login') }}"  type="submit" class="attendance-btn">Log in</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"  type="submit" class="attendance-btn">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                {{-- <a href="{{route('attendance.in')}}" type="submit" class="attendance-btn">Attendance &rarr;</a> --}}
                {{-- <a href="{{route('login')}}" type="submit" class="attendance-btn">Login &rarr;</a> --}}
            </div>
        </div>
    </div>
</body>
</html>