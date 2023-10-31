<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Leave Attendance</title>
{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card mx-auto rounded-3 w-25">
            <div class="card-body shadow">
                <div class="container">
                    <form action="{{ route('attendance.leave') }}" method="POST">
                        @csrf
                        <div>
                            <label for="employee_id" class="my-3 fs-5">Employee</label>
                            <select class="form-select" name="user_id" id="user_id">
                                <option value="#" href="#" disabled>Select Employee</option>
                                <option value="{{ $employee->id }}">
                                    <p>{{ $employee->name }}</p>
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger mt-4">On Leave</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
