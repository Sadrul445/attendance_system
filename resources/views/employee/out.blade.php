<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Logout Attendance</title>
{{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card mx-auto rounded-3 w-25">
            <div class="card-body shadow">
                <div class="container">
                    <a href="{{ url('attendance', ['employeeId' => $employee->id]) }}" style="font-size:15px"><i class="fa-solid fa-angles-left"></i> Back</a>
                    <form action="{{ route('employee.out') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary mt-4 shadow">Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
