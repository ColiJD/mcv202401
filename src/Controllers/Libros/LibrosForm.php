<?php

namespace Controllers\Libros;

use Controllers\PublicController;
use Dao\Libros\Libros as DaoLibro;
use Utilities\Validators;
use Utilities\Site;
use Utilities\ArrUtils;
use Views\Renderer;

class LibrosForm extends PublicController
{
    private $viewData = [];
    private $libros_desc = "";
    private $libros_isbn = "";
    private $libros_autor = "";
    private $libros_categoria = "NFD";
    private $libros_estado = "ACT";
    private $libros_id = 0;
    private $mode = "DSP";

    private $modeDscArr = [
        "DSP" => "Mostrar %s",
        "INS" => "Crear Nuevo",
        "UPD" => "Actualizar %s",
        "DEL" => "Eliminar %s"
    ];
    private $error = [];
    private $has_errors = false;
    private $isReadOnly = "readonly";
    private $showActions = true;
    private $cxfToken = "";

    private $categoriesOptions = [
        "NDF" => "No definido",
        "CLS" => "Clasicos",
        "FIC" => "Ficcion",
        "HIS" => "Romance",
        "ROM" => "Historia",
        "TCT" => "Tecnologia",
        "MNG" => "Manga"
    ];

    private $estadoOpciones = [
        "ACT" => "Activo",
        "INA" => "Inactivo",
        "RTR" => "Retirado"
    ];
    private function addError($errorMsg, $origin = "global")
    {
        if (!isset($this->error[$origin])) {
            $this->error[$origin] = [];
        }
        $this->error[$origin][] = $errorMsg;
        $this->has_errors = true;
    }
    private function getGetData()
    {
        if (isset($_GET['mode'])) {
            $this->mode = $_GET['mode'];
            if (!isset($this->modeDscArr[$this->mode])) {
                $this->addError('Modo Invalido');
            }
        }
        if (isset($_GET["libros_id"])) {
            $this->libros_id = intval($_GET["libros_id"]);
            $tmpLibrosFromDb = DaoLibro::getById($this->libros_id);
            if ($tmpLibrosFromDb) {
                $this->libros_desc = $tmpLibrosFromDb['libros_desc'];
                $this->libros_isbn = $tmpLibrosFromDb['libros_isbn'];
                $this->libros_autor = $tmpLibrosFromDb['libros_autor'];
                $this->libros_categoria = $tmpLibrosFromDb['libros_categoria'];
                $this->libros_estado = $tmpLibrosFromDb['libros_estado'];
            } else {
                $this->addError("Libro No Encontrado");
            }
        }
    }
    private function getPostData()
    {
        if (isset($_POST["cxfToken"])) {
            $this->cxfToken = $_POST['cxfToken'];
            if (Validators::IsEmpty($this->cxfToken)) {
                $this->addError('Token Invalido');
            }
        }
        if (isset($_POST['mode'])) {
            $tmpMode = $_POST['mode'];
            if (!isset($this->modeDscArr[$tmpMode])) {
                $this->addError("Modo invalido");
            }
            if ($this->mode != $tmpMode) {
                $this->addError("Modo Invalido");
            }
        }
        if (isset($_POST["libros_desc"])) {
            $this->libros_desc = $_POST['libros_desc'];
            if (Validators::IsEmpty($this->libros_desc)) {
                $this->addError('Descripcion Invalida', "libros_desc_error");
            }
        }
        if (isset($_POST["libros_isbn"])) {
            $this->libros_isbn = $_POST['libros_isbn'];
            if (Validators::IsEmpty($this->libros_isbn)) {
                $this->addError('ISBN Invalido', "libros_isbn_error");
            }
        }
        if (isset($_POST["libros_autor"])) {
            $this->libros_autor = $_POST['libros_autor'];
            if (Validators::IsEmpty($this->libros_autor)) {
                $this->addError('Autor Invalido', "libros_autor_error");
            }
        }
        if (isset($_POST["libros_categoria"])) {
            $this->libros_categoria = $_POST['libros_categoria'];
            if (!isset($this->categoriesOptions[$this->libros_categoria])) {
                $this->addError('Categoria Invalida', "libros_categoria_error");
            }
        }
        if (isset($_POST["libros_estado"])) {
            $this->libros_estado = $_POST['libros_estado'];
            if (!isset($this->estadoOpciones[$this->libros_estado])) {
                $this->addError('Estado Invalido', "libros_estado_error");
            }
        }
    }

    private function executePostAction()
    {
        switch ($this->mode) {
            case "INS":
                $result = DaoLibro::add(
                    $this->libros_desc,
                    $this->libros_isbn,
                    $this->libros_autor,
                    $this->libros_categoria,
                    $this->libros_estado
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Libros_LibrosList",
                        "Libro Creado"
                    );
                } else {
                    $this->addError("Error al Crear el Libro");
                }
                break;
            case "UPD":
                $result = DaoLibro::update(
                    $this->libros_desc,
                    $this->libros_isbn,
                    $this->libros_autor,
                    $this->libros_categoria,
                    $this->libros_estado,
                    $this->libros_id
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Libros_LibrosList",
                        "Libro Actualizado"
                    );
                } else {
                    $this->addError("Error al Actualizar el Libro");
                }
                break;
            case "DEL":
                $result = DaoLibro::delete(
                    $this->libros_id
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Libros_LibrosList",
                        "Libro Eliminado"
                    );
                } else {
                    $this->addError("Error al Eliminar el Libro");
                }
                break;
            default:
                $this->addError("Modo Invalido");
                break;
        }
    }
    private function prepareView()
    {
        $this->viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->libros_desc);
        $this->viewData["mode"] = $this->mode;
        $this->viewData["libros_desc"] = $this->libros_desc;
        $this->viewData["libros_autor"] = $this->libros_autor;
        $this->viewData["libros_isbn"] = $this->libros_isbn;
        $this->viewData["libros_categoria"] = $this->libros_categoria;
        $this->viewData["libros_estado"] = $this->libros_estado;
        $this->viewData["libros_id"] = $this->libros_id;
        $this->viewData["error"] = $this->error;
        $this->viewData["has_errors"] = $this->has_errors;

        if ($this->mode == "DSP" || $this->mode == "DEL") {
            $this->isReadOnly = true;
            if ($this->mode == "DSP") {
                $this->showActions = false;
            }
        } else {
            $this->isReadOnly = "";
            $this->showActions = true;
        }
        $this->viewData["isReadOnly"] = $this->isReadOnly;
        $this->viewData["showActions"] = $this->showActions;
        $this->viewData["cxfToken"] = $this->cxfToken;
        $this->viewData["categoriesOptions"] = ArrUtils::toOptionsArray(
            $this->categoriesOptions,
            "key",
            "values",
            "selected",
            $this->libros_categoria
        );
        $this->viewData["estadoOpciones"] = ArrUtils::toOptionsArray(
            $this->estadoOpciones,
            "key",
            "values",
            "selected",
            $this->libros_estado
        );
    }
    public function run(): void
    {
        $this->getGetData();
        if ($this->isPostBack()) {
            $this->getPostData();
            $this->executePostAction();
        }
        $this->prepareView();

        Renderer::render("libros/form", $this->viewData);
        // obtener datos del get
        // si es postback
        // obtener datos del post
        // validar datos
        // Ejecutar acciones
        // preparar la vista
        // renderizar
    }
}
