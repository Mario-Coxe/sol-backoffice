<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Team;
class TipoDeProduto extends Model
{
    use HasFactory;
    protected $table = 'type_of_products';
    protected $fillable = ['name'];

}