<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Login Attendance</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <div id="box">
        <div id="alert-container">
            @if (session()->has('alert'))
                <div class="alert alert-danger">
                    {{ session('alert') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <form action="{{route('attendance.in')}}" method="POST">
            @csrf
            <div>
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id">
                    <option value="" >Select Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"><p>{{ $employee->name }}</p></option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="attendance-btn mt-4">Login</button>
            </div>
            <div>
                {{-- <a href="{{route('attendance.attendances')}}" class="attendance-btn mt-4" >Attendance List</a> --}}
            </div>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        if ($('#alert-container').length) {
            setTimeout(function() {
                $('#alert-container').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 1200);
        }
    });
</script>

</html>
