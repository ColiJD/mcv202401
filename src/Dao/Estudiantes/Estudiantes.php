<?php

namespace Dao\Estudiantes;

use Dao\Table;

class Estudiantes extends Table
{
  //getAll
  public static function getAll()
  {
    return self::obtenerRegistros("SELECT * FROM EstudianteCienciasComputacionales", []);
  }
  //getById
  public static function getById($id)
  {
    return self::obtenerUnRegistro(
      "SELECT * FROM EstudianteCienciasComputacionales WHERE id_estudiante = :id",
      ["id" => $id]
    );
  }
  //add
  public static function add(
    $nombre,
    $apellido,
    $edad,
    $especialidad
  ) {
    $insersql = "INSERT INTO EstudianteCienciasComputacionales (nombre,apellido,edad,especialidad) VALUES (:nombre,:apellido,:edad,:especialidad)";
    return self::executeNonQuery($insersql, [
      "nombre" => $nombre,
      "apellido" => $apellido,
      "edad" => $edad,
      "especialidad" => $especialidad
    ]);
  }
  //update
  public static function update(
    $nombre,
    $apellido,
    $edad,
    $especialidad,
    $id_estudiante
  ) {
    $updateSql = "UPDATE EstudianteCienciasComputacionales SET nombre = :nombre,apellido=:apellido,edad=:edad,especialidad=:especialidad WHERE id_estudiante = :id_estudiante";
    return self::executeNonQuery($updateSql, [
      "nombre" => $nombre,
      "apellido" => $apellido,
      "edad" => $edad,
      "especialidad" => $especialidad,
      "id_estudiante" => $id_estudiante
    ]);
  }
  //delete
  public static function delete($id)
  {
    $deleteSql = "DELETE FROM EstudianteCienciasComputacionales WHERE id_estudiante = :id_estudiante";
    return self::executeNonQuery($deleteSql, ["id_estudiante" => $id]);
  }
}
