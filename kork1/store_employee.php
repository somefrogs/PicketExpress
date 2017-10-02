
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>this_is_store_aemoapoasodapods</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<section class="container" >
		<div class="this_is_store_aemoapoasodapods" align="center">
			<h1>this_is_store_aemoapoasodapods </h1>

		</div>

	</section>

</body>
</html>


<?php
require_once 'dbconfig.php';

$cost_graph = array(
	array(0, 1, 0, 0, 0, 3, 0, 0, 0),
	array(1, 0, 3, 1, 0, 0, 5, 0, 0),
	array(0, 3, 0, 0, 0, 0, 10, 0 ,15),
	array(0, 1, 0, 0, 0, 0, 2, 0, 0),
	array(0, 0, 0, 0, 0, 0, 8, 0, 0),
	array(3, 0, 0, 0, 0, 0, 2, 2 ,0),
	array(0, 5, 10, 2, 8, 2, 0, 3, 10),
	array(0, 0, 0, 0, 0, 2, 3, 0, 4),
	array(0, 0, 15, 0, 0, 0, 10, 4, 0),
	
	);

$time_graph = array(
	array(0, 1, 0, 0, 0, 1, 0, 0, 0),
	array(1, 0, 1, 1, 0, 0, 1, 0, 0),
	array(0, 1, 0, 0, 0, 0, 1, 0, 1),
	array(0, 1, 0, 0, 0, 0, 1, 0, 0),
	array(0, 0, 0, 0, 0, 0, 1, 0, 0),
	array(1, 0, 0, 0, 0, 0, 1, 1, 0),
	array(0, 1, 1, 1, 1, 1, 0, 1, 1),
	array(0, 0, 0, 0, 0, 1, 1, 0, 2),
	array(0, 0, 1, 0, 0, 0, 1, 2, 0),
	);


if(empty($_SESSION['privilege']) && ($_SESSION['privilege'] != 3) && ($_SESSION['privilege'] != 1))
{
	echo ("gamiesai");
	echo ("<br>");
	echo ($_SESSION['privilege']);
	//$user->redirect('login.php');
} else {

	create_order(2, 0, "salamoxtuphs", "salomoroufhs");
	create_order(2, 1, "salamoxtuphs", "salomoroufhs");

}

/* graph contents are
0: iwannina 
1: thessaloniki
2: aleksandroupoli
3: larissa
4: lesvos
5: patras
6: athina
7: kalamata
8: iraklion
*/



/*source and destination is from 0-8 source and destination are different
graph , we consider graph stored as 2d adjacency matrix
in case of a tie in costs of primary graph from source to destination the tie will be resolved based on secondary graph costs of the tied paths*/

// function kindof_dijkstra($primary_graph, $secondary_graph $source, $destination) {

// 	$distance = array();
// 	$previus = array();
// 	$finalized = array();


// 	$array_length = count($graph[]);
// 	for($index = 0; $index<$array_length; $index++) {
// 		$distance[index] = 999999;
// 		$previus[index] = -1;
// 	}

// 	$distance[$source] = 0;
// 	$finalized[0] = $source;

// 	$index_2 = 0;

// 	while($finalized[$destination] == 0)) {
// 	$least_distance = 999999;

// 	for($index = 0; $index < $array_length; $index++) {
// 		if($primary_graph[$source][$index] < $least_distance && $primary_graph[$source][$index] != 0) {
// 			$least_distance = $primary_graph[$source][$index];
// 			$temp_index = $index;
// 		}






// 	}

// 	$index_2++;

// }
//}

function local_store_th_id($ls_id){
	$stmt = $db->prepare("SELECT th_id FROM  local_stores N ls_employees.ls_id = local_stores INNER JOIN transit_hubs ON transit_hubs.th_id = local_stores.th_id WHERE ls_id = :ls_id" );
	bindValue(':ls_id', $ls_id);
	$stmt->execute();
	$th_id = $stmt->fetchColumn(0);
	return $th_id;
}

function this_th_id() {

	$stmt = $this->db->prepare("SELECT th_id FROM employees INNER JOIN ls_employees ON employees.id = ls_employees.id INNER JOIN local_stores ON ls_employees.ls_id = local_stores.ls_id INNER JOIN transit_hubs ON transit_hubs.th_id = local_stores.th_id WHERE id = :user_id" );
	bindValue(':user_id', $_SESSION['user_session'] );
	$stmt->execute();
	$th_id = $stmt->fetchColumn(0);
	return $th_id;

}

function this_ls_id() {

	$stmt = $this->db->prepare("SELECT ls_id FROM employees INNER JOIN ls_employees ON employees.id = ls_employees.id INNER JOIN local_stores ON ls_employees.ls_id = local_stores.ls_id  WHERE id = :user_session");
	bindValue(':user_id', $_SESSION['user_session'] );
	$stmt->execute();
	$ls_id = $stmt->fetchColumn(0);
	return $ls_id;

}



function create_order($ls_destination, $express, $sender, $reciever) {


	$source = this_th_id();
	$destination = local_store_th_id($ls_destination);
	$this_ls_id = this_ls_id();

	if($express == 1) {

		$path = kindof_dijkstra($time_graph, $cost_graph, $source, $destination);


	} else if ($express == 0 ) {

		$path = kindof_dijkstra($cost_graph, $time_graph, $source, $destination);


	}

	$end_pointer = count($path) - 1;
	$path_cost_matrix = build_path_cost_matrix($path, $time_graph, $cost_graph);

	$unique_id = substr($path_cost_matrix[0][0], 0, 2) . time() . $substr($path_cost_matrix[$end_pointer][0], 0, 2);


	create_shipment($unique_id, $sender, $reciever, $path_cost_matrix[$end_pointer][1], $path_cost_matrix[$end_pointer][2], $this_ls_id, $ls_destination );
	create_trackhistory($unique_id, $path);



}


