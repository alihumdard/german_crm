<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'qualifications',
        'salary_range',
        'currency',
        'location',
        'description',
        'desired_salary',  // Added
        'skills',          // Added
        'user_id',
        'created_by',
        'updated_by',
    ];

    protected $dates = ['deleted_at'];

    // Define the relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
