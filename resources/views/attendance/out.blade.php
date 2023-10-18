<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Logout Attendance</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div id="box">
        <form action="/out" method="POST">
            @csrf
            <div>
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id">
                    <option value="">Select Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit">Logout</button>
            </div>
        </form>
    </div>
</body>

</html>
