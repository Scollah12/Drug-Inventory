<?php

namespace App\Http\Controllers;

use App\Models\DrugRequest;
use App\Models\Medicine;
use Illuminate\Http\Request;

class DrugRequestController extends Controller
{
    // Show all requests - for admin or all users
    public function index()
    {
        // Eager load medicine and user relations
        $requests = DrugRequest::with(['medicine', 'user'])->get();

        return view('drugrequests.index', compact('requests'));
    }

    // Show form to create a new drug request
    public function create()
    {
        $medicines = Medicine::all();
        return view('drugrequests.create', compact('medicines'));
    }

    // Store new drug request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Add additional required fields
        $validated['user_id'] = auth()->id();
        $validated['user_role'] = auth()->user()->user_role ?? 'user'; // fallback if null
        $validated['requested_by'] = auth()->user()->name ?? 'Unknown';
        $validated['status'] = 'pending';

        DrugRequest::create($validated);

        return redirect()->route('drugrequests.index')->with('success', 'Drug request created successfully.');
    }

    // Show specific drug request
    public function show($id)
    {
        $request = DrugRequest::with(['medicine', 'user'])->findOrFail($id);
        return view('drugrequests.show', compact('request'));
    }

    // Show form to edit drug request
    public function edit($id)
    {
        $request = DrugRequest::findOrFail($id);
        $medicines = Medicine::all();
        return view('drugrequests.edit', compact('request', 'medicines'));
    }

    // Update drug request
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,approved,rejected',
            // Normally user_id and user_role should not be updated by users/admin casually,
            // but you can include if needed.
        ]);

        $drugRequest = DrugRequest::findOrFail($id);
        $drugRequest->update($validated);

        return redirect()->route('drugrequests.index')->with('success', 'Drug request updated successfully.');
    }

    // Delete drug request
    public function destroy($id)
    {
        $drugRequest = DrugRequest::findOrFail($id);
        $drugRequest->delete();

        return redirect()->route('drugrequests.index')->with('success', 'Drug request deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:approved,declined',
    ]);

    $drugRequest = DrugRequest::findOrFail($id);
    $drugRequest->status = $request->status;
    $drugRequest->save();

    return redirect()->back()->with('success', 'Request status updated successfully.');
}

}
