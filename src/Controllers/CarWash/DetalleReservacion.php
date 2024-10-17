<?php

namespace Controllers\CarWash;

use Controllers\PrivateController;
use Dao\CarWash\CarWash as DaoCarWash;
use Views\Renderer;

class DetalleReservacion extends PrivateController
{
  public function run(): void
  {
    $viewData = [];
    $viewData["carwash"] = DaoCarWash::getAll();
    Renderer::render("carwash/list", $viewData);
  }
}
