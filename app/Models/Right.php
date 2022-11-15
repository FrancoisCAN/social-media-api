<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Right extends Model
{
    use HasFactory;

    /**
     * A right belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function rights(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'rights_roles');
    }
}
