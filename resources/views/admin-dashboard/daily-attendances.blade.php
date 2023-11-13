@extends('admin-dashboard.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatable-extension.css') }}">
@endpush
@includeIf('admin-dashboard.partials.css')
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
            <div class="col-sm-10 mx-auto">
                <div class="card py-5 shadow">
                    <form action="{{ route('admin-dashboard.daily-attendances') }}" method="GET">
                        @csrf
                        <div class="d-flex justify-content-center">
                            <label for="selected_date" class="form-label pt-2">Select Date:</label>
                            <input type="date" class="form-control w-25 mx-4 shadow" id="selected_date"
                                name="created_at">
                            <button type="submit" class="btn btn-outline-secondary shadow">Show
                                Attendances</button>
                        </div>
                        <div>
                            <button id="printToPdf" class="btn btn-danger shadow"
                                style="position: absolute; bottom: 1.4rem; right: 1.8rem"> <i class="icon-printer"></i>
                                Print to PDF
                            </button>
                        </div>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (isset($attendanceData) && count($attendanceData) > 0)
                                @foreach ($attendanceData as $date => $records)
                                    <table class="table display table-hover mt-4" id="basic-1">
                                        <h5 style="color:#0089D0" class="ms-2 mb-4">Today's Attendance
                                            <strong>{{ \Carbon\Carbon::now()->toFormattedDateString() }}</strong>
                                        </h5>
                                        <thead>
                                            <tr style="font-size: 15px">
                                                <th scope="col">Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">In Time</th>
                                                <th scope="col">Out Time</th>
                                                <th scope="col">Working Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($records as $row)
                                                <tr style="font-size: 14px">
                                                    <td scope="row">{{ $row->name }}</td>
                                                    <td>{!! $row->onLeave
                                                        ? '<strong style="font-size:10px;background-color: #ba895d;color:white;border-radius:40px;padding:7px">' . 'On Leave' . '</strong>'
                                                        : ($row->absent
                                                            ? '<strong style="font-size:10px;background-color: red;color:white;border-radius:40px;padding:7px">' . 'Absent' . '</strong>'
                                                            : '<strong style="font-size:10px;background-color: #0DB14B;color:white;border-radius:40px;padding:7px">' . 'Present' . '</strong>') !!}</td>
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

@push('scripts')
    <script>
        document.getElementById("printToPdf").addEventListener("click", function() {
            var printWindow = window.open('', '', 'width=950,height=800');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>LAP-Attendance Management System</title></head><body>');
            printWindow.document.write('<h6>LAP-Attendance Management System</h6>');
            printWindow.document.write(
                '<style>' +
                'body { font-family: Arial; }' +
                'h6 { font-size: 15px; font-weight: 600; }' +
                'table { width: 100%; border-collapse: collapse; margin-top: 20px; }' +
                'th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }' +
                'th { background-color: #B0DAF0; }' +
                '</style>'
            );

            printWindow.document.write('<table>');
            var originalTable = document.querySelector(".card-body table");
            if (originalTable) {
                printWindow.document.write(originalTable.innerHTML);
            }
            printWindow.document.write('</table>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        });
    </script>
@endpush
