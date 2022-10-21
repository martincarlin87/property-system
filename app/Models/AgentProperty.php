<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentProperty extends Model
{
    use HasFactory;

    public const SELLER = 'seller';
    public const COORDINATOR = 'coordinator';

    public const TYPES = [
        self::SELLER,
        self::COORDINATOR,
    ];

    protected $table = 'agent_property';
}
