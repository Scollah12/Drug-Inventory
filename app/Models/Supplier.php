<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'sup_id';

    protected $fillable = [
        'company_name',
        'address',
        'phone_number',
        'email_address',
        'rating',
    ];

  
    protected $table = 'suppliers';

 

    public $timestamps = false;

   
}







