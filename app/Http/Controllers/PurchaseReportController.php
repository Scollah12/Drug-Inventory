<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class PurchaseReportController extends Controller
{
    public function index()
    {
        $reportData = DB::table('suppliers as s')
            ->leftJoin('purchases as p', 's.sup_id', '=', 'p.sup_id')
            ->select('s.company_name', DB::raw('COUNT(p.id) as total_purchases'), DB::raw('SUM(p.quantity * p.price) as total_cost'))
            ->groupBy('s.sup_id', 's.company_name')
            ->orderByDesc('total_cost')
            ->get();

        return view('suppliermodule.report', compact('reportData'));
    }
}
