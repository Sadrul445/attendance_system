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
        <li class="breadcrumb-item">Today's Attendances Report</li>
    @endcomponent
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div>
                    <button id="printToPdf" class="btn btn-danger" style="position: absolute; top: 0px; right: 13px;"> <i
                            class="icon-printer"></i> Print to PDF
                    </button>
                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        <div id="printableTable">
                            <div class="table-responsive">
                                <h2>Today's Attendance</h2>
                                <table class="table display table-hover" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">In Time</th>
                                            <th scope="col">Out Time</th>
                                            <th scope="col">Working Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $row)
                                            <tr>
                                                <td>{{ $row->date_time }}</td>
                                                <td scope="row">{{ $row->name }}</td>
                                                <td class="text-capitalize">
                                                    {{ $row->onLeave == true ? 'On Leave' : ($row->absent == true ? 'Absent' : 'Present') }}
                                                </td>
                                                <td>{{ $row->login_time }}</td>
                                                <td>{{ $row->logout_time }}</td>
                                                <td>{{ $row->working_time }}</td>
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
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById("printToPdf").addEventListener("click", function() {
            var printWindow = window.open('', '', 'width=950,height=800');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>LAP-Todays Attendance</title></head><body>');
            printWindow.document.write(
                '<style>table {width: 100%; border-collapse: collapse;} th, td {border: 1px solid #ddd; padding: 8px; text-align: left;} th {background-color: #60ff9d3d;} </style>'
                );
            printWindow.document.write(document.querySelector(".card-body").innerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        });
    </script>
@endpush
