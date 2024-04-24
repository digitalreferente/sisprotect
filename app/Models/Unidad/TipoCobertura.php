<?php

namespace App\Models\Unidad;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_status_delete
 * @property string $tipo_cobertura
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property string $created_at
 * @property string $updated_at
 * @property UnidadInfoSeguro[] $unidadInfoSeguros
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property User $user
 */
class TipoCobertura extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'unidad_tipo_cobertura';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_status_delete', 'tipo_cobertura', 'iduserCreated', 'iduserUpdated', 'created_at', 'updated_at'];


    public function siafStatus()
    {
        return $this->belongsTo('App\Models\SiafStatus', 'id_status_delete');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
}
