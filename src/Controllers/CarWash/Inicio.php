<?php

namespace Controllers\CarWash;

use Controllers\PublicController;
// use Dao\CarWash\CarWash as DaoCarWash;
use Views\Renderer;

class Inicio extends PublicController
{
  public function run(): void
  {
    $viewData = [];
    Renderer::render("carwash/inicio", $viewData);
  }
}
