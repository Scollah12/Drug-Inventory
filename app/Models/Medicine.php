<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    // Define the table name (optional if it follows naming convention)
    protected $table = 'medicines'; 

    // Define which attributes can be mass-assigned (for security)
    protected $fillable = [
        'medicine_id',
        'medicine_name',
        'location',
        'price',
        'quantity',
        'category',
        'expiry_date',
    ];

    // If you need to format date attributes (optional)
    protected $dates = ['expiry_date'];

    // If you want to make any date fields automatically formatted
    protected $casts = [
        'expiry_date' => 'datetime',
    ];
}
