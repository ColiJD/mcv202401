<?php

namespace Controllers;

use Dao\Pulseras\Pulsera;
use Views\Renderer;

class Home extends PublicController
{
    public function run(): void
    {
        $viewData = [
          'nombre' => 'Jose Colindres',
          'cuenta' => '0703200100798',
          'pulseras' => Pulsera::getAllPulseras(),
        ];
        Renderer::render('home', $viewData);
    }
}
