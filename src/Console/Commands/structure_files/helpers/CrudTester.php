<?php
namespace Tests\Unit;

class CrudTester extends ApiTester
{

    /**
     * @var String
     * Holds the name of the model
     */
    public $resource;

    /**
     * @var Mixed
     * Instance of the given resource
     */
    public $model;


    public function __construct()
    {
        parent::__construct();
        $this->init();
    }


    /**
     * Setup Class setting resource name and instantiate model
     *
     */
    public function init()
    {
        // Setup Crud Tester
        $this->resource = (new \ReflectionClass($this))->getShortName();
        $this->resource = strtolower(str_replace('Test', '', $this->resource));

        if (empty($this->model)) {
            $singular = ucfirst(str_singular($this->resource));
            $this->setModel($singular);
        }
    }


    /**
     * Instantiate Laravel Eloquent Model
     *
     * @param $model
     *
     * @return $this
     */
    public function setModel(string $model)
    {
        $model = "\\App\Models\\$model";
        // echo "Loading Eloquent Model: $model";
        $this->model = new $model();

        return $this;
    }



    /** @test */
    public function it_fetches_resources()
    {
        $this->times(3)->makeRecord($this->model);

        $response = $this->usingTokenAsTestUser()->get("api/v1/{$this->resource}");
        $response->assertStatus(200);
    }


    /** @test */
    public function it_fetches_a_single_resource()
    {
        $this->makeRecord($this->model);

        $response = $this->usingTokenAsTestUser()->json('GET', "api/v1/{$this->resource}/1");
        $response->assertStatus(200);

        $object = json_decode($response->content())->data;
        $this->assertObjectHasStubAttributes($object);
    }


    /** @test */
    public function it_deletes_a_single_resource()
    {
        $this->makeRecord($this->model);

        $response = $this->usingTokenAsTestUser()->json('DELETE', "api/v1/{$this->resource}/1");
        $response->assertStatus(410);
    }


    /** @test */
    public function it_404s_if_a_resource_is_not_found()
    {
        $response = $this->usingTokenAsTestUser()->json('GET', "api/v1/{$this->resource}/x");
        $response->assertStatus(404);
    }


    /** @test */
    public function it_create_a_new_resource_given_valid_parameters()
    {
        $response = $this->usingTokenAsTestUser()->json('POST', "api/v1/{$this->resource}", $this->getStub());
        $response->assertStatus(201);
    }


    /** @test */
    public function it_thows_a_422_if_a_new_resource_request_fails_validation()
    {
        $response = $this->usingTokenAsTestUser()->json('POST', "api/v1/{$this->resource}");
        $response->assertStatus(422);
    }
}
