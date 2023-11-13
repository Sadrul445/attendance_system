<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeeAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $employeeId = $request->route('employeeId');
        
        // Check if the authenticated user is an employee and their ID matches the requested employeeId
        if (auth()->check() && auth()->user()->role === 'employee' && auth()->user()->id == $employeeId) {
            return $next($request);
        }
        
        return redirect()->route('employee-attendance.individual', ['employeeId' => $employeeId])->with('error', 'Unauthorized To Access Another Employee`s Profile');
    }
}
