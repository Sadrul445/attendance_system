<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Leave Attendance</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<body>
    <div id="box">
        <form action="{{ route('attendance.leave') }}" method="POST">
            @csrf
            <div>
                <label for="employee_id">Employee:</label>
                <select name="user_id" id="user_id">
                    <option value="">Select Employee</option>
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-danger mt-4">On Leave</button>
            </div>
        </form>
    </div>
</body>

</html>
