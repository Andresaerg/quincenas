<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyecto
 *
 * @property $id
 * @property $libros_id
 * @property $categorias_id
 * @property $Nombre
 * @property $Cantidad
 * @property $Precio
 * @property $Encomendado_por
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Libro $libro
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proyecto extends Model
{
    
    static $rules = [
		'libros_id' => 'required',
		'categorias_id' => 'required',
		'Nombre' => 'required',
		'Cantidad' => 'required',
		'Precio' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['libros_id','categorias_id','Nombre','Cantidad','Precio','Encomendado_por'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categorias_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function libro()
    {
        return $this->hasOne('App\Models\Libro', 'id', 'libros_id');
    }
    

}
