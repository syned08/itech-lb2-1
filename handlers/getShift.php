<?php
  include('../connect.php');

  if(!isset($_GET['shift']))
  {
    echo "Ошибка! Отсутствуют данные о смене!";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/getShift.css">
  <title>Дежурства</title>
</head>
<body>
  <main class="container">
    <?php
      $shift = $_GET['shift'];
      echo "<h1 class=\"main_header\">Дежурства в '$shift' смену</h1>";
    ?>
    <section>
      <table class="table-shift">
        <tr>
          <th>Медсестра</th>
          <th>Дата</th>
          <th>Палата</th>
        </tr>
      <?php
        try {
          $sql = "SELECT nurse.name, nurse.date, ward.name FROM nurse, nurse_ward, ward WHERE nurse.shift=:shift AND nurse.id_nurse=nurse_ward.fid_nurse AND ward.id_ward=nurse_ward.fid_ward";

          $sth = $dbh->prepare($sql);
          $sth->bindValue(':shift', $shift, PDO::PARAM_STR);
          $sth->execute();

          $shifts = $sth->fetchAll(PDO::FETCH_NUM);
          
          foreach ($shifts as $shift) {
            $nurse_name = $shift[0];
            $date = $shift[1];
            $ward_name = $shift[2];

            print "<tr> <td>$nurse_name</td> <td>$date</td> <td>$ward_name</td> </tr>";
          }
        } catch (PDOException $ex) {
          die("Error! " . $ex->GetMessage() . "<br/>");
        }
      ?>
      </table>
    </section>
  </main>
</body>
</html>