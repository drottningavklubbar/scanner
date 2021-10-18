<?php
	
	require './db/db.php';
	require './config/config.php';
	//require './email/PHPMailer.php';
	//require './email/SMTP.php';
	
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
					  ,BarcodeDetails
					  ) VALUES (?,?)";
			$sql= $conn->prepare($sql);			
			$status = $sql->execute([$data->barcode,$timestamp]);
			
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
				throw new Exception("The field is empty!");
			}
			
			if(saveData($data)){
				if(composeEmail($data)){
					outputMessage("success","Save was successfully!");
				}
			}
			
		}catch(Exception $ex){
			outputMessage("error",$ex->getMessage()); 
		}
	}else{
		
	}
?>