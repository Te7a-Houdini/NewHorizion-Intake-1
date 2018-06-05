<?php

namespace App\Http\Controllers;


class Example

{
    public function __construct($name)
    {

    }
}

class Greeting
{
    public function __construct($name)
    {
        $this->name = $name;
    }
}

new Greeting('ahmed');