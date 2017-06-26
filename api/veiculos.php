<?php
if(!isset($_GET['cod']))
{
  echo json_encode([
    'error'=>'Nenhuma marca fornecida'
  ]);
}
$marca=$_GET['cod'];

require_once('../fipe_con.php');
$conn=conectar();
try
{
  $stt=$conn->prepare('
    SELECT
      c.marca as fipe_marca,
      m.modelo as name,
      UPPER(c.marca) as marca,
      CONCAT(LOWER(SUBSTRING_INDEX(m.modelo, " ", 1)),"-",m.codigo_modelo) as `key`,
      m.codigo_modelo as id,
      m.modelo as fipe_name
    FROM fp_modelo m
    INNER JOIN fp_marca c ON m.codigo_marca=c.codigo_marca
    WHERE m.codigo_marca=:marca
  ');
  $stt->bindParam(':marca',$marca);
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
