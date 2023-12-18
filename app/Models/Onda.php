<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para representar uma onda em uma bateria de surf.
 *
 * @property int $id
 * @property int $bateria_id
 * @property int $surfista_id
 */
class Onda extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'ondas';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'bateria_id',
        'surfista_id',
    ];

    /**
     * Obtém o objeto relacionado à bateria associada a esta onda.
     *
     * @return BelongsTo
     */
    public function bateria(): BelongsTo
    {
        return $this->belongsTo(Bateria::class, 'bateria_id', 'id');
    }

    /**
     * Obtém o objeto relacionado ao surfista associado a esta onda.
     *
     * @return BelongsTo
     */
    public function surfista(): BelongsTo
    {
        return $this->belongsTo(Surfista::class, 'surfista_id', 'numero');
    }

    /**
     * Obtém o objeto relacionado à nota associada a esta onda.
     *
     * @return HasOne
     */
    public function nota(): HasOne
    {
        return $this->hasOne(Nota::class, 'onda_id', 'id');
    }
}