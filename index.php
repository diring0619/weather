
<?php
include "database/db.php";  //相對路徑


$sql=  "select * from w_condition";
$stim=$pdo->query($sql);

?>

<html>

    <head> 
        <title>天氣預報系統 </title>
    </head>
    <body> 





<?php

 // print_r($stim->fetchAll(PDO::FETCH_ASSOC));
/*
$a=["溫度"=>10,22,"地區"=>"高雄","2026/03/30"]; //一維陣列


foreach($a as $row)
{
    echo $row;
    
}
echo "<br>";
echo $a["溫度"];

$b=[
    "台南"=>["id"=>1,"temperature"=>23.5,"rain"=>500,"wet"=>20,"w_time"=>"2026/03/30"],
    "高雄"=>["id"=>2,"temperature"=>23.5,"rain"=>500,"wet"=>20,"w_time"=>"2026/03/30"]
];

//echo $b["高雄"]["w_time"];    //二維陣列
echo "<hr>";
foreach($b as $row)
{
    echo $row["temperature"];
    echo  "<br>";
}
*/

$stim2=$stim->fetchAll(PDO::FETCH_ASSOC);
foreach($stim2 as $row)
{
    echo "id=";
    echo $row["id"];
    echo "溫度=";
    echo $row["temperature"];
    echo "雨量=";
    echo $row["rain"];
    echo "濕度=";
    echo $row["wet"];
    echo "時間:";
    echo $row["w_time"];
    echo "地區:";
    echo $row["area"];
    echo "<br>";
}

?>


CWB-C8433897-2A17-4D5F-A4C8-BC44D748F04D

    </body>


</html>