<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * A role has many users.
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * A role belongs to many rights.
     *
     * @return BelongsToMany
     */
    public function rights(): BelongsToMany
    {
        return $this->belongsToMany(Right::class, 'rights_roles')->withPivot('is_allowed');
    }
}
