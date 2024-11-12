<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   //self::$pdo->exec("DROP TABLE IF EXISTS COCHE");

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS COCHE (
      CO_ID INTEGER,
      CO_MARCA TEXT NOT NULL,
      CO_MODELO TEXT NOT NULL,
      CO_ANO INTEGER,
      CONSTRAINT CO_PK
       PRIMARY KEY(CO_ID),
      CONSTRAINT CO_MARCA
       CHECK(LENGTH(CO_MARCA) > 0)
      CONSTRAINT CO_MODELO
       CHECK(LENGTH(CO_MODELO > 0))
      CONSTRAINT CO_ANO
       CHECK(CO_ANO BETWEEN 1980 AND 2024)
     )"
   );
  }

  return self::$pdo;
 }
}
