<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\DrugRequest;


class PharmacistController extends Controller
{
    public function dashboard()
    {
   
    $totalDrugs = Medicine::count();

    $pendingRequests = DrugRequest::where('status', 'pending')->count();

    $outOfStock = Medicine::where('quantity', 0)->count();


    return view('pharmacist-dashboard', compact('totalDrugs', 'pendingRequests', 'outOfStock'));
}
}
