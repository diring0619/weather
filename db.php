<?php
$servername = "localhost"; // 通常是 localhost
$username = "longfrog_0619"; // 你的資料庫用戶名
$password = "rh86502067"; // 你的資料庫密碼
$dbname = "longfrog_ttqs"; // 你的資料庫名

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // 設定 PDO 錯誤模式為異常
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "連線成功"; 
}
catch(PDOException $e) {
    //echo "連線失敗: " . $e->getMessage();
}
?>
