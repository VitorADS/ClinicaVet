<?php

namespace App\Utils;

use Symfony\Component\Form\FormInterface;

class Form
{
    public static function getErrorsForm(FormInterface $form): string
    {
        $errosForm = $form->getErrors(true);

        if(count($errosForm) > 0){
            $error = (string) $errosForm;
        } else {
            $error = 'Nao foi possivel gravar a informacao!';
        }

        return $error;
    }
}