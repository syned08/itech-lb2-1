<?php
  include('../connect.php');

  if(!isset($_GET['nursname']))
  {
    echo "Ошибка! Отсутствуют данные о медсестре!";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/getWard.css">
  <title>Палаты</title>
</head>
<body>
  <main class="container">
    <?php
      $nurse = $_GET['nursname'];
      echo "<h1 class=\"main_header\">Палаты, в которых дежурит медсестра '$nurse'</h1>";
    ?>
    <section class="wrapper-card">
      <?php
        try {
          $sql = "SELECT ward.name FROM ward, nurse, nurse_ward WHERE nurse.name=:nurse AND id_nurse=fid_nurse AND fid_ward=id_ward";

          $sth = $dbh->prepare($sql);
          $sth->bindValue(':nurse', $nurse, PDO::PARAM_STR);
          $sth->execute();

          $wards = $sth->fetchAll(PDO::FETCH_NUM);

          foreach ($wards as $ward) {
            print "<div class=\"card\">$ward[0]</div>";
          }
        } catch (PDOException $ex) {
          die("Error! " . $ex->GetMessage() . "<br/>");
        }
      ?>
    </section>
  </main>
</body>
</html>