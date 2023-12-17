<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar uma nota atribuída a uma onda.
 */
class Nota extends Model
{
    use HasFactory;

    /**
     * Nome da chave primária da tabela.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function onda()
    {
        return $this->belongsTo(Onda::class, 'onda_id', 'id');
    }
}