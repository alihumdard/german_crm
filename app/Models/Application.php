<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'applicant_id',
        'job_id',
        'employer_id',
        'portfolio_website',
        'cover_message',
        'status',
        'created_by',
        'updated_by',
    ];

    // Relationship with User (applicant)
    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Opportunity::class, 'job_id');
    }

    // Relationship with Employer
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function interview()
    {
        return $this->hasOne(Interview::class);
    }
}
