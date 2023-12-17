<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar uma bateria de surf.
 */
class Bateria extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surfista1()
    {
        return $this->belongsTo(Surfista::class, 'surfista1', 'numero');
    }

    /**
     * Obtém o objeto relacionado ao surfista 2 desta bateria.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surfista2()
    {
        return $this->belongsTo(Surfista::class, 'surfista2', 'numero');
    }

    /**
     * Obtém a coleção de objetos relacionados às ondas desta bateria.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ondas()
    {
        return $this->hasMany(Onda::class, 'bateria_id', 'id');
    }
}
