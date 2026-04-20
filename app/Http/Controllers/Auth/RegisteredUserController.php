<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Show the prepare registration form for a given user type.
     */
    public function prepare(Request $request, $type)
    {
        $type = in_array($type, ['estudiante', 'maestro']) ? $type : 'estudiante';
        return view('auth.prepare-register', ['user_type' => $type]);
    }

    /**
     * Store the prepare step (email + name) in session and redirect to full register form.
     */
    public function prepareStore(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'name' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'in:estudiante,maestro'],
        ]);

        Session::put('reg_name', $data['name']);
        Session::put('reg_email', $data['email']);
        Session::put('reg_user_type', $data['user_type']);

        return redirect()->route('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:estudiante,maestro'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Clear temporary registration session values
        Session::forget(['reg_name', 'reg_email', 'reg_user_type']);

        return redirect(route('dashboard', absolute: false));
    }
}
