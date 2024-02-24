<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Produtos;
class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];


    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function produtos(): HasMany
    {
        return $this->HasMany(Produtos::class);
    }
}