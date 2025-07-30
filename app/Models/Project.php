<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
   protected $fillable = [
    'date', 'client', 'number', 'email', 'company_address' , 'details', 'project_type', 'proposal', 'budget', 'status',];
}
