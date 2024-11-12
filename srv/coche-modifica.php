<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_COCHE.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $marca = recuperaTexto("marca");
 $model = recuperaTexto("modelo");
 $ano = recuperaTexto("ano");

 $marca = validaNombre($marca);

 update(
  pdo: Bd::pdo(),
  table: COCHE,
  set: [CO_MARCA => $marca, CO_MODELO => $model, CO_ANO => $ano],
  where: [CO_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "marca" => ["value" => $marca],
  "modelo" => ["value" => $model],
  "ano" => ["value" => $ano],
 ]);
});
