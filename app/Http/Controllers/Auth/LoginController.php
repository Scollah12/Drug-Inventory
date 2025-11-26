<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

  public function login(Request $request)
{
    $request->validate([
        'login_id' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('login_id', $request->login_id)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);

            switch ($user->role) {
                case 'Pharmacist':
                    return redirect()->route('pharmacist.dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'Inventory Manager':
                    return redirect()->route('inventory.dashboard');
                case 'Supplier':
                    return redirect()->route('suppliers.index');
                default:
                    return redirect()->route('userdashboard');
            }
        }

        return back()->with('error', 'Invalid credentials or role.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('error', 'Logged out successfully.');
    }
}
