<?php

namespace Tests\Unit;

use Tests\Unit\CrudTester;

class ResourcesTest extends CrudTester {

    protected function getStub()
    {
        return [
            'street'       => $this->fake->streetName(),
            'number'       => $this->fake->numberBetween(10, 5000),
            'complement'   => $this->fake->sentence(1),
            'zip_code'     => $this->fake->randomNumber(),
            'neighborhood' => $this->fake->sentence(1),
            'city'         => $this->fake->sentence(1),
            'state'        => $this->fake->stateAbbr(),
            'latitude'     => $this->fake->latitude(),
            'longitude'    => $this->fake->longitude(),
            'user_id'      => 1,
        ];
    }




}
