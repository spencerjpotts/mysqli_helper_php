<?php
  # Include the class file mysqli_help.php from relative or linked file location/ directory.
  include 'mysqli_helper.php';

  $mysql_obj = new MySqlHelper('localhost', 'root', '', 'test');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>MySqlHelper test html/php</title>
  </head>
  <body>

    <h1>My First Heading</h1>
    <p>My first paragraph.</p>

    <ul>
      <?php
      $mysql_obj->setTable('person');
      foreach($mysql_obj->select($args='name, id', $where='id = 1') as $value) {
        echo "<li>";
        echo $value['id'];
        echo $value['name'];
        echo "</li>";
      }
      ?>
    </ul>
  </body>
</html>
