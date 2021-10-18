<?php
require './db/db.php';
require './config/config.php';

GLOBAL $dbSettings; 
$conn = Db::connect($dbSettings["user"],$dbSettings["pass"],$dbSettings["db"],$dbSettings["serverName"]);
$results = null;

try{
	
	$sql = $conn->prepare("SELECT * from Tasks_Name");
	$sql->execute();
	$results = $sql->fetchall(PDO::FETCH_ASSOC);

}catch(Exception $e){
	 print_r($e->getMessage());
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lib/css/index.css">
    <link rel="stylesheet" href="./lib/css/bootstrap-datetimepicker.css">
	
    <title>Scan BarCodes</title>
  </head>
  <body>
    <script src="./lib/js/jquery-3.4.1.min.js"></script>
    <script src="./lib/js/moment.min.js"></script>
    <script src="./lib/js/bootstrap.min.js"></script>
	<script src="./lib/js/bootstrap-datetimepicker.min.js"></script>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 col-sm-4">
			</div>
			<div class="col-md-4 col-sm-4 text-center">
				<h1 id="headerTitle" >Ticket Tracker</h1>
			</div>
			<div class="col-md-4 col-sm-4">
				<img src="./lib/image/conti.png" class="img-fluid float-right" alt="Responsive image">
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<hr id="bar">
			</div>
		</div>
    </div>
	<div class="alert alert-success text-center hidden" id="alertSuccess" role="alert">
	</div>
	<div class="alert alert-danger text-center hidden" id="alertFail" role="alert">
	</div>
    <form id="mainForm">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-4">
					
				
				</div>
				</div>
				
			</div>
				
					<div class="col-md-4 col-sm-4">
						<label for="barcode">Barcode:</label>
						<input maxlength="10" name="barcode" class="form-control" placeholder="Barcode" id="barcode"></input>
					</div>
				</div>
			<div class="row text-center top-buffer">
					<div class="col-md-4 col-sm-4">
					</div>
					<div class="col-md-4 col-sm-4">
						<button type="button" class="btn btn-primary" onclick="save();" id="saveBarCode">Save</button>
					</div>
					<div class="col-md-4 col-sm-4">
					</div>
			</div>
		</div>
	</form>
	<script src="./lib/js/main.js"></script>
  </body>
</html>