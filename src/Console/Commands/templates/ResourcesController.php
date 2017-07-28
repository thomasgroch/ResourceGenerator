<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Transformers\ResourceTransformer;
use Illuminate\Routing\Route;

class ResourcesController extends ApiCrudController {

    function __construct(ResourceTransformer $transformer, Route $route)
    {
        parent::__construct($route);
        $this->transformer = $transformer;
    }


    public function store(StoreResourceRequest $request)
    {
        return parent::create($request);
    }

}