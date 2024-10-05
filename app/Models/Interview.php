<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'application_id',
        'applicant_id',
        'status',
        'agent_remarks',
        'employer_remarks',
        'interview_date',
    ];

    // Relationship with the Application model
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

}
