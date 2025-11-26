<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['sup_id', 'purchase_date', 'amount']; // Add more if needed

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id', 'sup_id');
    }
}
