<?php

function conectarDB() : mysqli {
  $db = new mysqli('localhost', 'root', 'root', 'bienesraices_mvc');

  if(!$db) {
    echo "Error! No se pudo Conectar la BD";
    exit;
  }

  return $db;
}