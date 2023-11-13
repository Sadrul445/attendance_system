<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('authentication.registration.register');
        // return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->update(['role' => $request->role]); // Assuming there's a 'role' field in your registration form.

        event(new Registered($user));

        Auth::login($user);

        // Redirect the user based on their role
         if ($user->role === 'admin') {
            return redirect(RouteServiceProvider::ADMIN_HOME);
        } elseif ($user->role === 'employee') {
            return redirect(RouteServiceProvider::EMPLOYEE_HOME);
        } else {
        // Add a default route for other roles (if needed)
            return redirect()->route('employee.dashboard');
        }
    }

}
