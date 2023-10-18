@extends('dashboard')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('attendance.partials.css')
@section('title', 'List of Daily Attendance')
@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Employee</li>
        <li class="breadcrumb-item">List of Daily Attendance</li>
    @endcomponent
    <div class="container mt-4">
        <h2>Today's Attendances</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Login Time</th>
                    <th scope="col">Logout Time</th>
                    <th scope="col">Working Time</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <th scope="row">{{ $row->name }}</th>
                        <td class="text-capitalize">
                            {{ $row->onLeave == true ? 'On Leave' : ($row->absent == true ? 'Absent' : 'Present') }}
                        </td>
                        <td>{{ $row->login_time }}</td>
                        <td>{{ $row->logout_time }}</td>
                        <td>{{ $row->working_time }}</td>
                        <td>{{ $row->date_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
