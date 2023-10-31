@extends('dashboard')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('attendance.partials.css')
@section('title', 'Individual Daily Attendance')

@section('content')
@component('components.breadcrumb')
@slot('bredcrumb_title')
    Home
@endslot
<li class="breadcrumb-item">Today's Attendances Report</li>
@endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-7">
                <div class="card shadow rounded-3">
                    <div class="card-body">
                        <div class="my-2 text-end">
                            <p>Enter your today's attendance</p>
                            <a href="{{ url('show/in', ['id' => $employee->id]) }}" class="btn btn-success">In</a>
                            <a href="{{ url('show/out', ['id' => $employee->id]) }}" class="btn btn-primary">Out</a>
                            <a href="{{ url('show/leave', ['id' => $employee->id]) }}" class="btn btn-danger">Leave</a>
                        </div>
                        <table class="table display table-hover mt-4">
                            <h5 class="">Attendance for - <strong>{{ $employee->name }}</strong> </h5>
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Login Time</th>
                                    <th scope="col">Logout Time</th>
                                    <th scope="col">Working Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $row->date_time }}</td>
                                    <td>{{ $row->onLeave ? 'On Leave' : ($row->absent ? 'Absent' : 'Present') }}</td>
                                    <td>{{ $row->login_time }}</td>
                                    <td>{{ $row->logout_time }}</td>
                                    <td>{{ $row->working_time }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card shadow rounded-3">
                    <div class="card-body mt-2">
                        <h3>
                            Profile
                        </h3>
                        <div>
                            <label for="">ID</label>
                            <strong>#{{ $employee->id }}</strong>
                        </div>
                        <div class="mt-4">
                            <div>
                                <label for="">Name</label>
                                <p>{{ $employee->name }}</p>
                            </div>
                            <div class="mt-3">
                                <label for="">Email</label>
                                <p>{{ $employee->email }}</p>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
