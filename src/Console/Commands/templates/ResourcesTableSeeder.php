<?php

use App\Models\Resource;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ResourcesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('pt_BR');

//        $serviceIds = Service::pluck('id')->all();
        $userIds    = User::pluck('id')->all();

//        foreach ($serviceIds as $serviceId) {
//            $this->createRecord($faker, $serviceId, null);
//        }

        foreach ($userIds as $userId) {
            $this->createRecord($faker, null, $userId);
        }

    }


    /**
     * @param $faker
     * @param $service_id
     * @param $user_id
     */
    private function createRecord($faker, $service_id = null, $user_id = null)
    {
        Resource::create([
            'street'       => $faker->streetName(),
            'number'       => $faker->numberBetween(10, 5000),
            'complement'   => $faker->sentence(1),
            'zip_code'     => $faker->randomNumber(),
            'neighborhood' => $faker->sentence(1),
            'city'         => $faker->sentence(1),
            'state'        => $faker->stateAbbr(),
            'latitude'     => $faker->latitude(),
            'longitude'    => $faker->longitude(),
            'user_id'      => $user_id,
        ]);
    }
}