<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class agency_info extends Model
{
    use HasFactory;

    protected $table = 'agency_infos';
    protected $fillable = ['agency_id', 'longitude', 'latitude', 'status'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'agency_id');
    }
}