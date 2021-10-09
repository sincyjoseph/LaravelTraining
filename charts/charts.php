<?php
include("fusioncharts.php");
$hostdb = "localhost"; 
$userdb = "root";  
$passdb = "";  
$namedb = "userform";  
$conn = new mysqli($hostdb, $userdb, $passdb, $namedb);
if ($conn->connect_error) {
    exit("There was an error with your connection: ".$conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
</head>
<body>

    <?php
    try{
    $selectQuery = "SELECT * FROM users";
    $countQuery = "SELECT gender,COUNT(*) AS cnt FROM users GROUP BY gender";
    $topTwoQuery = "SELECT username, created_at FROM users WHERE status=1 LIMIT 2";

    $selectresult = $conn->query($selectQuery) or exit("Error code ({$conn->errno}): {$conn->error}");
    $countresult = $conn->query($countQuery) or exit("Error code ({$conn->errno}): {$conn->error}");
    $topTworesult = $conn->query($topTwoQuery) or exit("Error code ({$conn->errno}): {$conn->error}");

    //coloumn chart
    if($selectresult) {
        $arrData = array(
            "chart" => array(
                "caption" => "User details",
                "xAxisName" => "Users",
                "yAxisName" => "Status",
                "rotatevalues" => "1",
                "theme" => "fusion"
              )
          );
        $arrData["data"] = array();
        while($row = $selectresult->fetch_assoc()) {
            array_push($arrData["data"], array(
                "label" => $row["username"],
                "value" => $row["status"],
                )
            );
          }
          $jsonEncodedData = json_encode($arrData);
          $columnChart = new FusionCharts("column3D", "myFirstChart" , 400, 400, "col-chart", "json", $jsonEncodedData);
          $columnChart->render();
      }

    //pie chart
    if($countresult){
      $arrData = array(
          "chart" => array(
              "caption" => "User details",
            )
      );
      $arrData["data"] = array();
      while($row = $countresult->fetch_assoc()){
          $arrData["data"][] = array(
              "label" => $row["gender"],
              "value" => $row["cnt"]
          );
      }
        // echo '<pre>';
        // print_r($dataPiechart); die();
        $jsonEncodedData = json_encode($arrData);
        $pieChart = new FusionCharts("pie3d", "myFirstChart2" , 400, 400, "pie-chart", "json", $jsonEncodedData);
        $pieChart->render();
        $doughnutChart = new FusionCharts("doughnut2d", "myFirstChart5" , 400, 400, "doughnut-chart", "json", $jsonEncodedData);
        $doughnutChart->render();
    }

    //Bar chart
    if($topTworesult){
        $arrData = array(
            "chart" => array(
                "caption" => "User details",
              )
        );
        $arrData["data"] = array();
        while($row = $topTworesult->fetch_assoc()){
            $arrData["data"][] = array(
                "label" => $row["username"],
                "value" => $row["created_at"]
            );
        }
        $jsonEncodedData = json_encode($arrData);
        $pieChart = new FusionCharts("bar3d", "myFirstChart3" , 400, 400, "bar-chart", "json", $jsonEncodedData);
        $pieChart->render();
    }

    //area chart
        $arrData = array(
            "chart" => array(
                "theme" =>"fusion",
                "caption" => "User details",
                "xAxisName" => "created",
                "yAxisName" => "count of users",
              )
        );
        $arrData["data"] = array();
            $arrData["data"][] = array(
                "label" => "2021-09-12",
                "value" => "133"
            );
            $arrData["data"][] = array(
                "label" => "2021-09-13",
                "value" => "344"
            );
            $arrData["data"][] = array(
                "label" => "2021-09-14",
                "value" => "855"
            );
        $jsonEncodedData = json_encode($arrData);
        $pieChart = new FusionCharts("area2d", "myFirstChart4" , 400, 400, "area-chart", "json", $jsonEncodedData);
        $pieChart->render();
    
    //

    }catch(Exception $e){
        echo $e->getMessage();
    }
    

    ?>

        <div id="col-chart"></div>
        <div id="pie-chart"></div>
        <div id="bar-chart"></div>
        <div id="area-chart"></div>
        <div id="doughnut-chart"></div>
        
</body>
</html>