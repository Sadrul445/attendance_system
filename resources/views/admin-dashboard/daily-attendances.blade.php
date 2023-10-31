@extends('dashboard')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('attendance.partials.css')
@section('title', 'Daily Attendances Report')

@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">Attendance Report</li>
    @endcomponent
    <!-- Date selection form -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('admin-dashboard.daily-attendances') }}" method="GET">
                                @csrf
                                <div class="d-flex justify-content-center">
                                    <label for="selected_date" class="form-label pt-2">Select Date:</label>
                                    <input type="date" class="form-control w-25 mx-4" id="selected_date" name="created_at">
                                    <button type="submit" class="btn btn-outline-secondary">Show Attendances</button>
                                </div>
                            </form>

                            @if (isset($attendanceData) && count($attendanceData) > 0)
                                @foreach ($attendanceData as $date => $records)
                                    <h5>Attendance for {{ $date }}</h5>
                                    <table class="table display table-hover" id="basic-1">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Login Time</th>
                                                <th scope="col">Logout Time</th>
                                                <th scope="col">Working Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($records as $row)
                                                <tr>
                                                    <th scope="row">{{ $row->name }}</th>
                                                    <td class="text-capitalize">
                                                        {{ $row->onLeave ? 'On Leave' : ($row->absent ? 'Absent' : 'Present') }}
                                                    </td>
                                                    <td>{{ $row->login_time }}</td>
                                                    <td>{{ $row->logout_time }}</td>
                                                    <td>{{ $row->working_time }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
