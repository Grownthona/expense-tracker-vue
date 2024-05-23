<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthlybudget extends Model
{
    use HasFactory;
    protected $table = 'monthlybudgets';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
