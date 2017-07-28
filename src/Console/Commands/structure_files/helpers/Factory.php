<?php

namespace Tests\Unit;

use App\Helpers\CrudSave;

trait Factory {

    use CrudSave;

    /**
     * @var int
     */
    protected $times = 1;


    /**
     * @param $count
     *
     * @return $this
     */
    protected function times($count)
    {
        $this->times = $count;

        return $this;
    }


    /**
     * Make a new record in the DB
     *
     * @param       $type
     * @param array $fields
     */
    protected function makeRecord($type, array $fields = [ ])
    {
        while ($this->times--) {

            $stub = array_merge($this->getStub(), $fields);

            // Eloquent model way
            // $object = new $type($stub);
            // Factory way
            $object = factory(get_class($type))->create($stub);

//            $this->saveRelated($object);

        }

    }


    protected function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your fields.');
    }

}