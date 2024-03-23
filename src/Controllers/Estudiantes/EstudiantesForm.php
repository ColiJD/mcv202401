<?php

namespace Controllers\Estudiantes;

use Controllers\PublicController;
use Dao\Estudiantes\Estudiantes as EstudiantesDao;
use Utilities\Validators;
use Utilities\Site;
use Utilities\ArrUtils;
use Views\Renderer;

class EstudiantesForm extends PublicController
{
    private $viewData = [];
    private $nombre = "";
    private $apellido = "";
    private $edad = 0;
    private $especialidad = "NFD";
    private $id_estudiante = 0;
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

    private $especialidadOptions = [
        "NDF" => "No definido",
        "STM" => "Sistema",
        "AQT" => "Arquitectura",
        "MDI" => "Medicina"
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
        if (isset($_GET["id_estudiante"])) {
            $this->id_estudiante = intval($_GET["id_estudiante"]);
            $tmpLibrosFromDb = EstudiantesDao::getById($this->id_estudiante);
            if ($tmpLibrosFromDb) {
                $this->nombre = $tmpLibrosFromDb['nombre'];
                $this->apellido = $tmpLibrosFromDb['apellido'];
                $this->edad = intval($tmpLibrosFromDb['edad']);
                $this->especialidad = $tmpLibrosFromDb['especialidad'];
            } else {
                $this->addError("EStudiante No Encontrado");
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
        if (isset($_POST["nombre"])) {
            $this->nombre = $_POST['nombre'];
            if (Validators::IsEmpty($this->nombre)) {
                $this->addError('Nombre Invalida', "nombre_error");
            }
        }
        if (isset($_POST["apellido"])) {
            $this->apellido = $_POST['apellido'];
            if (Validators::IsEmpty($this->apellido)) {
                $this->addError('Apellido Invalido', "apellido_error");
            }
        }
        if (isset($_POST["edad"])) {
            $this->edad = $_POST['edad'];
            if (Validators::IsEmpty($this->edad)) {
                $this->addError('Edad Invalido', "edad_error");
            }
        }
        if (isset($_POST["especialidad"])) {
            $this->especialidad = $_POST['especialidad'];
            if (!isset($this->especialidadOptions[$this->especialidad])) {
                $this->addError('Especialidad Invalida', "especialidad_error");
            }
        }
    }

    private function executePostAction()
    {
        switch ($this->mode) {
            case "INS":
                $result = EstudiantesDao::add(
                    $this->nombre,
                    $this->apellido,
                    $this->edad,
                    $this->especialidad,
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Estudiantes_EstudiantesList",
                        "Estudiante Creado"
                    );
                } else {
                    $this->addError("Error al Crear el Estudiante");
                }
                break;
            case "UPD":
                $result = EstudiantesDao::update(
                    $this->nombre,
                    $this->apellido,
                    $this->edad,
                    $this->especialidad,
                    $this->id_estudiante
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Estudiantes_EstudiantesList",
                        "Estudiante Actualizado"
                    );
                } else {
                    $this->addError("Error al Actualizar el Estudiante");
                }
                break;
            case "DEL":
                $result = EstudiantesDao::delete(
                    $this->id_estudiante
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Estudiantes_EstudiantesList",
                        "Estudiante Eliminado"
                    );
                } else {
                    $this->addError("Error al Eliminar el Estudiante");
                }
                break;
            default:
                $this->addError("Modo Invalido");
                break;
        }
    }
    private function prepareView()
    {
        $this->viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->nombre);
        $this->viewData["mode"] = $this->mode;
        $this->viewData["nombre"] = $this->nombre;
        $this->viewData["edad"] = $this->edad;
        $this->viewData["apellido"] = $this->apellido;
        $this->viewData["especialidad"] = $this->especialidad;
        $this->viewData["id_estudiante"] = $this->id_estudiante;
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
        $this->viewData["especialidadOptions"] = ArrUtils::toOptionsArray(
            $this->especialidadOptions,
            "key",
            "values",
            "selected",
            $this->especialidad
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

        Renderer::render("estudiantes/form", $this->viewData);
    }
}
