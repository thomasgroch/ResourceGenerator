<?php
namespace App\Helpers;

trait CrudSave {

    /**
     * @param        $object
     * @param string $action
     *
     * @return mixed
     */
    private function saveRelated($object, $action = '')
    {
        if (method_exists($object, '_saveExtra' . ucfirst($action))) {
            $res = $object->{'_saveExtra' . ucfirst($action)}();
        } elseif (method_exists($object, '_saveExtra')) {
            $res = $object->_saveExtra();
        } else {
            $res = $object->save();
        }

        return $res;
    }

}