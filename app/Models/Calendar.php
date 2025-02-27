<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Calendar extends Model
{
    protected $fillable = [
        'name',
        'year',
        'active',
    ];

    public function holidays(): HasMany {
        return $this->hasMany(Holiday::class);
    }

    public function timesheets(): HasMany {
        return $this->hasMany(Timesheet::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
