<?php

namespace Controllers\Sec;

class Login extends \Controllers\PublicController
{
    private string $txtUsuario = "";
    private string $txtPswd = "";
    private string $errorUsuario = "";
    private string $errorPswd = "";
    private string $generalError = "";
    private bool $hasError = false;

    public function run(): void
    {
        if ($this->isPostBack()) {
            $this->txtUsuario = $_POST["txtUsuario"] ?? '';
            $this->txtPswd = $_POST["txtPswd"] ?? '';

            if (\Utilities\Validators::IsEmpty($this->txtUsuario)) {
                $this->errorUsuario = "¡El Usuario no puede estar vacio!";
                $this->hasError = true;
            }

            if (\Utilities\Validators::IsEmpty($this->txtPswd)) {
                $this->errorPswd = "¡Debe ingresar una contraseña!";
                $this->hasError = true;
            }

            if (!$this->hasError) {
                $dbUser = \Dao\Security\Security::getUsuarioByUsuario($this->txtUsuario);

                if ($dbUser) {
                    if ($dbUser["userest"] !== \Dao\Security\Estados::ACTIVO) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        error_log(sprintf(
                            "ERROR: %d %s tiene cuenta con estado %s",
                            $dbUser["usercod"],
                            $dbUser["username"],
                            $dbUser["userest"]
                        ));
                    }

                    if (!\Dao\Security\Security::verifyPassword($this->txtPswd, $dbUser["userpswd"])) {
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->hasError = true;
                        error_log(sprintf(
                            "ERROR: %d %s contraseña incorrecta",
                            $dbUser["usercod"],
                            $dbUser["username"]
                        ));
                        // Aquí se deben establecer acciones según la política de la institución.
                    }

                    if (!$this->hasError) {
                        \Utilities\Security::login(
                            $dbUser["usercod"],
                            $dbUser["username"],
                            $dbUser["userest"]
                        );

                        $redirectTo = \Utilities\Context::getContextByKey("redirto");
                        \Utilities\Site::redirectTo($redirectTo !== "" ? $redirectTo : "index.php");
                    }
                } else {
                    error_log(sprintf("ERROR: %s trató de ingresar", $this->txtUsuario));
                    $this->generalError = "¡Credenciales son incorrectas!";
                }
            }
        }

        $dataView = get_object_vars($this);
        \Views\Renderer::render("security/login", $dataView);
    }
}
