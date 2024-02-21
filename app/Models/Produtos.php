<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Team;
use App\Models\TipoDeProduto;

class Produtos extends Model
{
    use HasFactory;

    protected $table = 'produts';
    protected $fillable = ['name', 'id_typeOfProdut'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
    
    public function tipoProdutos(): BelongsTo
    {
        return $this->belongsTo(TipoDeProduto::class, 'id_typeOfProdut');
    }
}