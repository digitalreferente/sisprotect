<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $custodio_id
 * @property integer $custodio_documentacion_id
 * @property string $documento
 * @property string $mime_type
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property CustodioDocumentacion $custodioDocumentacion
 * @property User $user
 * @property Custodio $custodio
 * @property User $user
 */
class CustodioDocumento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio_documento';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['custodio_id', 'custodio_documentacion_id', 'documento', 'mime_type', 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function custodioDocumentacion()
    {
        return $this->belongsTo('App\Models\Custodio\DocumentacionCustodio');
    }

    public function custodio()
    {
        return $this->belongsTo('App\Models\Custodio\Custodio');
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