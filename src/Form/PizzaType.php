<?php

namespace App\Form;

use Core\Form\FormParam;
use Core\Form\FormType;

class PizzaType extends FormType
{
    public function __construct()
    {
        $this->build();
    }

    public function build()
    {
        $this->add(new FormParam("name", "string"));
        $this->add(new FormParam("description", "string"));
    }
}