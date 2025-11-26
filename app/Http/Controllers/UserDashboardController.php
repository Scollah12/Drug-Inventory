<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DrugRequest;
use App\Models\Medicine; // Make sure this model corresponds to medicines table
use App\Models\Notification;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $approved = DrugRequest::where('user_id', $user->id)->where('status', 'approved')->count();
        $declined = DrugRequest::where('user_id', $user->id)->where('status', 'declined')->count();
        $pending = DrugRequest::where('user_id', $user->id)->where('status', 'pending')->count();

        $recentActivity = DrugRequest::where('user_id', $user->id)->latest()->take(5)->get();

        // Fetch medicines from the medicines table
        $medicines = Medicine::all();

        $notifications = Notification::where('user_id', $user->id)->latest()->get();

        return view('user-dashboard', compact(
            'user',
            'approved',
            'declined',
            'pending',
            'recentActivity',
            'medicines',
            'notifications'
        ));
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id', // validate against medicines table
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();

        DrugRequest::create([
            'userid' => $user->id,
            'drugid' => $request->medicine_id, // store medicine id as drugid
            'quantity' => $request->quantity,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Drug request submitted successfully.');
    }
}
