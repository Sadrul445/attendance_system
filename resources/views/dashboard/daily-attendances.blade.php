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
        <li class="breadcrumb-item">Daily Attendances Report</li>
    @endcomponent
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h2>Today's Attendance</h2>
                            <table class="table display table-hover" id="basic-1">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Login Time</th>
                                        <th scope="col">Logout Time</th>
                                        <th scope="col">Working Time</th>
                                        <th scope="col">Date</th>
                                        {{-- <th scope="col">Action</th> --}}
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
                                            {{-- <td>
                                                <div class="d-flex">
                                                <form action="/in" method="post">
                                                </form>
                                                    <div>
                                                        <a href="{{ route('attendance.in', ['id' => $row->name]) }}"
                                                            class="btn btn-outline-secondary">In</a>
                                                    </div>
                                                    <div style="margin-left:5px">
                                                        <a href="{{ route('attendance.out', ['id' => $row->name]) }}"
                                                            class="btn btn-outline-danger">Out</a>
                                                    </div>
                                                    <div style="margin-left:5px">
                                                        <a href="{{ route('attendance.leave', ['id' => $row->name]) }}"
                                                            class="btn btn-outline-primary">Leave</a>
                                                    </div>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script>
        function toggleCollapse(id) {
            const contentDiv = document.getElementById(`collapseContent${id}`);
            const linkTextSpan = document.getElementById(`collapseLinkText${id}`);

            if (contentDiv.style.maxHeight) {
                // Collapse the content
                contentDiv.style.maxHeight = null;
                linkTextSpan.textContent = "See More";
            } else {
                // Expand the content
                contentDiv.style.maxHeight = contentDiv.scrollHeight + "px";
                linkTextSpan.textContent = "See Less";
            }
        }
    </script> --}}
@endpush
