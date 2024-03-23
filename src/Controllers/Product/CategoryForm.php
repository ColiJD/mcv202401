<?php

namespace Controllers\Product;

use Controllers\PublicController;
use views\Renderer;

class CategoryForm extends PublicController
{
    private $viewData = [];
    private $mode = 'DSP';
    private $categoryId = 0;
    private $categoryName = '';
    private $categorySmallDesc = '';
    private $categoryStatus = '';

    private $modeOptions = [
      'INS' => 'Nueva Categoria',
      'UPD' => 'Actualizando Categoria (%s %s)',
      'DEL' => 'Eliminando Categoria (%s %s)',
      'DSP' => 'Detalle de Categoria (%s %s)',
    ];

    private $categoryStatusOption = [
      'ACT' => 'Activo',
      'INA' => 'Inactivo',
      'RTR' => 'Retirar',
      'DSC' => 'Descontinuar',
    ];

    private function prepareViewData()
    {
        $viewData['mode'] = $this->mode;
        $viewData['modeDesc'] = sprintf($this->modeOptions[$this->mode], $this->categoryId, $this->categoryName);
        $viewData['category_id'] = $this->categoryId;
        $viewData['category_name'] = $this->categoryName;
        $viewData['category_small_desc'] = $this->categoryId;
        $viewData['category_status'] = $this->categoryStatus;
        foreach ($this->categoryStatusOptions as $value => $text) {
            $viewData['category_status_list'][] = [
                'value' => $value,
                'text' => $text,
                'selected' => ($value === $this->categoryStatus) ? 'selected' : '',
            ];
        }
        $this->viewData = $viewData;
    }

    public function run(): void
    {
        $this->prepareViewData();
        Renderer::render('Productos/categoryform', $this->viewData);
    }
}
