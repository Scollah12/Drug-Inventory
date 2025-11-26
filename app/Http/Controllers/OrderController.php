<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Supplier;

class OrderController extends Controller
{
    public function pendingOrders($sup_id = null)
{
    $query = Order::join('suppliers', 'orders.sup_id', '=', 'suppliers.sup_id')
        ->where('orders.status', '!=', 'completed');
    
    if ($sup_id) {
        $query->where('orders.sup_id', $sup_id);
    }
    
    $orders = $query->orderByDesc('orders.id')->get();

    $supplier = $sup_id ? Supplier::find($sup_id) : null;

        return view('suppliermodule.order-view', compact('orders', 'sup_id', 'supplier'));
    }
}
