<?php

namespace App\Models;

use App\Observers\HolidayObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(HolidayObserver::class)]
class Holiday extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'calendar_id',
        'user_id',
        'day',
        'type',
    ];

    /**
     * Get the user that owns the Holiday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the calendar that owns the Holiday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function calendar(): BelongsTo
    {
        return $this->belongsTo(Calendar::class);
    }
}
