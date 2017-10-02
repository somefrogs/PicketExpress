
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>ADMIN SHIET THIS IS</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <section class="container" >
    <div class="ADMIN SHIET THIS IS" align="center">
      <h1>ADMIN SHIET THIS IS </h1>
      
    </div>

  </section>

 </body>
 </html>

<?php

require_once 'dbconfig.php';


if(empty(_$SESSION['privilege'])  || !(_$SESSION['privilege'] == 'admin'))
{
	$user->redirect('login.php');
} else {


function print_table($table_name) {
	$stmt = $dbh->prepare("SELECT * FROM :table_name");
	bindParm(':table_name', $table_name);
	if ($stmt->execute(array($_GET['track_no']))) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			print_r($row);
		}
	}
}


function insert_to_table($table_name, $insert_values) {
	$sql_query = "INSERT INTO :table_name VALUES :insert_values";
	bindParam(':table_name', $table_name);
	bindParam(':insert_values', $insert_values);
	$stmt = $this->db->prepare($sql_query);
	$stmt->execute();
}


function modify_table($table_name, $table_field, $new_value, $row_id) {
	$sql_query = "UPDATE :table_name SET :table_field = :table_value WHERE id = :row_id";
	bindParam(':row_id', $row_id);
	bindParam(':table_name', $table_name);
	bindParam(':table_field', $table_field)
	$stmt = $this->db->prepare($sql_query);
	$stmt->execute();
}


function delete_row($table_name, $row_id, $id_field_name) {
	$sql_query = "DELETE FROM :table name WHERE :id = :row_id";
	bindParam(':table_name', $table_name);
	bindParam(':row_id', $row_id);
	bindParam(':id', $id_field_name);
	$stmt = $this->db->prepare($sql_query);
	$stmt->execute();
}

function delete_ls_employee($ls_emp_id) {
	delete_row('ls_employees', $ls_emp_id, 'id');
	delete_row('employees', $ls_emp_id, 'id');

}


function delete_th_employee($th_emp_id) {
	delete_row('th_employees', $th_emp_id, 'id');
	delete_row('employees', $th_emp_id, 'th_emp_id');

}

function delete_local_store($ls_id) {
	delete_row('local_stores', $ls_id, 'ls_id');
}

function modify_ls_employee_uname($new_uname, $ls_emp_id) {
	modify_table('login', 'username', $uname, $ls_emp_id);
}

function modify_ls_employee_pass($new_pass, $ls_emp_id) {
	modify_table('login', 'password', $new_pass, $ls_emp_id);
}

function modify_th_employee_uname($new_uname, $th_emp_id) {
	modify_table('login', 'username', $uname, $th_emp_id);
}

function modify_th_employee_pass($new_pass, $th_emp_id) {
	modify_table('login', 'password', $new_pass, $th_emp_id);
}

function modify_ls($ls_id, $ls_updates) {

	$sql_query = "UPDATE local_stores SET :ls_updates WHERE ls_id = :row_id";
	bindParam(':row_id', $ls_id);
	bindParam(':ls_updates', $ls_updates)
	$stmt = $this->db->prepare($sql_query);
	$stmt->execute();

}

function create_ls_update_string($name, $street_number, $street, $city, $postal_code, $phone_number, $coordinate_x, $coordinate_y, $serving_transithub) {

	if (!is_null($name)) {
		$ls_update_string = 
	}

	return $ls_update_string;
}

}

?>