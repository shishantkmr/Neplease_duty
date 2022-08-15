<?php try{
     $pdo = new PDO("mysql:host=sql111.epizy.com;dbname=epiz_28317872_duty", "epiz_28317872", "Pv9wigHohd3");
    // $pdo = new PDO("mysql:host=localhost;dbname=neplese_duty", "root", "");
    // Set the  PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
  ?>