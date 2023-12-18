<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para representar uma nota atribuída a uma onda.
 *
 * @property int $id
 * @property int $onda_id
 * @property float $notaParcial1
 * @property float $notaParcial2
 * @property float $notaParcial3
 */
class Nota extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'notas';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'onda_id',
        'notaParcial1',
        'notaParcial2',
        'notaParcial3',
    ];

    /**
     * Obtém o objeto relacionado à onda associada a esta nota.
     *
     * @return BelongsTo
     */
    public function onda(): BelongsTo
    {
        return $this->belongsTo(Onda::class, 'onda_id', 'id');
    }
}