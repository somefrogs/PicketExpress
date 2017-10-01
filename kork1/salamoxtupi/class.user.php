
<?php
class USER

{
  private $db;

  function __construct($DB_con)
  {
    $this->db = $DB_con;
  }



  public function login($uname,$upass)
  {
   try
   {
    $stmt = $this->db->prepare("SELECT * FROM login WHERE username=:uname LIMIT 1");
    $stmt->execute(array(':uname'=>$uname));
    $user_row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0)
    {
   //  if(password_verify($upass, $user_row['pass']))
     if(strcmp($upass, $user_row['pass']) == 0)
     {

      $_SESSION['user_session'] = $user_row['id'];
      $_SESSION['privilege'] = $user_row['ptype'];

      

     /* if($user_type == 'admin') 
      {
        $_SESSION['privilege'] = 'admin';
      } else if ($user_type == 'th_employee') 
      {
        $_SESSION['privilege'] = 'th_employee';
      }
      else if ($user_type == 'store_employee') 
      {
        $_SESSION['privilege'] = 'store_employee';
      } */

      return true;
    }
    else
    {
      return false;
    }
  }	
}
catch(PDOException $e)
{
 echo $e->getMessage();
}
}

public function is_loggedin()
{
  if(isset($_SESSION['user_session']))
  {
   return true;
 }
}

public function redirect($url)
{
 header("Location: $url");
}

public function logout()
{
  session_destroy();
  unset($_SESSION['user_session']);
  unset($_SESSION['privilege']);

  return true;
}
}
?>
