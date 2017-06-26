<?php
if(!isset($_GET['cod']))
{
  echo json_encode([
    'error'=>'Nenhum modelo fornecido'
  ]);
}
if(!isset($_GET['ano']))
{
  echo json_encode([
    'error'=>'Nenhum ano fornecido'
  ]);
}
$modelo=$_GET['cod'];
$ano=substr($_GET['ano'],0,-2);

require_once('../fipe_con.php');
$conn=conectar();
try
{
  $stt=$conn->prepare('
    SELECT
      "junho de 2017" as referencia,
      a.codigo_fipe as fipe_codigo,
      m.modelo as name,
      a.combustivel as combustivel,
      c.marca as marca,
      a.ano as ano_modelo,
      a.valor as preco,
      CONCAT(LOWER(SUBSTRING_INDEX(m.modelo, " ", 1)),"-",a.ano) as `key`,
      "0" as time,
      m.modelo as veiculo,
      a.ano as id
    FROM fp_ano a
    INNER JOIN fp_modelo m ON a.codigo_modelo=m.codigo_modelo
    INNER JOIN fp_marca c ON m.codigo_marca=c.codigo_marca
    WHERE a.codigo_modelo=:modelo and a.ano=:ano
    LIMIT 1
  ');
  $stt->bindParam(':modelo',$modelo);
  $stt->bindParam(':ano',$ano);
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
