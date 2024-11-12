<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_COCHE.php";

ejecutaServicio(function () {

 $lista = select(pdo: Bd::pdo(),  from: COCHE,  orderBy: CO_MARCA);

 $render = "";
 foreach ($lista as $modelo) {
  $encodeId = urlencode($modelo[CO_ID]);
  $id = htmlentities($encodeId);
  $marca = htmlentities($modelo[CO_MARCA]);
  $model = htmlentities($modelo[CO_MODELO]);
  $ano = htmlentities($modelo[CO_ANO]);

  $render .=
   "<dd>
     <p>
      <a href='modifica.html?id=$id'>$marca $model $ano</a>
     </p>
    </dd>";
 }

 devuelveJson(["lista" => ["innerHTML" => $render]]);
});
