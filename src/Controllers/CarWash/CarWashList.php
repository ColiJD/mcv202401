<?php

namespace Controllers\CarWash;

use Controllers\PrivateController;
use Dao\CarWash\CarWash as DaoCarWash;
use Views\Renderer;

class CarWashList extends PrivateController
{
  public function run(): void
  {
    $viewData = [];
    $viewData["carwash"] = DaoCarWash::getAll();
    // $viewData["carwash_view_enable"] = $this->isFeatureAutorized("carwash_view_enable");
    // $viewData["carwash_new_enable"] = $this->isFeatureAutorized("carwash_new_enable");
    // $viewData["carwash_edit_enable"] = $this->isFeatureAutorized("carwash_nable");
    // $viewData["carwash_delete_enable"] = $this->isFeatureAutorized("carwash_new_enable");
    
    Renderer::render("carwash/list", $viewData);
  }
}
