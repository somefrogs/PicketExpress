
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


if(empty($_SESSION['privilege'])  || !($_SESSION['privilege'] == 'admin'))
{
	$user->redirect('login.php');
} else {
	

}





function create_ls_insert_string($name, $street_number, $street, $city, $postal_code, $coordinate_x, $coordinate_y, $serving_transithub) {

	$ls_insert_cols = "";
	$ls_insert_vals = "";
	$return_array = array();

	if (!is_null($name)) {
		$ls_insert_cols = "name, ";
		$ls_insert_vals = $name . ", "
	}

	if (!is_null($street_number)) {
		$ls_insert_cols = $ls_insert_string . "stnum, ";
		$ls_insert_vals = $ls_insert_vals . $street_number . ", ";
	}

	if (!is_null($street)) {
		$ls_insert_cols = $ls_insert_string . "street, ";
		$ls_insert_vals = $ls_insert_vals . $street . ", ";
	}

	if (!is_null($city)) {
		$ls_insert_cols = $ls_insert_string . "city, ";
		$ls_insert_vals = $ls_insert_vals . $city . ", ";
	}

	if (!is_null($postal_code)) {
		$ls_insert_cols = $ls_insert_string . "tk, ";
		$ls_insert_vals = $ls_insert_vals . $postal_code . ", ";
	}

	// if (!is_null($phone_number)) {
	// 	$ls_insert_string = $ls_insert_string . "phone_number = " . $phone_number ", ";
	// }

	if (!is_null($coordinate_x)) {
		$ls_insert_cols = $ls_insert_string . "coord_x, ";
		$ls_insert_vals = $ls_insert_vals . $coordinate_x . ", ";
	}

	if (!is_null($coordinate_y)) {
		$ls_insert_cols = $ls_insert_string . "coord_y, ";
		$ls_insert_vals = $ls_insert_vals . $coordinate_y . ", ";
	}

	if (!is_null($transit_hub)) {
		$ls_insert_cols = $ls_insert_string . "th_id, ";
		$ls_insert_vals = $ls_insert_vals . $serving_transithub . ", ";
	}
	$ls_insert_cols = substr($ls_insert_cols, 0, count($ls_insert_cols) - 2 );
	$ls_insert_vals = substr($ls_insert_vals, 0, count($ls_insert_vals) - 2 );

	$return_array[0] = $ls_insert_cols;
	$return_array[1] = $ls_insert_vals;

	return $return_array;
}


function insert_ls_employee($uname, $password, $afm, $name, $phone, $surname, $u_id, $ls_id) {
	

	$sql_query = "INSERT INTO employees  VALUES (:u_id, :afm, :phone, :name, :surrname)";
	bindValue(':afm', $afm);
	bindValue(':phone', $phone);
	bindValue(':name', $name);
	bindValue(':surrname', $surrname);
	bindValue(':u_id', $u_id);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();

	if (is_null($u_id)) {	
		$stmt = $DB_con->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'the_company_db' AND   TABLE_NAME   = 'employees'");
		$u_id = $stmt->fetch(PDO::FETCH_ASSOC)) 
	}	


	$sql_query = "INSERT INTO login VALUES (:u_id, :uname, :password, , '3')";
	bindValue(':u_id', $u_id);
	bindValue(':uname', $uname);
	bindValue(':password', $password);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();



	$sql_query = "INSERT INTO ls_employees VALUES (:u_id, :ls_id)";	
	bindValue(':u_id', $u_id);
	bindValue(':ls_id', $ls_id);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();

}



