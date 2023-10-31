<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
// use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /*
        Login
    */
    // ShowLoginPage
    public function showLoginPage(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        return view('attendance.in', compact('employee'));
    }
    // SubmitLogin
    public function submitLogin(Request $request)
    {
        $attendance = Attendance::where('created_at', '>', today())->where('email', $request->user_id)->where('type', 'login')->first();
        if (!$attendance) {
            $attendance = new Attendance();
        } else {
            session()->flash('alert', 'You have already logged in today');
            return redirect()->route('attendance.individual', ['employeeId' => $request->user_id]);
        }
        $attendance->type = 'login';
        $attendance->user_id = $request->user_id;
        $attendance->save();
        return redirect()->route('attendance.individual', ['employeeId' => $request->user_id]);
    }
    /*
        Logout
    */
    // ShowLogoutPage
    public function showLogoutPage(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        return view('attendance.out', compact('employee'));
    }
    // SubmitLogout
    public function submitLogout(Request $request)
    {

        $attendance = Attendance::where('created_at', '>', today())->where('email', $request->user_id)->where('type', 'logout')->first();
        if (!$attendance) {
            $attendance = new Attendance();
        } else {
            session()->flash('alert', 'You have already logged out today');
            return redirect()->route('attendance.individual', ['employeeId' => $request->user_id]);
        }
        $attendance->type = 'logout';
        $attendance->user_id = $request->user_id;
        $attendance->save();
        return redirect()->route('attendance.individual', ['employeeId' => $request->user_id]);
    }

    /*
        Leave
    */
    // ShowLeavePage
    public function showLeavePage(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        return view('attendance.leave', compact('employee'));
    }
    // SubmitLeave
    public function submitLeave(Request $request)
    {
        $attendance = new Attendance();
        $attendance->type = 'leave';
        $attendance->user_id = $request->user_id;
        $attendance->save();
        return redirect()->route('attendance.individual', ['employeeId' => $request->user_id]);
    }

    /*
        Attendances
    */
    // AttendancesToday for Admin Query
    public function attendancesToday(Request $request)
    {
        // Get all users with the 'employee' role
        $employees = User::where('role', 'employee')->get();
        $rows = [];

        foreach ($employees as $employee) {
            $row = new \stdClass();
            $row->name = $employee->name;
            $row->onLeave = (bool) Attendance::where('user_id', $employee->id)->where('type', 'leave')->where('created_at', '>', today())->first();
            $row->working_time = null;
            $row->date_time = null;

            if (!$row->onLeave) {
                $login = Attendance::where('user_id', $employee->id)->where('type', 'login')->where('created_at', '>', today())->first();
                if (!$login) {
                    $row->absent = true;
                    $row->login_time = null;
                    $row->date_time = null;
                } else {
                    $row->absent = false;
                    $row->login_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('h:i:s');
                    $row->date_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('d/m/Y');
                }

                $logout = Attendance::where('user_id', $employee->id)->where('type', 'logout')->where('created_at', '>', today())->first();
                if (!$logout) {
                    $row->logout_time = null;
                } else {
                    $row->logout_time = Carbon::parse($logout->created_at)->setTimezone('Asia/Dhaka')->format('h:i:s');
                    $row->working_time = Carbon::parse($logout->created_at)->longAbsoluteDiffForHumans(Carbon::parse($login->created_at));
                    $row->date_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('d/m/Y');
                }
            } else {
                $row->absent = false;
                $row->login_time = null;
                $row->logout_time = null;
                $row->date_time = null;
            }
            array_push($rows, $row);
        }
        return view('admin-dashboard.today-attendances')->with('rows', $rows);
    }
    public function dailyAttendanceReport(Request $request)
    {
        $selectedDate = $request->input('created_at');

        $selectedDate = Carbon::parse($selectedDate);
        $attendanceData = [];

        $employees = User::where('role', 'employee')->get();

        foreach ($employees as $employee) {
            $row = new \stdClass();
            $row->name = $employee->name;
            $row->onLeave = (bool) Attendance::where('user_id', $employee->id)
                ->where('type', 'leave')
                ->whereDate('created_at', $selectedDate)
                ->first();

            // Fetch login record for the selected date
            $login = Attendance::where('user_id', $employee->id)
                ->where('type', 'login')
                ->whereDate('created_at', $selectedDate)
                ->first();
    
    
                // Initialize default values
                $row->login_time = null;
                $row->logout_time = null;
                $row->working_time = null;
    
                if (!$row->onLeave) {
                    $login = Attendance::where('user_id', $employee->id)->where('type', 'login')->where('created_at', '>', today())->first();
    
                    if ($login) {
                        $row->absent = false;
                        $row->login_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('h:i:s');
                        $row->date_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('d/m/Y');
    
                        $logout = Attendance::where('user_id', $employee->id)->where('type', 'logout')->where('created_at', '>', today())->first();
    
                        if ($logout) {
                            $row->logout_time = Carbon::parse($logout->created_at)->setTimezone('Asia/Dhaka')->format('h:i:s');
                            $row->working_time = Carbon::parse($logout->created_at)->longAbsoluteDiffForHumans(Carbon::parse($login->created_at));
                            $row->date_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('d/m/Y');
                        } else {
                            $row->logout_time = null;
                        }
                    } else {
                        $row->absent = true;
                        $row->login_time = null;
                        $row->date_time = null;
                        $row->logout_time = null;
                    }
                } else {
                    $row->absent = false;
                    $row->login_time = null;
                    $row->logout_time = null;
                    $row->date_time = null;
                }
            // Group records by date (format as 'd-m-Y')
            $date = $selectedDate->format('d-m-Y');
            $attendanceData[$date][] = $row;
        }

        return view('admin-dashboard.daily-attendances', ['attendanceData' => $attendanceData]);
    }

    //individual attendance for Employees
    public function individualAttendance(Request $request, $id)
    {
        $employee = User::find($id);

        if (!$employee || $employee->role !== 'employee') {
            return abort(404);
        }

        $row = new \stdClass();
        $row->name = $employee->name;
        $row->date_time = null;
        $row->onLeave = false;
        $row->absent = false;
        $row->login_time = null;
        $row->logout_time = null;
        $row->working_time = null;

        // Check if the employee is on leave
        $leaveRecord = Attendance::where('user_id', $id)
            ->where('type', 'leave')
            ->where('created_at', '>', today())
            ->first();

        if ($leaveRecord) {
            $row->onLeave = true;
        } else {
            // Check for login record
            $loginRecord = Attendance::where('user_id', $id)
                ->where('type', 'login')
                ->where('created_at', '>', today())
                ->first();

            if ($loginRecord) {
                $row->login_time = Carbon::parse($loginRecord->created_at)
                    ->setTimezone('Asia/Dhaka')
                    ->format('h:i:s');
                $row->date_time = Carbon::parse($loginRecord->created_at)
                    ->setTimezone('Asia/Dhaka')
                    ->format('d/m/Y');
            } else {
                $row->absent = true;
            }

            // Check for logout record
            $logoutRecord = Attendance::where('user_id', $id)
                ->where('type', 'logout')
                ->where('created_at', '>', today())
                ->first();

            if ($logoutRecord) {
                $row->logout_time = Carbon::parse($logoutRecord->created_at)
                    ->setTimezone('Asia/Dhaka')
                    ->format('h:i:s');

                if ($loginRecord) {
                    $row->working_time = Carbon::parse($logoutRecord->created_at)
                        ->longAbsoluteDiffForHumans(Carbon::parse($loginRecord->created_at));
                } else {
                    $row->working_time = null;
                }
            } else {
                $row->logout_time = null;
                $row->working_time = null;
            }
        }

        return view('attendance.individual', compact('employee', 'row'));
    }
}
