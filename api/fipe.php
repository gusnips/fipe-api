<?php
if(!isset($_GET['cod']))
{
  echo json_encode([
    'error'=>'Nenhuma fipe'
  ]);
}
require_once('../fipe_con.php');
$conn=conectar();
$fipe=$_GET['cod'];

$stt=$conn->prepare('select modelo from fp_modelo where codigo_fipe=:fipe limit 1');
$stt->bindParam(':fipe',$fipe);
$stt->execute();
$result=$stt->fetch(PDO::FETCH_ASSOC);
if($result)
{
  echo json_encode($result);
}
