<?php
	
	require './db/db.php';
	require './config/config.php';
		
	$receivedData = file_get_contents('php://input');
	
	function outputMessage($type,$message){
		echo json_encode(array("type"=>$type,"message"=>$message));
	}
	
	function validateData($data){
		
		$ok = false;

		if($data->barcode != null && !empty($data->barcode)){
		
			$ok = true;
		
			}

		return $ok;
	}
		
	function saveData($data){
		 
		GLOBAL $dbSettings;
		$status = false; 
		$conn = Db::connect($dbSettings["user"],$dbSettings["pass"],$dbSettings["db"],$dbSettings["serverName"]);

		try{
			
			$timestamp = date('Y-m-d H:i:s');
			 $sql = "INSERT INTO Barcode_Description (BarcodeTimestamp
					  ,Barcode
					  ) VALUES (?,?)";
			$sql= $conn->prepare($sql);			
			$status = $sql->execute([$timestamp,$data->barcode]);
			
		}catch(Exception $e){
			 outputMessage("error","Error".$e->getMessage());
		}finally{
			return $status;
		}
	}
	
	if($receivedData!=null && !empty($receivedData)){
		
		try{
			
			$data = json_decode($receivedData);
			
			if(!validateData($data)){
				throw new UnexpectedValueException("The field is empty!");
			}
			
			if(saveData($data)){
					outputMessage("success","Save was successfully!");
			}
		}catch(Exception $ex){
			outputMessage("error",$ex->getMessage()); 
		}
	}
?>