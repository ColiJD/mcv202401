<?php

namespace Controllers\Product;

use Controllers\PublicController;
use Dao\Productos\Categories as CategoriesDao;
use views\Renderer;

class CategoriesList extends PublicController
{
    public function run(): void
    {
        $viewData = [];
        $viewData['categories'] = CategoriesDao::getAllCategories();
        Renderer::render('productos/categorieslist', $viewData);
    }
}
