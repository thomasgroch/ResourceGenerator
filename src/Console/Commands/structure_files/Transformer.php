<?php namespace App\Transformers;

use App\Models\Resource;
use League\Fractal\TransformerAbstract as Transformer;

abstract class TransformerApi extends Transformer
{

    public abstract function transform($resource);

    public function transformCollection($resource)
    {
        return array_map([$this, 'transform'], (is_array($resource) ? $resource : $resource->toArray()));
    }

}
