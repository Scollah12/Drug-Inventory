<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Notification;
class AdminController extends Controller
{
    

public function showAddUserForm() {
    return view('add-user');
}

public function storeUser(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'login_id' => 'required|string|unique:users,login_id',
        'password' => 'required|string|min:6',
        'role' => 'required|string|in:pharmacy,supplier,manager,user'
    ]);

    User::create([
        'name' => $request->name,
        'login_id' => $request->login_id,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    return redirect()->back()->with('success', 'User added successfully!');




}}
