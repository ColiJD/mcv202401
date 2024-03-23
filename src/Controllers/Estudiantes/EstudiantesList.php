<?php

namespace Controllers\Estudiantes;

use Controllers\PublicController;
use Dao\Estudiantes\Estudiantes;
use Views\Renderer;

class EstudiantesList extends PublicController
{
  public function run(): void
  {
    $viewData["EstudianteCienciasComputacionales"] = Estudiantes::getAll();
    Renderer::render("estudiantes/list", $viewData);
  }
}
