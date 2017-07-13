<?php
if(!isset($_GET['cod']))
{
  echo json_encode([
    'error'=>'Nenhuma fipe'
  ]);
}
$fipe=$_GET['cod'];

require_once('../fipe_con.php');
$conn=conectar();
try
{
  $stt=$conn->prepare('
    SELECT modelo, codigo_fipe FROM fp_modelo WHERE codigo_fipe=:fipe limit 1
  ');
  $stt->bindParam(':fipe',$fipe);
  $stt->execute();
  $result=$stt->fetch(PDO::FETCH_ASSOC);
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
