<?php

namespace App\Http\Controllers;
use App\Models\Medicine;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoryController extends Controller
{
    public function index()
    {
        return view('druginventorymodule.druginventorydashboard');

    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|unique:medicines,medicine_id',
            'medicine_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string',
            'expiry_date' => 'required|date',
        ]);

        Medicine::create([
            'medicine_id' => $request->medicine_id,
            'medicine_name' => $request->medicine_name,
            'location' => $request->location,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('medicine.create')->with('success', 'Medicine added successfully!');
    }

    public function create()
 {
    return view('druginventorymodule.add_medicine'); 
 }

public function viewMedicine(Request $request)
    {
        // Start a query builder to fetch all medicines
        $query = DB::table('medicines');

        // Check if the search term is provided
        if ($request->has('search') && $request->input('search_term') != '') {
            $term = $request->input('search_term');
            $query->where('medicine_name', 'LIKE', "%$term%")
                  ->orWhere('medicine_id', '=', $term);
        }

        // Get the medicines based on the query
        $medicines = $query->get();

        // Return the view with the medicines data
        return view('druginventorymodule.view_medicine', compact('medicines'));
    }

  public function indexx(Request $request)
    {
        $medicines = [];

        if ($request->isMethod('post')) {
            if ($request->has('view_all')) {
                $medicines = Medicine::all();
            }

            if ($request->has('search')) {
                $request->validate([
                    'search_term' => 'required|string',
                ]);
                $term = $request->input('search_term');
                $medicines = Medicine::where('medicine_name', 'LIKE', "%$term%")
                                     ->orWhere('medicine_id', $term)
                                     ->get();
            }
        }

        return view('druginventorymodule.update_medicine', compact('medicines'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'update_id' => 'required|exists:medicines,medicine_id',
            'medicine_name' => 'required|string',
            'location' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string',
            'expiry_date' => 'required|date',
        ]);

        $medicine = Medicine::find($request->update_id);

        if (!$medicine) {
        return redirect()->back()->with('error', 'Medicine not found.');
    }
        $medicine->update([
            'medicine_name' => $request->medicine_name,
            'location' => $request->location,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->back()->with('success', 'Medicine updated successfully.');
    }

    

   
    public function showExpiryForm()
    {
        return view('druginventorymodule.expiring');
    }

    public function filterExpiry(Request $request)
    {
        $today = Carbon::today();
        $thirtyDaysLater = Carbon::today()->addDays(30);
        $expiringMeds = collect();

        if ($request->has('view_all')) {
            $expiringMeds = Medicine::where('expiry_date', '<=', $thirtyDaysLater)->get();
        } elseif ($request->has('view_expiring')) {
            $expiringMeds = Medicine::where('expiry_date', '>', $today)
                                      ->where('expiry_date', '<=', $thirtyDaysLater)
                                      ->get();
        } elseif ($request->has('view_expired')) {
            $expiringMeds = Medicine::where('expiry_date', '<', $today)->get();
        }

        return view('druginventorymodule.expiring', compact('expiringMeds', 'today'));
    
    }

   
    // Show the Delete Medicine page
    public function showDeleteMedicinePage(Request $request)
    {
        $search_result = collect();

        // Handle search or view all functionality
        if ($request->isMethod('post')) {
            if ($request->has('search') && $request->search_term != '') {
                $term = $request->search_term;

                // Search by medicine name or ID
                $search_result = Medicine::where('medicine_name', 'like', "%$term%")
                    ->orWhere('medicine_id', $term)
                    ->get();
            } elseif ($request->has('view_all')) {
                // Fetch all medicines from the database when 'view_all' is clicked
                $search_result = Medicine::all();
            }
        }

        return view('druginventorymodule.delete_medicine', compact('search_result'));
    }

    // Delete the medicine from the database
    public function deleteMedicine(Request $request)
 {
Log::info('Delete request received', $request->all());


if ($request->has('delete') && $request->has('delete_id')) {
    $delete_id = $request->delete_id;

    DB::beginTransaction();

    try {
        // Optional: Check if medicine exists before deleting related inventory_log entries
        $medicine = Medicine::findOrFail($delete_id);

        DB::table('inventory_log')->where('medicine_id', $delete_id)->delete();

        $medicine->delete();

        DB::commit();

        Log::info('Medicine deleted successfully.', ['medicine_id' => $delete_id]);

        return redirect()->route('delete_medicine')->with('success', 'Medicine deleted successfully!');
    } catch (\Exception $e) {
        DB::rollBack();

        Log::error('Error deleting medicine', ['message' => $e->getMessage()]);

        return redirect()->route('delete_medicine')->with('error', 'An error occurred while deleting the medicine.');
    }
 }

 Log::warning('Delete request missing required parameters.');

 return redirect()->route('delete_medicine')->with('error', 'Invalid delete request.');
 }

 public function clearLog()
    {
        
        try {
            
            DB::statement('TRUNCATE TABLE medicines');
            
            // Redirect with a success message
            return redirect()->route('anomaly.report')->with('cleared', 1);
        } catch (\Exception $e) {
            // Return an error message if something goes wrong
            return response()->json(['error' => 'Failed to clear medicine data: ' . $e->getMessage()], 500);
        }
    }

}
  


