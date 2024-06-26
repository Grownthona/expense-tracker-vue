<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $table = 'budgets';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
