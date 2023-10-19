<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /*
        Login
    */
    // ShowLoginPage
    public function showLoginPage(Request $request)
    {
        $employees = Employee::all();
        return view('attendance.in')->with('employees', $employees);
    }
    // SubmitLogin
    public function submitLogin(Request $request)
    {
        $attendance = Attendance::where('created_at', '>', today())->where('employee_id', $request->employee_id)->where('type', 'login')->first();
        if (!$attendance) {
            $attendance = new Attendance();
        }
        else{
            session()->flash('alert','You have already logged in today');
            return redirect()->route('attendance.in');
        }
        $attendance->type = 'login';
        $attendance->employee_id = $request->employee_id;
        $attendance->save();
        return redirect('/in');
    }
    /*
        Logout
    */
    // ShowLogoutPage
    public function showLogoutPage(Request $request)
    {
        $employees = Employee::all();
        return view('attendance.out')->with('employees', $employees);
    }
    // SubmitLogout
    public function submitLogout(Request $request)
    {
        
        $attendance = Attendance::where('created_at', '>', today())->where('employee_id', $request->employee_id)->where('type', 'logout')->first();
        if (!$attendance) {
            $attendance = new Attendance();
        } else {
            return response()->json([
                'message' => 'You have already logged out today'
            ], 400);
        }
        $attendance->type = 'logout';
        $attendance->employee_id = $request->employee_id;
        $attendance->save();
        return redirect('/out');
    }

    /*
        Leave
    */
    // ShowLeavePage
    public function showLeavePage(Request $request)
    {
        $employees = Employee::all();
        return view('attendance.leave')->with('employees', $employees);
    }
    // SubmitLeave
    public function submitLeave(Request $request)
    {
        $attendance = new Attendance();
        $attendance->type = 'leave';
        $attendance->employee_id = $request->employee_id;
        $attendance->save();
        return redirect('/leave');
    }

    /*
        Attendances
    */
    // AttendancesToday
    public function attendancesToday(Request $request)
    {
        $employees = Employee::all();
        $rows = [];
        foreach ($employees as $employee) {
            $row = new \stdClass();
            $row->name = $employee->name;
            $row->onLeave = (bool) Attendance::where('employee_id', $employee->id)->where('type', 'leave')->where('created_at', '>', today())->first();
            $row->working_time = null;
            $row->date_time = null;
            if (!$row->onLeave) {
                $login = Attendance::where('employee_id', $employee->id)->where('type', 'login')->where('created_at', '>', today())->first();
                if (!$login) {
                    $row->absent = true;
                    $row->login_time = null;
                    $row->date_time = null;
                } else {
                    $row->absent = false;
                    $row->login_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('h:i:s');
                    $row->date_time = Carbon::parse($login->created_at)->setTimezone('Asia/Dhaka')->format('d/m/Y');
                }
                $logout = Attendance::where('employee_id', $employee->id)->where('type', 'logout')->where('created_at', '>', today())->first();
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
        return view('dashboard.daily-attendances')->with('rows', $rows);
    }
}
