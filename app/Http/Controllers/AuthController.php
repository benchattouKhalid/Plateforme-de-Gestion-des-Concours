<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Your login page
    }

    public function login(Request $request)
{
    $request->validate([
        'identifier' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = ['password' => $request->password];

    if (filter_var($request->identifier, FILTER_VALIDATE_EMAIL)) {
        $credentials['email'] = $request->identifier;

        if (Auth::guard('web')->attempt($credentials)) {
            return $this->redirectBasedOnRole(Auth::guard('web')->user());
        }
    } else {
        $credentials['candidatNumber'] = $request->identifier;

        if (Auth::guard('candidat')->attempt($credentials)) {
            return redirect()->intended('/condidat/dashboard');
        }
    }

    return redirect()->back()->withErrors(['error' => 'Invalid credentials or user not found.']);
}


// Redirect users based on their role
protected function redirectBasedOnRole($user)
{
    switch ($user->role) {
        case 'admin':
            return redirect()->intended('/admin/dashboard');
        case 'gestionnaire_global':
            return redirect()->intended('/gestionnaire-global/dashboard');
        case 'gestionnaire_local':
            return redirect()->intended('/gestionnaire-local/dashboard');
        default:
            Auth::logout();
            return redirect('/')->withErrors(['error' => 'Unauthorized access.']);
    }
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
