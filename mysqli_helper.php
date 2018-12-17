<?php
# Author: Spencer J Potts
# Date:
# File Style: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
#
class MySqlConnect {
  protected static $conn;
  function __construct($address, $user, $password, $database) {
    self::$conn = mysqli_connect($address, $user, $password, $database);
    if (mysqli_connect_errno()) {
  		echo "DATABASE CONNECTION FAILED.", mysqli_connect_error();
  		exit();
  	}
  }
}
class MySqlDatabaseObject extends MySqlConnect {
  private const SELECT = 'SELECT * FROM ';
  private static $table;

  public static function setTable($t): void {
    self::$table = $t;
  }

  public static function select($args=null, $where=null) {
    # query constraint
    # must be string
    if ($args != null)
      $q = "SELECT $args FROM " . self::$table;
    else
      $q = self::SELECT . self::$table;

    if ($where != null) {
      $q .= " WHERE " . $where;
    }
    $r = mysqli_query(parent::$conn, $q);
    if (!$r)
      # table doesn't exist;
      # return doesn't exist number.
      # "Failed to connect to MySQL: " . mysqli_connect_error();
      return false;
    else
      # if table does exist.
      # check result number of rows.
      # yield result row.
      if (mysqli_num_rows($r) > 0)
        while ($row = mysqli_fetch_assoc($r))
          yield $row;
  }
}
class MySqlHelper extends MySqlDatabaseObject {
  function __construct($a, $u, $p, $db) {
    MySqlConnect::__construct($a, $u, $p, $db);
  }
}

?>
