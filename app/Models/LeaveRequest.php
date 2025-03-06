<?php

namespace App\Models;

use App\Observers\LeaveRequestObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[ObservedBy([LeaveRequestObserver::class])]
class LeaveRequest extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'status',
        'comments',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }
}
