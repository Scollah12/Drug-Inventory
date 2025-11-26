<?php

namespace App\Http\Controllers;

 use Illuminate\Http\Request;
use App\Models\Medicine;
use Carbon\Carbon;

class ChatbotController extends Controller
{
   public function handleMessage(Request $request)
{
    $request->validate(['msg' => 'required|string']);
    $msg = strtolower(trim($request->msg));
    $response = '';

    if ($msg === 'anomalies') {
        $logs = Medicine::orderByDesc('updated_at')->get();
        $latest = [];

        foreach ($logs as $log) {
            $id = $log->medicine_id;
            if (!isset($latest[$id])) {
                $latest[$id] = $log;
            }
        }

        foreach ($latest as $id => $log) {
            $recentLogs = Medicine::where('medicine_id', $id)
                ->orderByDesc('updated_at')
                ->take(2)
                ->pluck('quantity')
                ->toArray();

            if (count($recentLogs) == 2) {
                [$curr, $prev] = $recentLogs;
                if ($prev > 0) {
                    $drop = (($prev - $curr) / $prev) * 100;
                    if ($drop > 30) {
                        $response .= "Medicine ID $id dropped by " . round($drop, 2) . "%<br/>";
                    }
                }
            }
        }

        $response = $response ?: "No anomalies found.";
    } elseif ($msg === 'low stock') {
        $lowStock = Medicine::where('quantity', '<', 10)->get();
        if ($lowStock->isNotEmpty()) {
            foreach ($lowStock as $item) {
                $response .= "{$item->medicine_name} (ID: {$item->medicine_id}) - Qty: {$item->quantity}<br/>";
            }
        } else {
            $response = "All stock levels are healthy.";
        }
    } elseif ($msg === 'expiring') {
        $today = now();
        $expiring = Medicine::whereDate('expiry_date', '<=', $today->copy()->addDays(30))->get();
        if ($expiring->isNotEmpty()) {
            foreach ($expiring as $item) {
                $response .= "{$item->medicine_name} - Expires: {$item->expiry_date}<br/>";
            }
        } else {
            $response = "No medicines expiring soon.";
        }
    } else {
        $response = "I can help with:<br/>- 'anomalies'<br/>- 'low stock'<br/>- 'expiring'";
    }

    return response($response);
}

}



