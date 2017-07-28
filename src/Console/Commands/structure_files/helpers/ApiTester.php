<?php

namespace Tests\Unit;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use stdClass;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

//use Illuminate\Foundation\Testing\WithoutMiddleware;

/**
 * Class ApiTester
 */
abstract class ApiTester extends TestCase {

//    use DatabaseMigrations; // Rollback the database after each test and migrate it before the next test:
    use DatabaseTransactions;

    //    use WithoutMiddleware; # dingo/api not yet compatible w/this # Disabled for now. see https://github.com/dingo/api/issues/571

    /**
     * Rollback the database after each test and migrate it before the next test:
     */
    use DatabaseMigrations;

    use Factory;

    /**
     * @var \Faker\Generator
     */
    protected $fake;

    /**
     * @var $testUser
     * Holds an test user with full access
     */
    protected $testUser;


    /**
     * ApiTester constructor.
     * Override default language to portuguese
     */
    public function __construct()
    {
        // Setups
        $this->fake = Faker::create('pt_BR');
    }

    public function setUp()
    {
        parent::setUp();

        // Use factory to create the testUser
        $this->testUser = factory(User::class)->create([
            'name' => 'Test',
            'email'      => 'test@example.com'
        ]);
    }

    /**
     * Assert that the given $object have all getStub() fields.
     * Assert that the given $object have all $fillable fields from Eloquent model.
     * Assert that the given $object DO NOT have all $hidden fields from Eloquent model.
     *
     * @param              $object
     */
    protected function assertObjectHasStubAttributes(stdClass $object)
    {
        // Eloquent way
        //        $args = array_filter(array_keys($this->getStub()), function($attribute) {
        //            return $attribute != 'password' AND strpos($attribute, '_id') === false;
        //        });

        // Factory way
        $tmp_object = factory(get_class($this->model))->make();
        $good_list = array_merge($tmp_object->getFillable(), $tmp_object->getVisible());
        $bad_list = $tmp_object->getHidden();

        // Get a list of attributes from factory class
        $args = array_filter(array_keys($tmp_object->toArray()), function ($attribute) {
            return strpos($attribute, '_id') === false;
        });

        // asserts
        foreach ($args as $attribute) {

            // Should have all fields
            if (in_array($attribute, $good_list)) {
                $this->assertObjectHasAttribute($attribute, $object);
            }

            // Should not have bad fields
            $this->assertTrue(! (in_array($attribute, $bad_list)));

        }

    }


    /**
     * Return request headers needed to interact with the API.
     *
     * @param null $user
     *
     * @return array
     */
    protected function headers($user = null)
    {
        $headers = [ 'HTTP_Accept' => 'application/json' ];

        if ( ! is_null($user)) {
            $token = JWTAuth::fromUser($user);
            JWTAuth::setToken($token);
            $headers['HTTP_Authorization'] = 'Bearer ' . $token;
        }

        return $headers;
    }


    /**
     * Given a User append a session based on the request
     *
     * @param User|null $user
     *
     * @return $this
     */
    protected function usingTokenAs(User $user = null)
    {
        $this->withServerVariables($this->headers($user));

        return $this;
    }


    /**
     * Convenient way to call usingTokenAs function
     * using default test User.
     *
     * @return ApiTester
     */
    protected function usingTokenAsTestUser()
    {
        return $this->usingTokenAs($this->testUser);
    }

}