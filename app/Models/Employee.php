<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model {

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'department_id',
        'status',
        'created_by',
        'updated_at',
    ];

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }

    public function skills(): BelongsToMany {
        return $this->belongsToMany(Skill::class);
    }

    public function getFullNameAttribute(): string {
        return "{$this->first_name} {$this->last_name}";
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class,'created_by','id');
    }
    
    public function updatedBy(): BelongsTo {
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
