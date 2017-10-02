<?php
//////////////////////////this will be replaced by dbconfig and dont forget session variables///////////////////////////
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "mysql";
$DB_name = "the_company_db";

$dbh = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


///////////////////////////////////////////////////////////////////////////
//////////////////////////////session var!!!!!!!!!!!!!!!!!!!//////////////
$transithubid = 1;



$qrscanned = $_POST["qrc"];
$qrscanned ="'".$qrscanned."'";
$output = '{"status": '."Something failed,<br> you failboy"."<br>past value is lolo qr scanned:".$qrscanned."}";
$nieh = json_decode($output);
// echo nieh;

$stmt = $dbh->prepare("SELECT past_through FROM trackhistory where tracknumber = :qr and transitnode = :transithubid");
$stmt -> bindValue(':qr', $qrscanned,PDO::PARAM_STR);
$stmt -> bindValue(':transitnode', $transithubid,PDO::PARAM_INT);
$stmt->execute();

$past = $stmt->fetch();

if($past===1){
	// $output = ${"status": "This QR is already recorded"."<brpast value is >".$past."qr scanned:".$qrscanned};
	$output = '{"status": '."This QR is already recorded"."<brpast value is >".$past."qr scanned:".$qrscanned."}";
}elseif($past===0){
	$stmt = "UPDATE trackhistory SET past_through = 1 WHERE tracknumber = :qrcode AND transitnode = :transithubid";
	$stmt -> bindValue(':qrcode', $qrscanned);
	$stmt -> bindValue(':transitnode', $transithubid);
	$stmt = $dbh->prepare($stmt);

	if ($stmt->execute()){
		// $output = {"status": "Everything OK"."<brpast value is >".$past."qr scanned:".$qrscanned};
		$output = '{"status": '."Everything update OK, gently<br>and nicely and stuff"."<brpast value is >".$past."qr scanned:".$qrscanned."}";
	}
	
}

// Get the value passed


// Create the response



echo json_decode($output);
?>