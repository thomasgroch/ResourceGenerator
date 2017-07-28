<?php

namespace App\Transformers;

use App\Models\Resource;
use App\Models\User;

class ResourceTransformer extends TransformerApi {

    protected $availableIncludes = [
    ];

    /**
     * @param Resource $resource
     *
     * @return array
     */
    public function transform($resource)
    {
        return [
            'id'           => (int) $resource['id'],
            'street'       => $resource['street'],
            'number'       => $resource['number'],
            'complement'   => $resource['complement'],
            'zip_code'     => $resource['zip_code'],
            'neighborhood' => $resource['neighborhood'],
            'city'         => $resource['city'],
            'state'        => $resource['state'],
            'latitude'     => (float) $resource['latitude'],
            'longitude'    => (float) $resource['longitude'],
        ];

    }

//
//    /**
//     * Include User
//     *
//     * @param Resource $resource
//     *
//     * @return \League\Fractal\Resource\Item
//     */
//    public function includeUser(Resource $resource)
//    {
//        $user = $resource->user;
//
//        if ($user) {
//            return $this->item($user, new UserTransformer);
//        }
//    }

}