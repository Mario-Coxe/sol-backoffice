<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Team;

class UsuáriosDasEquipes extends Model
{
    use HasFactory;
    protected $table = 'team_user';
    protected $fillable = ['team_id', 'user_id'];


    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function produtos(): HasMany
    {
        return $this->HasMany(Produtos::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}