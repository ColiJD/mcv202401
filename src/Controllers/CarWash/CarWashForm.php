<?php

namespace Controllers\CarWash;

use Controllers\PublicController;
use Dao\CarWash\CarWash as DaoCarWash;
use Utilities\Validators;
use Utilities\Site;
use Utilities\ArrUtils;
use Views\Renderer;

class CarWashForm extends PublicController
{
    private $viewData = [];
    private $lavado_id = 0;
    private $lavado_nombre = "";
    private $lavado_apellido = "";
    private $lavado_token = "";
    private $lavado_reservacion = "";
    private $lavado_tipo = "";
    private $lavado_img = "";
    private $mode = "DSP";

    private $modeDscArr = [
        "DSP" => "Mostrar %s",
        "INS" => "Agregar una reservación",
        "UPD" => "Actualizar %s",
        "DEL" => "Eliminar %s"
    ];

    private $error = [];
    private $has_errors = false;
    private $isReadOnly = "readonly";
    private $showActions = true;
    private $cxfToken = "";

    private $tipoOpciones = [
        "LAVADO_NORMAL" => "Lavado normal",
        "LAVADO_NORMAL_CHASIS" => "Lavado normal más chasis",
        "LAVADO_NORMAL_MOTOR" => "Lavado normal más motor",
        "LAVADO_NORMAL_CHASIS_MOTOR" => "Lavado normal más chasis y motor"
    ];
    private $horasReservacion = [
        "Nueva Reservación" => "Nueva Reservación",
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
        // Iniciar la sesión si no está activa
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Tiempo de expiración para el token en segundos (ejemplo: 10 minutos = 600 segundos)
        $token_expiry_time = 20;

        // Verificar si el token y el tiempo existen, y si el token ha expirado
        if (!isset($_SESSION['lavado_token']) || !isset($_SESSION['token_time']) || (time() - $_SESSION['token_time'] > $token_expiry_time)) {
            // Generar un token único de 7 caracteres 
            $_SESSION['lavado_token'] = substr(bin2hex(random_bytes(10)), 0, 7);
            // Guardar el tiempo actual para control de expiración
            $_SESSION['token_time'] = time();
        }

        // Guardar el token en la variable de clase
        $this->lavado_token = $_SESSION['lavado_token'];

        // Mostrar el token en pantalla para depuración
        // echo "El token generado es: " . $this->cxfToken;

        // Asignar el token al campo 'lavado_token' automáticamente en lugar de permitir la entrada manual
        // $this->lavado_token = $this->cxfToken;

        // Al cerrar la página o después del tiempo límite, se elimina el token
        // Puedes asegurarte de que el token se elimine destruyendo la sesión manualmente o al expirar el tiempo
        if (isset($_SESSION['token_time']) && (time() - $_SESSION['token_time'] > $token_expiry_time)) {
            unset($_SESSION['lavado_token']);
            unset($_SESSION['token_time']);
        }

        ////////////////////////////////////////////////////////////////////////////////
        if (isset($_GET['mode'])) {
            $this->mode = $_GET['mode'];
            if (!isset($this->modeDscArr[$this->mode])) {
                $this->addError('Modo Invalido');
            }
        }
        if (isset($_GET["lavado_Id"])) {
            $this->lavado_id = intval($_GET["lavado_Id"]);
            $tmpCarWashFromDb = DaoCarWash::getById($this->lavado_id);
            if ($tmpCarWashFromDb) {
                $this->lavado_nombre = $tmpCarWashFromDb['lavado_Nombre'];
                $this->lavado_apellido = $tmpCarWashFromDb['lavado_Apellido'];
                $this->lavado_token = $tmpCarWashFromDb['lavado_Token'];
                $this->lavado_reservacion = $tmpCarWashFromDb['lavado_Reservacion'];
                $this->lavado_tipo = $tmpCarWashFromDb['lavado_Tipo'];
                // Suponiendo que la imagen se gestiona como una cadena en base64
                $this->lavado_img = base64_encode($tmpCarWashFromDb['lavado_Img']);
            } else {
                $this->addError("Reservación No Encontrada");
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
        if (isset($_POST["lavado_nombre"])) {
            $this->lavado_nombre = $_POST['lavado_nombre'];
            if (Validators::IsEmpty($this->lavado_nombre)) {
                $this->addError('Nombre Invalido', "lavado_nombre_error");
            }
        }

        if (isset($_POST["lavado_apellido"])) {
            $this->lavado_apellido = $_POST['lavado_apellido'];
            if (Validators::IsEmpty($this->lavado_apellido)) {
                $this->addError('Apellido Invalido', "lavado_apellido_error");
            }
        }

        if (isset($_POST["lavado_token"])) {
            $this->lavado_token = $_POST['lavado_token'];
            if ($this->lavado_token !== $_SESSION['lavado_token']) { // Comparar con el token almacenado en la sesión
                $this->addError('Token Invalido');
            }
        } else {
            $this->addError('Token no proporcionado');
        }


        // Validar que el token no esté vacío (aunque debería estar siempre presente)
        if (Validators::IsEmpty($this->lavado_token)) {
            $this->addError('Token Invalido', "lavado_token_error");
        }
        if (isset($_POST["lavado_reservacion"])) {
            $this->lavado_reservacion = $_POST['lavado_reservacion'];
            if (!isset($this->horasReservacion[$this->lavado_reservacion])) {
                $this->addError('Reservación Invalida', "lavado_reservacion_error");
            }
        }
        if (isset($_POST["lavado_tipo"])) {
            $this->lavado_tipo = $_POST['lavado_tipo'];
            if (!isset($this->tipoOpciones[$this->lavado_tipo])) {
                $this->addError('Tipo Invalido', "lavado_tipo_error");
            }
        }
        if (isset($_FILES["lavado_img"]) && $_FILES["lavado_img"]["error"] == 0) {
            $this->lavado_img = file_get_contents($_FILES["lavado_img"]["tmp_name"]);
        }
    }
    private function executePostAction()
    {
        switch ($this->mode) {
            case "INS":
                $result = DaoCarWash::add(
                    $this->lavado_nombre,
                    $this->lavado_apellido,
                    $this->lavado_token,
                    $this->lavado_reservacion,
                    $this->lavado_tipo,
                    $this->lavado_img
                );
                if ($result > 0) {
                    // Después de insertar, redirigir a la página que muestra los datos, usando el ID recién generado
                    $insertedId = DaoCarWash::getLastInsertedId(); // Método que deberías tener para obtener el ID
                    Site::redirectToWithMsg(
                        "index.php?page=CarWash_CarWashForm&mode=DSP&lavado_Id=" . $insertedId,
                        "Reservación Creada"
                    );
                } else {
                    $this->addError("Error al Crear la Reservación");
                }
                break;
            case "UPD":
                $result = DaoCarWash::update(
                    $this->lavado_nombre,
                    $this->lavado_apellido,
                    $this->lavado_token,
                    $this->lavado_reservacion,
                    $this->lavado_tipo,
                    $this->lavado_img,
                    $this->lavado_id
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=CarWash_CarWashForm&mode=DSP&lavado_Id={{lavado_Id}}",
                        "Reservación Actualizada"
                    );
                } else {
                    $this->addError("Error al Actualizar la Reservación");
                }
                break;
            case "DEL":
                $result = DaoCarWash::delete(
                    $this->lavado_id
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=CarWash_CarWashList",
                        "Reservación Eliminada"
                    );
                } else {
                    $this->addError("Error al Eliminar la Reservación");
                }
                break;
            default:
                echo "Ingreso de los datos fallida";
                break;
        }
    }

