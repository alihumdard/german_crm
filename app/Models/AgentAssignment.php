<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'agent_id', 'employee_id', 'assigned_at'];

    // Relationship with Job
    public function job()
    {
        return $this->belongsTo(Opportunity::class, 'job_id');
    }

    // Relationship with Agent (User)
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    // Relationship with Employee (User)
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
