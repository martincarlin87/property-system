<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'property_type_id',
        'county',
        'country',
        'town',
        'description',
        'address',
        'image_full',
        'image_thumbnail',
        'latitude',
        'longitude',
        'num_bedrooms',
        'num_bathrooms',
        'price',
        'type',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the property type associated with the property.
     */
    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    /**
     * The agents that belong to the property.
     */
    public function agents(): BelongsToMany
    {
        return $this->belongsToMany(Agent::class)->withTimestamps()->withPivot('type');
    }

    /**
     * The agents that belong to the property that are acting as coordinators.
     */
    public function coordinatorAgents(): BelongsToMany
    {
        return $this->agents()->wherePivot('type', '=', AgentProperty::COORDINATOR);
    }

    /**
     * The agents that belong to the property that are acting as sellers.
     */
    public function sellerAgents(): BelongsToMany
    {
        return $this->agents()->wherePivot('type', '=', AgentProperty::SELLER);
    }
}