function insert_ls_employee($uname, $password, $afm, $name, $phone, $surname, $u_id, $ls_id) {
	

	$sql_query = "INSERT INTO employees  VALUES (:u_id, :afm, :phone, :name, :surrname)";
	bindValue(':afm', $afm);
	bindValue(':phone', $phone);
	bindValue(':name', $name);
	bindValue(':surrname', $surrname);
	bindValue(':u_id', $u_id);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();

	if (is_null($u_id)) {	
		$stmt = $DB_con->prepare("SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'the_company_db' AND   TABLE_NAME   = 'employees'");
		$u_id = $stmt->fetch(PDO::FETCH_ASSOC)) 
	}	


	$sql_query = "INSERT INTO login VALUES (:u_id, :uname, :password, , '2')";
	bindValue(':u_id', $u_id);
	bindValue(':uname', $uname);
	bindValue(':password', $password);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();



	$sql_query = "INSERT INTO th_employees VALUES (:u_id, :th_id)";	
	bindValue(':u_id', $u_id);
	bindValue(':th_id', $th_id);
	$stmt = $this->DB_con->prepare($sql_query);
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



function insert_ls($ls_insert_array){

	$sql_query = "INSERT INTO local_stores  (:insert_cols) VALUES (:insert_vals)";
	bindValue(':insert_cols', $ls_insert_array[0]);
	bindValue(':insert_vals', $ls_insert_array[1]);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();

}

function modify_ls($ls_id, $ls_updates) {

	$sql_query = "UPDATE local_stores SET :ls_updates WHERE ls_id = :row_id";
	bindValue(':row_id', $ls_id);
	bindValue(':ls_updates', $ls_updates)
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();

}

function create_ls_update_string($name, $street_number, $street, $city, $postal_code, $phone_number, $coordinate_x, $coordinate_y, $serving_transithub) {

	$ls_update_string = "";

	if (!is_null($name)) {
		$ls_update_string = "name = " . $name . ", ";
	}

	if (!is_null($street_number)) {
		$ls_update_string = $ls_update_string . "stnum = " . $street_number . ", ";
	}

	if (!is_null($street)) {
		$ls_update_string = $ls_update_string . "street = " . $street . ", ";
	}

	if (!is_null($city)) {
		$ls_update_string = $ls_update_string . "city = " . $city . ", ";
	}

	if (!is_null($postal_code)) {
		$ls_update_string = $ls_update_string . "tk = " . $postal_code .", ";
	}

	// if (!is_null($phone_number)) {
	// 	$ls_update_string = $ls_update_string . "phone_number = " . $phone_number . ", ";
	// }

	if (!is_null($coordinate_x)) {
		$ls_update_string = $ls_update_string . "coord_x = " . $coordinate_x . ", ";
	}

	if (!is_null($coordinate_y))s {
		$ls_update_string = $ls_update_string . "coord_y = " . $coordinate_y . ", ";
	}

	if (!is_null($transit_hub)) {
		$ls_update_string = $ls_update_string . "th_id = " . $serving_transithub . ", ";
	}

	$ls_update_string = substr($ls_update_string, 0, count($ls_update_string) - 2 );

	return $ls_update_string;
}



function insert_to_table($table_name, $insert_values) {
	$sql_query = "INSERT INTO :table_name VALUES :insert_values";
	bindValue(':table_name', $table_name);
	bindValue(':insert_values', $insert_values);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();
}


function modify_table($table_name, $table_field, $new_value, $row_id) {
	$sql_query = "UPDATE :table_name SET :table_field = :table_value WHERE id = :row_id";
	bindValue(':row_id', $row_id);
	bindValue(':table_name', $table_name);
	bindValue(':table_field', $table_field)
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();
}


function delete_row($table_name, $row_id, $id_field_name) {
	$sql_query = "DELETE FROM :table name WHERE :id = :row_id";
	bindValue(':table_name', $table_name);
	bindValue(':row_id', $row_id);
	bindValue(':id', $id_field_name);
	$stmt = $this->DB_con->prepare($sql_query);
	$stmt->execute();
}


function print_table($table_name) {
	$stmt = $DB_con->prepare("SELECT * FROM :table_name");
	bindParm(':table_name', $table_name);
	if ($stmt->execute(array($_GET['track_no']))) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			print_r($row);
		}
	}
}


?>