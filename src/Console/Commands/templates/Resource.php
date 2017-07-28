<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {

    protected $fillable = [
        'street',
        'number',
        'complement',
        'zip_code',
        'neighborhood',
        'city',
        'state',
        'latitude',
        'longitude',
    ];
//
//
//    /**
//     * Get the user associated with the given address
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasOne
//     */
//    public function user()
//    {
//        return $this->belongsTo('\App\Models\User');
//    }
//
//
//    /**
//     * Get the service associated with the given address
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\HasOne
//     */
//    public function service()
//    {
//        return $this->belongsTo('\App\Models\Service');
//    }

}