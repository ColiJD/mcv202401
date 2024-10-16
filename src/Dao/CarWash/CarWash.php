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
      "SELECT * FROM carwash WHERE lavado_Id = :id", ["id" => $id]
    );
  }
  
  //add
  public static function add(
    $lavado_Nombre,
    $lavado_Apellido,
    $lavado_Token,
    $lavado_Reservacion,
    $lavado_Tipo,
    $lavado_Img
  ) {
    $insertSql = "INSERT INTO carwash (lavado_Nombre, lavado_Apellido, lavado_Token, lavado_Reservacion, lavado_Tipo, lavado_Img) VALUES (:lavado_Nombre, :lavado_Apellido, :lavado_Token, :lavado_Reservacion, :lavado_Tipo, :lavado_Img)";
    return self::executeNonQuery($insertSql, [
      "lavado_Nombre" => $lavado_Nombre,
      "lavado_Apellido" => $lavado_Apellido,
      "lavado_Token" => $lavado_Token,
      "lavado_Reservacion" => $lavado_Reservacion,
      "lavado_Tipo" => $lavado_Tipo,
      "lavado_Img" => $lavado_Img
    ]);
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
}
