<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Medicine;
use Illuminate\Http\Request;



class AnomalyReportController extends Controller
{
    public function index()
    {
        $thresholdQuantity = 100;

        $alerts = Medicine::where('quantity', '<', $thresholdQuantity)
                    ->orWhere('expiry_date', '<', now())
                    ->get();

    


        return view('druginventorymodule.anomally_report', compact('alerts'));

}

}

