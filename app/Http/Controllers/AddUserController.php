<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Notification;

class AddUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role'  => 'required|string',
        ]);

        // Generate login ID and plain password
        $loginId = 'ID' . rand(10000, 99999); // or use Str::random(8)
        $plainPassword = Str::random(10);
        $hashedPassword = Hash::make($plainPassword);

        // Create user
        $user = User::create([
            'login_id' => $loginId,
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => $hashedPassword,
        ]);

        // Store credentials in notifications table
        Notification::create([
            'user_id'           => $user->id,
            'login_id'          => $loginId,
            'generated_password'=> $plainPassword,
            'message'           => 'Your account has been created. Use these credentials to login.',
            'role'              => $user->role,
        ]);

        // Pass login ID and plain password to the view for popup
        return view('add_user', [
            'user_id'  => $loginId,
            'password' => $plainPassword
        ]);
    }
}
