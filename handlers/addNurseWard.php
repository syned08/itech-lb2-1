<?php
    include('../connect.php');

    if(!isset($_POST['nurse']) || !isset($_POST['ward']))
    {
      echo "Ошибка! Отсутствуют данные о дежурстве!";
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
  <title>Добавление дежурства</title>
</head>
<body>
  <main class="container">
    <?php
      $nurse = $_POST['nurse'];
      $ward = $_POST['ward'];

      try {
        $sql = "INSERT INTO `nurse_ward` (`fid_nurse`, `fid_ward`) VALUES (:nurse, :ward)";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
          ':nurse' => $nurse,
          ':ward' => $ward
      ));

        echo "<h1 class=\"main_header\">Дежурство успешно добавлено в базу данных</h1>";
      } catch (PDOException $ex) {
        die("Error! " . $ex->GetMessage() . "<br/>");
      }
      ?>
    </section>
  </main>
</body>
</html>