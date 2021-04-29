<?php
  include('../connect.php');

  if(!isset($_GET['department']))
  {
    echo "Ошибка! Отсутствуют данные о палате!";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/getNurse.css">
  <title>Медсестры</title>
</head>
<body>
  <main class="container">
    <?php
      $department = $_GET['department'];
      echo "<h1 class=\"main_header\">Медсестры, которые работают в $department отделении</h1>";
    ?>
    <section class="wrapper-card">
      <?php
        try {
          $sql = "SELECT `name` FROM nurse WHERE department=:department";

          $sth = $dbh->prepare($sql);
          $sth->bindValue(':department', $department, PDO::PARAM_STR);
          $sth->execute();

          $nurses = $sth->fetchAll(PDO::FETCH_NUM);

          foreach ($nurses as $nurse) {
            print "<div class=\"card\">$nurse[0]</div>";
          }
        } catch (PDOException $ex) {
          die("Error! " . $ex->GetMessage() . "<br/>");
        }
      ?>
    </section>
  </main>
</body>
</html>