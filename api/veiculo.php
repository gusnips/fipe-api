<?php
if(!isset($_GET['cod']))
{
  echo json_encode([
    'error'=>'Nenhum modelo fornecido'
  ]);
}
$modelo=$_GET['cod'];

require_once('../fipe_con.php');
$conn=conectar();
try
{
  $stt=$conn->prepare('
    SELECT
      c.marca as fipe_marca,
      CONCAT(a.ano, "-1") as fipe_codigo,
      CONCAT_WS(" ", a.ano, a.combustivel) as name,
      UPPER(c.marca) as marca,
      CONCAT(a.ano, "-1") as `key`,
      m.modelo as veiculo,
      CONCAT(a.ano, "-1") as id
    FROM fp_ano a
    INNER JOIN fp_modelo m ON a.codigo_modelo=m.codigo_modelo
    INNER JOIN fp_marca c ON m.codigo_marca=c.codigo_marca
    WHERE a.codigo_modelo=:modelo
  ');
  $stt->bindParam(':modelo',$modelo);
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
