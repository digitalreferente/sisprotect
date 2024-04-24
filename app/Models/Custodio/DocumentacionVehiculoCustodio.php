<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $siaf_status
 * @property string $tipo_documento_vehiculo
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property User $user
 */
class DocumentacionVehiculoCustodio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_documentacion_vehiculo';

    /**
     * @var array
     */
    protected $fillable = ['siaf_status', 'tipo_documento_vehiculo', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

    public function siafStatus()
    {
        return $this->belongsTo('App\Models\SiafStatus', 'siaf_status');
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
