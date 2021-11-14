<?php

namespace App\Models;

use App\Trait\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,SearchableTrait,SoftDeletes;

    public $guarded = [];

    protected $dates = ['deleted_at'];
}
