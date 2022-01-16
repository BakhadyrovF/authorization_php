<?php

namespace app\core\form;


use app\core\Model;

class Form
{
    public array $errors = [];

    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public function end()
    {
        return "</form>";
    }

    public function field(Model $model, $attribute)
    {
        $field = new Field($model, $attribute);
        echo $field->__toString();
        
    }

    

    
}




?>