<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para representar um surfista.
 *
 * @property int $numero
 * @property string $nome
 * @property string $pais
 */
class Surfista extends Model
{
    use HasFactory;
    use SoftDeletes;

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
     * @return HasMany
     */
    public function baterias(): HasMany
    {
        return $this->hasMany(Bateria::class, 'surfista1', 'numero')
                    ->orWhere('surfista2', $this->numero);
    }

    /**
     * Obtém a coleção de objetos relacionados às ondas associadas a este surfista.
     *
     * @return HasMany
     */
    public function ondas(): HasMany
    {
        return $this->hasMany(Onda::class, 'surfista_id', 'numero');
    }
}