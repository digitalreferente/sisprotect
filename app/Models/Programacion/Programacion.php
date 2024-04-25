<?php

namespace AppModelsProgrmacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $descripcion
 */
class Programacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'programacion';

    /**
     * @var array
     */
    protected $fillable = ['descripcion'];
}
