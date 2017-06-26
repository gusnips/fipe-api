<?php

require_once('../fipe_con.php');
$conn=conectar();
try
{
  $stt=$conn->prepare('
  SELECT
    UPPER(marca) as name,
    marca as fipe_name,
    "2" as `order`,
    CONCAT(REPLACE(LOWER(marca)," ","-"),"-",codigo_marca) as `key`,
    codigo_marca as id
  FROM fp_marca
  order by marca ASC
  ');
  $stt->execute();
  $result=$stt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
  echo json_encode([
    'error'=>$e->getMessage()
  ]);
  die;
}
if($result)
{
  header('Content-type:application/json;charset=utf-8');
  echo json_encode($result);
}
