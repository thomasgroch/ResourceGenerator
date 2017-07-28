<?php

namespace App\Http\Controllers;

//use App\Helpers\CrudSave;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\StoreRequestInterface;
use App\Models\Resource;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

//use Illuminate\Routing\Route;

abstract class ApiCrudController extends ApiController
{

    public $transformer;

    //    use CrudSave;

    public $element;

    protected $model = null;

    /**
     * contains the name of the controller on plural
     * @access public
     * @var string
     */
    public $ctrlr_name;

    /**
     * contains the name of the controller in uppercase
     * @access public
     * @var string
     */
    public $class_name;

    /**
     * @var Route
     */
    public $route;

    public $action;


    public function __construct(Route $route)
    {
        $this->route = $route;
        $this->action = substr($this->route->getActionName(), strpos($this->route->getActionName(), '@') + 1);
        $this->setUp();
    }


    private function setUp()
    {
        $this->ctrlr_name = (new \ReflectionClass($this))->getShortName();
        $this->ctrlr_name = str_replace('Controller', '', $this->ctrlr_name);

        if (empty($this->model)) {
            $singular = ucfirst(str_singular($this->ctrlr_name));
            $this->setModel($singular);
        }
    }


    public function setModel($model)
    {
        $model = "\App\Models\\$model";
        $this->model = new $model();

        //        $this->model = "\App\Models\\$model";

        return $this;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $limit = Input::get('limit') ?: 10;

        $this->element = $this->model::paginate($limit);

        return $this->respondWithPagination($this->element, [
            'data' => $this->transformer->transformCollection($this->element->items()),
        ]);
    }


    /**
     * Display a single resource
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $this->element = new $this->model;
        $this->element = $this->element->where('id', $id)->first();

        if ($this->element) {
            return $this->respond([
                'data' => $this->transformer->transform($this->element),
            ]);
        }

        return $this->respondNotFound();
    }

    /**
     * Validate and create a resource on database
     *
     * @param StoreAddressRequest $request
     *
     * @return mixed
     * @throws \Exception
     */
    public function create($request = null)
    {
        DB::beginTransaction();

        try {
            $this->element = new $this->model($request->all());

//            $this->saveRelated($this->element, $this->action);
        } catch (\Exception $e) {
            DB::rollback();

//            throw $e;

            return $this->respondFailValidation();
        }

        DB::commit();

        return $this->respondCreated();
    }


    /**
     * Update a resource on database
     *
     * @param null $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $element = ($this->model)::find($id);

        if ($element and $element->update(Input::all())) {
            return $this->respondUpdated();
        }

        return $this->respondFailValidation();
    }


    /**
     * @param null $id
     *
     * @return mixed
     */
    public function destroy($id = null)
    {
        $element = ($this->model)::find($id);

        if ($element and $element->delete()) {
            return $this->respondDeleted();
        }

        return $this->respondFailValidation();
    }
}
