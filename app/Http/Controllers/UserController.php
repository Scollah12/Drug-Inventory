<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Import Notification model

class UserController extends Controller
{
    // Show the Add User form
    public function showForm()
    {
        return view('add_user'); // Return the view with the form
    }

    // Handle the form submission
    public function storeUser(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:Admin,User', // Add roles as necessary
        ]);

        // Generate a random user ID
        $user_id = rand(1000, 9999);

        // Generate a random password
        $password = bin2hex(random_bytes(4));

        // Create the notification message
        $message = "New user created. ID: {$user_id}, Password: {$password}";

        // Insert the notification into the `notification` table
        Notification::create([
            'notification' => $message,
        ]);

        // Passing data to the view (user ID and password)
        return view('add_user', compact('user_id', 'password'));
    }
}
