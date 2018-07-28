<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/28/2018
 * Time: 11:06 AM
 */

namespace App\Models;


trait ToJson
{
    /**
     * alias and nothing really fancy
     * just return a json representation of a model
     *
     * @return mixed
     */
    public function anotherToJson( )
    {
        // do stuff here
        return $this->toJson();
    }
}