    private function prepareView()
    {
        $this->viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->lavado_nombre);
        $this->viewData["mode"] = $this->mode;
        $this->viewData["lavado_nombre"] = $this->lavado_nombre;
        $this->viewData["lavado_apellido"] = $this->lavado_apellido;
        // Asegurarse de pasar el valor del token generado a la vista
        $this->viewData["lavado_token"] = $this->lavado_token;
        $this->viewData["lavado_reservacion"] = $this->lavado_reservacion;
        $this->viewData["lavado_tipo"] = $this->lavado_tipo;
        $this->viewData["lavado_img"] = $this->lavado_img;
        $this->viewData["lavado_id"] = $this->lavado_id;
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
        $this->viewData["horasReservacion"] = ArrUtils::toOptionsArray(
            $this->horasReservacion,
            "key",
            "values",
            "selected",
            $this->lavado_reservacion
        );
        $this->viewData["tipoOpciones"] = ArrUtils::toOptionsArray(
            $this->tipoOpciones,
            "key",
            "values",
            "selected",
            $this->lavado_tipo
        );
    }


    public function run(): void
    {
        // Obtener el total de reservaciones
        $totalReservaciones = DaoCarWash::getviewReservacions();

        // Asignar el total a la variable de vista
        $this->viewData["totalReservaciones"] = $totalReservaciones;
        $this->getGetData();
        if ($this->isPostBack()) {
            $this->getPostData();
            $this->executePostAction();
        }
        $this->prepareView();
        Renderer::render("carwash/form", $this->viewData);
    }
}
