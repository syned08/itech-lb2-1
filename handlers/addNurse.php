<?php
    include('../connect.php');

    if(!isset($_POST['nurse']) || !isset($_POST['date']) || !isset($_POST['department']) || !isset($_POST['shift']))
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
  <link rel="stylesheet" href="../styles/getNurse.css">
  <title>Добавление медсестры</title>
</head>
<body>
  <main class="container">
    <?php
      $nurse = $_POST['nurse'];
      $date = $_POST['date'];
      $department = $_POST['department'];
      $shift = $_POST['shift'];

      try {
        $sql_index = "SELECT max(id_nurse) FROM nurse";
        $index_max = $dbh->query($sql_index);

        foreach($dbh->query($sql_index) as $row)
        {
          $index_max = $row[0] + 1;
        }

        $sql = "INSERT INTO `nurse` (`id_nurse`, `name`, `date`, `department`, `shift`) VALUES (:index_max, :nurse, :date, :department, :shift)";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
          ':index_max' => $index_max,
          ':nurse' => $nurse,
          ':date' => $date,
          ':department' => $department,
          ':shift' => $shift
      ));

        echo "<h1 class=\"main_header\">Медсестра '$nurse' успешно добавлена в базу данных</h1>";
      } catch (PDOException $ex) {
        die("Error! " . $ex->GetMessage() . "<br/>");
      }
      ?>
    </section>
  </main>
</body>
</html>