
<?php

include "database/db.php";

$url="https://opendata.cwa.gov.tw/api/v1/rest/datastore/";
$class="F-C0032-001";
$Authorization="CWB-C8433897-2A17-4D5F-A4C8-BC44D748F04D";
$locationName="臺北市";
$format="JSON";

$newUrl=$url.$class."?Authorization=".$Authorization."&locationName=".$locationName."&format=".$format;

  $jsonRaw = file_get_contents($newUrl);//取得json 資料
  $weatherArray= json_decode($jsonRaw, true);
// print_r( $weatherArray);
echo "降雨機率：";
 echo $weatherArray['records']['location'][0]['weatherElement'][1]['time'][0]['parameter']['parameterName'];
 echo "<br>";
 echo "最低溫度:";
  echo $weatherArray['records']['location'][0]['weatherElement'][2]['time'][0]['parameter']['parameterName'];
  echo "<br>";
  echo "舒適度指數:";
  echo $weatherArray['records']['location'][0]['weatherElement'][3]['time'][0]['parameter']['parameterName'];
  echo "<br>";
  echo "最高溫度:";
  echo $weatherArray['records']['location'][0]['weatherElement'][4]['time'][0]['parameter']['parameterName'];
 
  
  $temperature = $weatherArray['records']['location'][0]['weatherElement'][2]['time'][0]['parameter']['parameterName'];//溫度資料
  $area=$locationName;//地區
  $rain=500;//雨量
  $wet=20;//濕度
  $w_time=date("y-m-d h:i:s");

  $sql="INSERT INTO w_condition(id, temperature, rain, wet, w_time, area) VALUES (null,?,?,?,?,?)";
  $simt=$pdo->prepare($sql);

  if($simt->execute([$temperature,$rain, $wet,$w_time,$area]))
  {
    echo "存入資料庫成功";
  }else{
    echo "失敗";
  }

?>

