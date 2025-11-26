<?php

// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['item_name', 'quantity', 'price', 'status', 'sup_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id', 'sup_id');
        
    }
}

