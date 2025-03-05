<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Attendance extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'check_in',
        'check_out',
        'location',
        'ip_address',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    protected function hoursWorked(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->check_out) {
                    $checkIn = new \DateTime($this->check_in);
                    $checkOut = new \DateTime($this->check_out);
                    $interval = $checkIn->diff($checkOut);
                    return $interval->format('%H:%I:%S');
                }
            }
        );
    }
}
