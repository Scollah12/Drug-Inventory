<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $supplierName = $request->query('supplier_name');
        $sup_id = '';
        $supplier_name = '';
        $whereClause = null;

        if (!empty($supplierName)) {
            $supplier = Supplier::where('company_name', 'LIKE', '%' . $supplierName . '%')->first();

            if ($supplier) {
                $sup_id = $supplier->sup_id;
                $supplier_name = $supplier->company_name;
                $whereClause = ['purchases.sup_id' => $supplier->sup_id];
            } else {
                $whereClause = ['suppliers.company_name', 'LIKE', '%' . $supplierName . '%'];
            }
        }

        $query = Purchase::join('suppliers', 'purchases.sup_id', '=', 'suppliers.sup_id')
            ->select('purchases.*', 'suppliers.sup_id', 'suppliers.company_name')
            ->when($whereClause, function ($q) use ($whereClause) {
                if (is_array($whereClause)) {
                    return $q->where(...$whereClause);
                }
                return $q;
            })
            ->orderBy('purchase_date', 'desc')
            ->get();

        return view('suppliermodule.purchase-view', [
            'purchases' => $query,
            'supplier_name' => $supplier_name,
        ]);
    }
}
