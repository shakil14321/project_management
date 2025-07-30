<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    protected $fillable = [
        'date',
        'client',
        'number',
        'email',
        'company_address',
        'details',
        'project_type',
        'proposal',
        'budget',
        'status',
        'reminder_date', 
        'user_id',         
        'remark',
    ];

    // This must be inside the class
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
