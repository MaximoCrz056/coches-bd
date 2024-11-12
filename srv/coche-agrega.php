<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_COCHE.php";

ejecutaServicio(function () {

 $marca = recuperaTexto("marca");
 $model = recuperaTexto("modelo");
 $ano = recuperaTexto("ano");

 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: COCHE, values: [CO_MARCA => $marca, CO_MODELO => $model, CO_ANO => $ano]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/coche.php?id=$encodeId", [
  "id" => ["value" => $id],
  "marca" => ["value" => $marca],
  "modelo" => ["value" => $model],
  "ano" => ["value" => $ano],
 ]);
});
