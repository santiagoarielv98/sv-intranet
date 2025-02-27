<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'postal_code',
        'country_id',
        'state_id',
        'city_id',
        'hire_date',
        'position_id',
        'salary',
        'status',
    ];

    protected $casts = [
        'hire_date' => 'date',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->first_name} {$this->last_name}"
        );
    }

    protected function formattedSalary(): Attribute
    {
        return Attribute::make(
            get: fn() => '$' . number_format($this->salary, 2)
        );
    }

    protected function formattedHireDate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hire_date->format('d/m/Y')
        );
    }
}
