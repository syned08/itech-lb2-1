<?php
  include('connect.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/index.css">
  <title>Поликлиника</title>
</head>
<body>
  <main class="container">
    <h1 class="main_header">Поликлиника</h1>

    <section class="form-card">
      <h4 class="form-card__header">Получить перечень палат, в которых дежурит выбранная медсестра</h4>
      <form action="./handlers/getWard.php" method='GET'>
        <select name="nursname" id="nursname" class="form-card_select">
          <?php
            try {
              $sql = 'SELECT DISTINCT `name` from `nurse`';
              foreach($dbh->query($sql) as $row)
              {
                $name = $row[0];
                print "<option value='$name'>$name</option>";
              }
            } catch (PDOException $ex) {
              die("Error! " . $ex->GetMessage() . "<br/>");
            }
          ?>
        </select>
        <input type="submit" value="Получить" class="form-card_btn">
      </form>
    </section>

    <section class="form-card">
      <h4 class="form-card__header">Получить перечень медсестр из указаного отделения</h4>
      <form action="./handlers/getNurse.php" method='GET'>
        <select name="department" id="department" class="form-card_select">
          <?php
            try {
              $sql = 'SELECT DISTINCT `department` from nurse';
              foreach($dbh->query($sql) as $row)
              {
                $name = $row[0];
                print "<option value='$name'>$name</option>";
              }
            } catch (PDOException $ex) {
              die("Error! " . $ex->GetMessage() . "<br/>");
            }
          ?>
        </select>
        <input type="submit" value="Получить" class="form-card_btn">
      </form>
    </section>

    <section class="form-card">
      <h4 class="form-card__header">Получить перечень дежурств в указанную смену</h4>
      <form action="./handlers/getShift.php" method='GET'>
        <select name="shift" id="shift" class="form-card_select">
          <?php
            try {
              $sql = 'SELECT DISTINCT `shift` from nurse';
              foreach($dbh->query($sql) as $row)
              {
                $name = $row[0];
                print "<option value='$name'>$name</option>";
              }
            } catch (PDOException $ex) {
              die("Error! " . $ex->GetMessage() . "<br/>");
            }
          ?>
        </select>
        <input type="submit" value="Получить" class="form-card_btn">
      </form>
    </section>

    <section class="form-card">
      <h4 class="form-card__header">Добавить новую медсестру</h4>
      <form action="./handlers/addNurse.php" method='POST' class="add-nurse">
        <div class="input__container">
          <div>
            <label for="nurse">Имя</label>
            <input type="text" name="nurse" id="nurse" class="form-card_select" value="Name" required pattern="^[a-zA-ZА-Яа-яЁё]+$"/>

            <label for="date">Дата дежурства</label>
            <input type="date" name="date" id="date" class="form-card_select" required value="2021-04-24"/>
          </div>
          <div>
            <label for="department">Отделение</label>
            <select name="department" id="department" class="form-card_select" required>
              <?php
                try {
                  $sql = 'SELECT DISTINCT `department` from nurse';
                  foreach($dbh->query($sql) as $row)
                  {
                    $name = $row[0];
                    print "<option value='$name'>$name</option>";
                  }
                } catch (PDOException $ex) {
                  die("Error! " . $ex->GetMessage() . "<br/>");
                }
              ?>
            </select>

            <label for="shift">Смена</label>
            <select name="shift" id="shift" class="form-card_select" required>
              <?php
                try {
                  $sql = 'SELECT DISTINCT `shift` from nurse';
                  foreach($dbh->query($sql) as $row)
                  {
                    $name = $row[0];
                    print "<option value='$name'>$name</option>";
                  }
                } catch (PDOException $ex) {
                  die("Error! " . $ex->GetMessage() . "<br/>");
                }
              ?>
            </select>
          </div>
        </div>
        <input type="submit" value="Добавить" class="form-card_btn">
      </form>
    </section>

    <section class="form-card">
      <h4 class="form-card__header">Добавить новую палату</h4>
      <form action="./handlers/addWard.php" method='POST'>
        <div class="new-ward">
          <label for="ward">Название палаты</label>
          <input type="text" name="ward" id="ward" class="form-card_select" value="Name" required pattern="^[a-zA-ZА-Яа-яЁё]+$"/>
        </div>
        <input type="submit" value="Добавить" class="form-card_btn">
      </form>
    </section>

    <section class="form-card">
      <h4 class="form-card__header">Назначить дежурство</h4>
      <form action="./handlers/addNurseWard.php" method='POST' class="add-nurse">
        <div class="input__container">
          <div>
            <label for="nurse">Медсестра</label>
            <select name="nurse" id="nurse" class="form-card_select" required>
              <?php
                try {
                  $sql = 'SELECT DISTINCT `name`, `id_nurse` from nurse';
                  foreach($dbh->query($sql) as $row)
                  {
                    $name = $row[0];
                    $id_nurse = $row[1];
                    print "<option value='$id_nurse'>$name</option>";
                  }
                } catch (PDOException $ex) {
                  die("Error! " . $ex->GetMessage() . "<br/>");
                }
              ?>
            </select>

            <label for="ward">Палата</label>
            <select name="ward" id="ward" class="form-card_select" required>
              <?php
                try {
                  $sql = 'SELECT DISTINCT `name`, `id_ward` from ward';
                  foreach($dbh->query($sql) as $row)
                  {
                    $name = $row[0];
                    $id_ward = $row[1];
                    print "<option value='$id_ward'>$name</option>";
                  }
                } catch (PDOException $ex) {
                  die("Error! " . $ex->GetMessage() . "<br/>");
                }
              ?>
            </select>
          </div>
        </div>
        <input type="submit" value="Добавить" class="form-card_btn">
      </form>
    </section>
  </main>
</body>
</html>