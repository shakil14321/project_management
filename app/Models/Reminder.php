<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
     protected $fillable = ['text', 'link', 'is_active'];
}
