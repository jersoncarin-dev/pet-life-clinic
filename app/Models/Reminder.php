<?php

namespace App\Models;

use App\Trait\SearchableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory,SearchableTrait;

    public $guarded = [];
}
