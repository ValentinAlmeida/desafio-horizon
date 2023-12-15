<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bateria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'baterias';

    protected $fillable = [
        'id',
        'Surfista1',
        'Surfista2',
    ];

    public function surfista1()
    {
        return $this->belongsTo(Surfista::class, 'Surfista1', 'numero');
    }

    public function surfista2()
    {
        return $this->belongsTo(Surfista::class, 'Surfista2', 'numero');
    }

    public function ondas()
    {
        return $this->hasMany(Onda::class, 'Bateria', 'id');
    }
}
