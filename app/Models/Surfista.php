<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para representar um surfista.
 */
class Surfista extends Model
{
    use HasFactory;

    /**
     * Nome da chave primária da tabela.
     *
     * @var string
     */
    protected $primaryKey = 'numero';

    /**
     * Indica se a chave primária é incremental.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Tipo de dados da chave primária.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Nome da tabela associada ao modelo.
     *
     * @var string
     */
    protected $table = 'surfistas';

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'numero',
        'nome',
        'pais',
    ];

    /**
     * Obtém a coleção de objetos relacionados às baterias associadas a este surfista.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function baterias()
    {
        return $this->hasMany(Bateria::class, 'surfista1', 'numero')
                    ->orWhere('surfista2', $this->numero);
    }

    /**
     * Obtém a coleção de objetos relacionados às ondas associadas a este surfista.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ondas()
    {
        return $this->hasMany(Onda::class, 'surfista_id', 'numero');
    }
}
