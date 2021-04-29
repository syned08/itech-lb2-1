<?php
    include('../connect.php');

    if(!isset($_POST['ward']))
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
  <title>Добавление палаты</title>
</head>
<body>
  <main class="container">
    <?php
      $ward = $_POST['ward'];

      try {
        $sql_index = "SELECT max(id_ward) FROM ward";
        $index_max = $dbh->query($sql_index);

        foreach($dbh->query($sql_index) as $row)
        {
          $index_max = $row[0] + 1;
        }

        $sql = "INSERT INTO `ward` (`id_ward`, `name`) VALUES (:index_max, :ward)";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
          ':index_max' => $index_max,
          ':ward' => $ward
      ));

        echo "<h1 class=\"main_header\">Палата '$ward' успешно добавлена в базу данных</h1>";
      } catch (PDOException $ex) {
        die("Error! " . $ex->GetMessage() . "<br/>");
      }
      ?>
    </section>
  </main>
</body>
</html>