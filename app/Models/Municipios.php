<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Provincias;

class Municipios extends Model
{
    use HasFactory;
    protected $table = 'municipes';
    protected $fillable = ['name', 'id_province'];

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincias::class, 'id_province');
    }

}