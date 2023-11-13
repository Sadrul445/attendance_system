@extends('admin-dashboard.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('admin-dashboard.partials.css')
@section('title', 'List of Employee')

@section('content')
    @component('components.breadcrumb')
        @slot('bredcrumb_title')
            Home
        @endslot
        <li class="breadcrumb-item">List of Employee</li>
    @endcomponent
    <!-- Date selection form -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card py-5 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table display table-hover mt-4" id="basic-1">
                                <h5 style="color:#0089D0" class="ms-2">Attendance for
                                    <strong>02-11-2023</strong>
                                </h5>
                                <thead>
                                    <tr style="font-size: 15px">
                                        <th scope="col">Employee ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr style="font-size: 14px">
                                            <td scope="row">#0{{ $employee->id }}</td>
                                            <td scope="row">{{ $employee->name }}</td>
                                            <td scope="row">{{ $employee->email }}</td>
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
