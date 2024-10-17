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
    $insertSql = "INSERT INTO carwash (lavado_Nombre, lavado_Apellido, lavado_Token, lavado_Reservacion, lavado_Tipo, lavado_Img) VALUES (:lavado_Nombre, :lavado_Apellido, :lavado_Token, :lavado_Reservacion, :lavado_Tipo, :lavado_Img)";

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
      if ($e->getCode() === "23000") { // Código de error para violación de integridad
        $errorMsg = $e->getMessage();

        // Verificar si la clave violada es 'unique_reservation_token'
        if (strpos($errorMsg, 'unique_reservation_token') !== false) {
          \Utilities\Site::redirectToWithMsg(
            'index.php?page=CarWash_CarWashForm&mode=INS',
            'Usted ya tiene una reservación o la hora ya a sido reservada. Por favor, elija otra hora o espere a que su token se reinicie.'
          );
        } else {
          // Ocurrió un error de duplicado, pero no se identificó la clave única
          \Utilities\Site::redirectToWithMsg(
            'index.php?page=CarWash_CarWashForm&mode=INS',
            'Ocurrió un error de duplicado no identificado. Por favor, intente de nuevo.'
          );
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
}