function create_shipment($shipment_id, $sender, $reciever, $eta, $est_cost, $express) {
	$sql_query = "INSERT INTO shipment  (tracknumber, from_cl_id, to_cl_id, from_store, to_store,  express, est_cost, eta) VALUES( :shipment_id, :sender, :reciever, :this_ls_id, :ls_destination, :express, :est_cost, :eta)";
	bindValue(':shipment_id', $shipment_id);
	bindValue(':sender', $sender);
	bindValue(':reciever', $reciever);
	bindValue(':this_ls_id', $this_ls_id);
	bindValue(':ls_destination', $ls_destination);
	bindValue(':express', $express);
	bindValue(':est_cost', $est_cost);
	bindValue(':eta', $eta);
	$stmt = $this->db->prepare($sql_query);
	$stmt->execute();
}



function order_is_delivered($order_number) {
	$update_order = "UPDATE shipment SET delivered = 1 WHERE id = :order_number";
	bindValue(':order_number', $order_number);
	$stmt = $this->db->prepare($update_order);
	$stmt->execute();
}


function track_order($tracking_number) {
	$stmt = $this->db->prepare("SELECT * FROM trackhistory where tracknumber = :tracking_number");
	bindValue(':tracking_number', $tracking_number);
	if ($stmt->execute(array($_GET['track_no']))) {
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			print_r($row);
		}
	}
}

function create_trackhistory($tracknumber, $path) {
	$query_vector = array();

	foreach($path as $index) {
		$query_vector[$index] = $this->db->prepare("INSERT INTO trackhistory (past_through, tracknumber, transitnode) VALUES (0, :tracknumber, :node )");
		$query_vector[$index]->bindValue(':tracknumber', $tracknumber);
		$query_vector[$index]->bindValue(':node', $path[$index]);

		// $query_vector[$index]->bindValue(':ETA', $path_cost_matrix[$index][1]);
		$query_vector[$index]->execute();


	}

}

function build_path_cost_matrix($path, $time_graph, $cost_graph) {
	$path_cost_matrix = array(array());
	//init costs of 0 in first node
	$path_cost_matrix[0][1] = 0;
	$path_cost_matrix[0][0] = 0;

	foreach($path as $index) {
		switch ($path[$index]) {

			case 0:
			$path_cost_matrix[$index][0] = "Ioannina";

			case 1:
			$path_cost_matrix[$index][0] = "Thessalonikh";

			case 2:
			$path_cost_matrix[$index][0] = "Aleksandroupolh";

			case 3:
			$path_cost_matrix[$index][0] = "Larissa";

			case 4:
			$path_cost_matrix[$index][0] = "Lesvos";

			case 5:
			$path_cost_matrix[$index][0] = "Patras";

			case 6:
			$path_cost_matrix[$index][0] = "Athina";

			case 7:
			$path_cost_matrix[$index][0] = "Kalamata";

			case 8:
			$path_cost_matrix[$index][0] = "Iraklion";

		}

		// $path_cost_matrix[$index][0] = $path[$index];

		if($index > 0) {
			$path_cost_matrix[$index][1] = $path_cost_matrix[$index-1][1] + $time_graph[$path[$index]][$path[$index-1]];
			$path_cost_matrix[$index][2] = $path_cost_matrix[$index-1][2] + $cost_graph[$path[$index]][$path[$index-1]];

		}
	}
	return $path_cost_matrix;

}



function kindof_dijkstra($primary_graph, $secondary_graph, $source, $destination) {
//initialize the array for storing
	$vertex_count = size($primary_graph[]);
	$pred = array();//the nearest path with its parent and weight
	$priority_q = array();//the left nodes without the nearest path
	foreach(array_keys($primary_graph) as $index) $Q[$index] = 99999;
	$priority_q[$source] = 0;

	if (!array_key_exists($destination, $pred)) {
		echo "There is no possible way in graph from source to destination!!";
		return;
	}
//start calculating
	while(!empty($priority_q)){
    	$min = array_search(min($priority_q), $priority_q);//the most min weight
    	if($min == $destination) break;
    	foreach($primary_graph[$min] as $index=>$val) if(!empty($priority_q[$index]) && $priority_q[$min] + $val < $priority_q[$key]) {

    		$priority_q[$index] = $priority_q[$min] + $val;
    		$pred[$index] = array($min, $priority_q[$index]);

    	}
    	unset($priority_q[$min]);
    }
    $primary_cost = $pred[$destination][1];
    $secondary_cost = 0;
    foreach($pred[$index] as $index) {
    	$secondary_cost = $secondary_cost + $secondary_graph[$index][$pred[$index][1]];
    }

    for ($index = 0; index<$vertex_count; $index++) {
    	if ($primary_graph[$source][$index] != 0) {
    		if (($pred[$index][0] + $primary_graph[$destination][$index]) == $pred[$destiination][0]){

    			foreach($pred[$index_2] as $index_2) {
    				$temp_secondary_cost = $temp_secondary_cost + $secondary_graph[$index_2][$pred[$index_2][1]];
    			}
    			if($temp_secondary_cost < $secondary_cost) {
    				$pred[$destination][1] = $index;
    			}

    		}
    	}
    }

//list the path
    $path = array();
    $position = $destination;
    while($position != $source){
    	$path[] = $position;
    	$position = $pred[$position][0];
    }
    $path[] = $source;
    $path = array_reverse($path);

    // echo "<br />From $source to $destination";
    // echo "<br />The length is ".$pred[$destination][1];
    // echo "<br />Path is ".implode('->', $path);

    return $path;
}
?>