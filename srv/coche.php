<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_COCHE.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");

 $modelo =
  selectFirst(pdo: Bd::pdo(),  from: COCHE,  where: [CO_ID => $id]);

 if ($modelo === false) {
  $idHtml = htmlentities($id);
  throw new ProblemDetails(
   status: NOT_FOUND,
   title: "Coche no encontrado.",
   type: "/error/pasatiemponoencontrado.html",
   detail: "No se encontró ningún coche con el id $idHtml.",
  );
 }

 devuelveJson([
  "id" => ["value" => $id],
  "marca" => ["value" => $modelo[CO_MARCA]],
  "modelo"=> ["value"=> $modelo[CO_MODELO]],
  "ano" => ["value"=> $modelo[CO_ANO]],
 ]);
});
