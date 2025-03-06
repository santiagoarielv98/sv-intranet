<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveType extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveTypeFactory> */
    use HasFactory;

    protected $fillable = ['name', 'max_days'];

    public function leaves():HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
