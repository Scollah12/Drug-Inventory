<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    // Show form to admin to send notification
    public function create()
    {
        $users = User::all(); // Get all users for the dropdown
        $notifications = Notification::latest()->get(); // Optional: limit this

        return view('admin.send_notification', compact('users', 'notifications'));
    }

    // Store the notification
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|integer',
            'role' => 'nullable|string',
            'notification' => 'required|string',
        ]);

        // If a specific user is selected
        if ($request->filled('user_id')) {
            Notification::create([
                'user_id' => $request->user_id,
                'role' => User::find($request->user_id)?->user_role ?? 'unknown',
                'notification' => $request->notification,
            ]);
        }
        // Otherwise, send to all users of the selected role
        elseif ($request->filled('role')) {
            $users = User::where('user_role', $request->role)->get();

            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'role' => $user->user_role,
                    'notification' => $request->notification,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    // Show notifications to logged-in user on their dashboard
    public function userNotifications()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)
                                      ->orWhere('role', $user->user_role)
                                      ->latest()
                                      ->get();

        return view('user-dashboard', [
            'notifications' => $notifications,
            'user' => $user
        ]);
    }

    // Show notifications for a specific user (manual access)
    public function show(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'role' => 'required|string',
        ]);

        $notifications = Notification::where('user_id', $request->user_id)
                                      ->orWhere('role', $request->role)
                                      ->latest()
                                      ->get();

        return view('user.notifications', compact('notifications'));
    }
}
