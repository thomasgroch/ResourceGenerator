<?php

namespace groch\ResourceGenerator\Console\Commands;


class fileNameGenerator
{

    public function testFile($name)
    {
        return ucwords(str_plural($name)) . "Test";
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function tableSeederFile($name): string
    {
        return str_plural($name) . "TableSeeder";
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function migrationFile($name): string
    {
        return "2016_08_10_231848_create_" . strtolower(str_plural($name)) . "_table";
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function factoryFile($name): string
    {
        return $name . "Factory";
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function transformerFile($name): string
    {
        return $name . "Transformer";
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function modelFile($name)
    {
        return $name;
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function requestFile($name): string
    {
        return "Store" . $name . "Request";
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function controllerFile($name): string
    {
        return str_plural($name) . "Controller";
    }


    public function getName($name, $type)
    {
        $type = $type . "File";
        if ( ! method_exists($this, $type)) {
            echo "Method: $type not found!";
            exit;
        }

        return $this->{$type}($name);
    }
}