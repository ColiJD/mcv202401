<?php

namespace Dao\CarWash;

use Dao\Table;

class CarWash extends Table
{
  //getAll
  public static function getAll()
  {
    return self::obtenerRegistros("SELECT * FROM carwash", []);
  }

  //getById
  public static function getById($id)
  {
    return self::obtenerUnRegistro(
      "SELECT * FROM carwash WHERE lavado_Id = :id",
      ["id" => $id]
    );
  }

  //add
  // add
  public static function add(
    $lavado_Nombre,
    $lavado_Apellido,
    $lavado_Token,
    $lavado_Reservacion,
    $lavado_Tipo,
    $lavado_Img
  ) {
    // Verificar si hay menos de 8 registros en total
    $checkSql = "SELECT COUNT(*) as total FROM carwash";

    $result = self::executeQuery($checkSql, []);

    if ($result[0]['total'] >= 8) {
      \Utilities\Site::redirectToWithMsg(
        'index.php?page=CarWash_CarWashForm&mode=INS',
        'Ya no es reservaciones disponibles para hoy.'
      );

      return false; // Salir de la función para evitar el inserto

    }

    // Si hay menos de 8 registros, proceder con el inserto
    $insertSql = "INSERT INTO carwash (lavado_Nombre, lavado_Apellido, lavado_Token, lavado_Reservacion, lavado_Tipo, lavado_Img) 
                  VALUES (:lavado_Nombre, :lavado_Apellido, :lavado_Token, :lavado_Reservacion, :lavado_Tipo, :lavado_Img)";

    try {
      return self::executeNonQuery($insertSql, [
        "lavado_Nombre" => $lavado_Nombre,
        "lavado_Apellido" => $lavado_Apellido,
        "lavado_Token" => $lavado_Token,
        "lavado_Reservacion" => $lavado_Reservacion,
        "lavado_Tipo" => $lavado_Tipo,
        "lavado_Img" => $lavado_Img
      ]);
    } catch (\PDOException $e) {
      if ($e->getCode() === "23000") { // Manejar errores de duplicado
        $errorMsg = $e->getMessage();

        if (strpos($errorMsg, 'Duplicate entry') !== false) {
          if (strpos($errorMsg, 'unique_reservation') !== false) {
            \Utilities\Site::redirectToWithMsg(
              'index.php?page=CarWash_CarWashForm&mode=INS',
              'Usted ya tiene una reservación con ese token. Por favor, elija otro.'
            );
          } else {
            \Utilities\Site::redirectToWithMsg(
              'index.php?page=CarWash_CarWashForm&mode=INS',
              'Ocurrió un error de duplicado no identificado. Por favor, intente de nuevo.'
            );
          }
        }
      }
    }
  }

  //update
  public static function update(
    $lavado_Nombre,
    $lavado_Apellido,
    $lavado_Token,
    $lavado_Reservacion,
    $lavado_Tipo,
    $lavado_Img,
    $lavado_Id
  ) {
    $updateSql = "UPDATE carwash SET lavado_Nombre = :lavado_Nombre, lavado_Apellido = :lavado_Apellido, lavado_Token = :lavado_Token, lavado_Reservacion = :lavado_Reservacion, lavado_Tipo = :lavado_Tipo, lavado_Img = :lavado_Img WHERE lavado_Id = :lavado_Id";
    return self::executeNonQuery($updateSql, [
      "lavado_Nombre" => $lavado_Nombre,
      "lavado_Apellido" => $lavado_Apellido,
      "lavado_Token" => $lavado_Token,
      "lavado_Reservacion" => $lavado_Reservacion,
      "lavado_Tipo" => $lavado_Tipo,
      "lavado_Img" => $lavado_Img,
      "lavado_Id" => $lavado_Id
    ]);
  }

  //delete
  public static function delete($id)
  {
    $deleteSql = "DELETE FROM carwash WHERE lavado_Id = :lavado_Id";
    return self::executeNonQuery($deleteSql, ["lavado_Id" => $id]);
  }
  public static function getLastInsertedId()
  {
    $sqlstr = "SELECT LAST_INSERT_ID() as id;";
    $result = self::obtenerUnRegistro($sqlstr, array());
    return $result["id"];
  }
  static public function getviewReservacions()
  {
    $sqlstr = "SELECT COUNT(*) as total FROM carwash";
    $result = self::executeQuery($sqlstr, []);

    if (count($result) > 0) {
      // Calcular reservaciones disponibles
      return 8 - $result[0]['total']; // Restar el total de reservaciones de 8
    }

    return 8; //
  }
}
