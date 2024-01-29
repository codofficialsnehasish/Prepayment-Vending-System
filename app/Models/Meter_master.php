<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meter_master extends Model
{
    use HasFactory;
    protected $table = "meter_master";
    protected $primaryKey = "id";
}
