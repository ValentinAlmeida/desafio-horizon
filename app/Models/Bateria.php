<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para representar uma bateria de surf.
 *
 * @property int $id
 * @property int $surfista1
 * @property int $surfista2
 */
class Bateria extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'baterias';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'surfista1',
        'surfista2',
    ];

    /**
     * Obtém o objeto relacionado ao surfista 1 desta bateria.
     *
     * @return BelongsTo
     */
    public function surfista1(): BelongsTo
    {
        return $this->belongsTo(Surfista::class, 'surfista1', 'numero');
    }

    /**
     * Obtém o objeto relacionado ao surfista 2 desta bateria.
     *
     * @return BelongsTo
     */
    public function surfista2(): BelongsTo
    {
        return $this->belongsTo(Surfista::class, 'surfista2', 'numero');
    }

    /**
     * Obtém a coleção de objetos relacionados às ondas desta bateria.
     *
     * @return HasMany
     */
    public function ondas(): HasMany
    {
        return $this->hasMany(Onda::class, 'bateria_id', 'id');
    }
}