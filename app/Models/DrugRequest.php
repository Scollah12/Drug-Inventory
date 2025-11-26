<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugRequest extends Model
{
    use HasFactory;

    protected $table = 'drugrequests';

    protected $fillable = [ 'medicine_id','user_id','user_role','requested_by','quantity', 'status'];

    public function medicine()
{
    return $this->belongsTo(Medicine::class, 'medicine_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

   }

