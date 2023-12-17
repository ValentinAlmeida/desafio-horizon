<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar uma onda em uma bateria de surf.
 */
class Onda extends Model
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
    protected $table = 'ondas';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'bateria_id',
        'surfista_id'
    ];

    /**
     * Obtém o objeto relacionado à bateria associada a esta onda.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bateria()
    {
        return $this->belongsTo(Bateria::class, 'bateria_id', 'id');
    }

    /**
     * Obtém o objeto relacionado ao surfista associado a esta onda.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surfista()
    {
        return $this->belongsTo(Surfista::class, 'surfista_id', 'numero');
    }

    /**
     * Obtém o objeto relacionado à nota associada a esta onda.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function nota()
    {
        return $this->hasOne(Nota::class, 'onda_id', 'id');
    }
}
