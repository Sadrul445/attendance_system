@extends('employee.dashboard')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('employee.partials.css')
@section('title', 'Individual Daily Attendance')

@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            <a href="{{ route('employee.dashboard') }}" class="breadcrumb-item">Home</a>
        @endslot
        <li class="breadcrumb-item">Today's Attendances Report</li>
    @endcomponent
    @if (session('alert'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-7">
                <div class="card shadow rounded-3">
                    <div class="card-body">
                        <div class="my-2 text-end">
                            <p>Enter your today's attendance</p>
                            <a href="{{ url('show/in', ['id' => $employee->id]) }}" class="btn btn-success shadow">In</a>
                            <a href="{{ url('show/out', ['id' => $employee->id]) }}" class="btn btn-primary shadow">Out</a>
                            <a href="{{ url('show/leave', ['id' => $employee->id]) }}"
                                class="btn btn-danger shadow">Leave</a>
                        </div>
                        <table class="table display table-hover mt-4">
                            <h5 class="">Attendance for - <strong>{{ $employee->name }}</strong> </h5>
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">In Time</th>
                                    <th scope="col">Out Time</th>
                                    <th scope="col">Working Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $row->date_time }}</td>
                                    {{-- <td>{!! $row->onLeave ? 'On Leave' : ($row->absent ? 'Absent' : 'Present') !!}</td> --}}
                                    <td>{!! $row->onLeave
                                        ? '<strong style="font-size:10px;background-color: #ba895d;color:white;border-radius:40px;padding:7px">' .
                                            'On Leave' .
                                            '</strong>'
                                        : ($row->absent
                                            ? '<strong style="font-size:10px;background-color: red;color:white;border-radius:40px;padding:7px">' .
                                                'Absent' .
                                                '</strong>'
                                            : '<strong style="font-size:10px;background-color: #0DB14B;color:white;border-radius:40px;padding:7px">' .
                                                'Present' .
                                                '</strong>') !!}</td>
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
                            <a href="#">Profile</a>
                        </h3>
                        <div>
                            <label for="">ID</label>
                            <strong style="color: red">#{{ $employee->id }}</strong>
                        </div>
                        <div class="mt-4">
                            <div>
                                <label for="name">Name</label>
                                <p>{{ $employee->name }}</p>
                            </div>
                            <div class="mt-3">
                                <label for="email">Email</label>
                                <p>{{ $employee->email }}</p>
                            </div>
                            <div class="mt-3">
                                <label for="phone">Phone Number</label>
                                <p>+880-165444444</p>
                            </div>
                            <div class="mt-3">
                                <label for="address">Address</label>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit. Nam, tenetur? Ducimus, itaque.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
