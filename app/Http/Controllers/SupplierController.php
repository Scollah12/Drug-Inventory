<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    // Display all suppliers with search
    public function index(Request $request)
    {
        $search = $request->input('search');

        $suppliers = Supplier::when($search, function ($query, $search) {
            return $query->where('company_name', 'like', "%$search%")
                         ->orWhere('sup_id', 'like', "%$search%");
        })->orderBy('company_name')->get();

        return view('suppliermodule.supplier-view', compact('suppliers', 'search'));
    }

    // Add a new supplier
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string|max:20',
            'email_address' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('flash_message', [
            'type' => 'success',
            'message' => 'Supplier added successfully.'
        ]);
    }

    // Delete supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('flash_message', [
            'type' => 'success',
            'message' => 'Supplier deleted successfully.'
        ]);
    }

   public function editForm(Request $request)
{
    $supplierId = $request->input('sup_id') ?? session('edit_supplier_id');

    $supplier = Supplier::findOrFail($supplierId);


   return view('suppliermodule.supplier-edit', compact('supplier'));

}


   public function update(Request $request)
{
    $request->validate([
        'sup_id' => 'required|exists:suppliers,sup_id',
        'company_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone_number' => 'required|digits:10',
        'email_address' => 'required|email|max:255',
        'rating' => 'required|integer|between:1,5',
    ]);

    $supplier = Supplier::find($request->input('sup_id'));

    $supplier->update($request->only([
        'company_name', 'address', 'phone_number', 'email_address', 'rating'
    ]));

    return redirect()->route('supplier.edit', ['sup_id' => $supplier->sup_id])
        ->with('flash_message', ['type' => 'success', 'message' => 'Supplier updated successfully']);
}

    }