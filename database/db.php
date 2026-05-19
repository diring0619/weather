<?php
$host = 'localhost';
$db   = 'longfrog_dining_table'; // 剛才建的資料庫名
$user = 'longfrog_0619';
$pass = 'rh86502067'; // XAMPP 預設密碼為空
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    // 建立連線物件
    $pdo = new PDO($dsn, $user, $pass);
    // 設定錯誤模式為：拋出例外（方便除錯）
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "連線成功！"; 
} catch (PDOException $e) {
    die("連線失敗：" . $e->getMessage());
}








?>