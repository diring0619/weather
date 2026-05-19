<?php
include "database/db.php";  //相對路徑


$sql=  "select * from w_condition";
$stim=$pdo->query($sql);

?>

<html>

    <head> 
        <title>天氣預報系統 </title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f2f5;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
            }
            .weather-container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                padding: 20px;
                width: 400px;
                text-align: center;
            }
            h1 {
                color: #333;
                margin-bottom: 20px;
            }
            .weather-data {
                margin-top: 20px;
                border-top: 1px solid #eee;
                padding-top: 20px;
            }
            .weather-item {
                display: flex;
                justify-content: space-between;
                padding: 10px 0;
                border-bottom: 1px solid #eee;
            }
            .weather-item:last-child {
                border-bottom: none;
            }
            .weather-item span:first-child {
                font-weight: bold;
            }
            .area-selector {
                margin-bottom: 20px;
            }
            .area-selector label {
                margin-right: 10px;
            }
            .area-selector select {
                padding: 8px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }
        </style>
    </head>
    <body> 
        <div class="weather-container">
            <h1>天氣預報系統</h1>

            <div class="area-selector">
                <label for="area-select">選擇地區:</label>
                <select id="area-select" onchange="this.form.submit()">
                    <option value="">所有地區</option>
                    <?php
                        $areas_sql = "SELECT DISTINCT area FROM w_condition";
                        $areas_stmt = $pdo->query($areas_sql);
                        while ($area_row = $areas_stmt->fetch(PDO::FETCH_ASSOC)) {
                            $selected = (isset($_POST['area']) && $_POST['area'] == $area_row['area']) ? 'selected' : '';
                            echo "<option value=\"" . $area_row['area'] . "\" $selected>" . $area_row['area'] . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="weather-data">
                <?php
                    $selected_area = isset($_POST['area']) ? $_POST['area'] : '';
                    $sql = "SELECT * FROM w_condition";
                    if (!empty($selected_area)) {
                        $sql .= " WHERE area = :area";
                    }
                    $stmt = $pdo->prepare($sql);
                    if (!empty($selected_area)) {
                        $stmt->bindParam(':area', $selected_area);
                    }
                    $stmt->execute();
                    $weather_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($weather_data)) {
                        echo "<p>沒有找到天氣資料。</p>";
                    } else {
                        foreach($weather_data as $row) {
                            echo "<div class=\"weather-item\">";
                            echo "<span>地區:</span><span>" . $row["area"] . "</span>";
                            echo "</div>";
                            echo "<div class=\"weather-item\">";
                            echo "<span>溫度:</span><span>" . $row["temperature"] . "°C</span>";
                            echo "</div>";
                            echo "<div class=\"weather-item\">";
                            echo "<span>雨量:</span><span>" . $row["rain"] . " mm</span>";
                            echo "</div>";
                            echo "<div class=\"weather-item\">";
                            echo "<span>濕度:</span><span>" . $row["wet"] . "%</span>";
                            echo "</div>";
                            echo "<div class=\"weather-item\">";
                            echo "<span>時間:</span><span>" . $row["w_time"] . "</span>";
                            echo "</div>";
                            echo "<hr>";
                        }
                    }
                ?>
            </div>
        </div>

        <script>
            // JavaScript for handling form submission on select change
            document.getElementById('area-select').addEventListener('change', function() {
                this.form.submit();
            });
        </script>
    </body>


</html>