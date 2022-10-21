<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'city',
        'region',
        'postcode',
        'country',
    ];

    /**
     * The properties that belong to the agent.
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class)->withTimestamps()->withPivot('type');
    }

    public function getNameAttribute(): string
    {
        if (empty($this->last_name)) {
            return $this->first_name;
        }

        return sprintf("%s %s", $this->first_name, $this->last_name);
    }
}
