<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'dob',
        'id_document',
        'role',
        'password',
        'phone',
        'address',
        'apartment',
        'gender',
        'zip_code',
        'city',
        'state',
        'status',
        'speciality',
        'short_bio',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function documents()
    {
        return $this->hasMany(UserDocument::class);
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }

    public function experiences()
    {
        return $this->hasMany(UserExperience::class, 'user_id');
    }

    // For employees (candidates) who have been assigned jobs by agents
    public function assignedJobs()
    {
        return $this->hasMany(AgentAssignment::class, 'employee_id');
    }

    // For agents who assign jobs to employees
    public function assignedEmployees()
    {
        return $this->hasMany(AgentAssignment::class, 'agent_id');
    }
}
