<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    /**
     * A country can have many cities.
     *
     * @return HasMany
     */
    public function countries(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
