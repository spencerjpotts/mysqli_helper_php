<?php
# Author: Spencer J Potts
# Date:
#
#
class MySqlConnect {
  #
  protected static $conn;
  function __construct($address, $user, $password, $database) {
    self::$conn = mysqli_connect($address, $user, $password, $database);
    if (mysqli_connect_errno()) {

  		# Print error message
  		echo "DATABASE CONNECTION FAILED.", mysqli_connect_error();

  		# Exit current
  		exit();
  	}
  }
}
class MySqlDatabaseObject extends MySqlConnect {
  private const SELECT = 'SELECT * FROM ';

  private static $table;

  function __construct($a, $u, $p, $db){
    parent::__construct($a, $u, $p, $db);
  }

  public static function setTable($t) {
    self::$table = $t;
  }

  public static function select($args=null) {
    # query constraint
    # must be string
    $q = ($args != null ? "SELECT $args FROM " . self::$table : self::SELECT . self::$table);
    $r = mysqli_query(parent::$conn, $q);
    if (!$r)
      # table doesn't exist;
      # return doesnt exist number.
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

$connection = new MySqlDatabaseObject('localhost', 'root', '', 'test');

$connection->setTable('person');
foreach($connection->select('name, id') as $value) {
  echo $value['id'];
  echo $value['name'];
}
?>
