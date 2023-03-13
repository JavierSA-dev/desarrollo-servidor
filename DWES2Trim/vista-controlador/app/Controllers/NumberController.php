<?php

namespace App\Controllers;

class NumberController extends BaseController
{
    public function paresAction()
    {

        $data = array('message' => $this->getPares());
        $this->renderHTML('../views/pares_view.php', $data);
    }

    private function getPares(){
        for ($i=1; $i <= 10 ; $i++) { 
            if ($i % 2 == 0) {
                $pares[] = $i;
            }
        };
        return $pares;
    }
}
