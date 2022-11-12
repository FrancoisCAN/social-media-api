<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * A role is assigned to users.
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
