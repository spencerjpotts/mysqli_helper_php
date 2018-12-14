<?php
#
#
#
#
class MySqlConnect {
  public function __construct($address, $user, $password, $database) {
    $conn = new mysqli($address, $user, $password, $database);
  }
}
class MySqlDatabaseObject extends MySqlConnect {
  private const SELECT = 'SELECT * FROM ';
  private const INSERT = '';
  private const UPDATE = '';
  private const DELETE = '';

  public static function select($t) {
    return self::SELECT . "'$t'";
  }
  function insert() {

  }
  function update() {

  }
  function delete() {

  }
}
?>
