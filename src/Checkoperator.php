<?php

namespace BIT\Checkoperator;

class Checkoperator
{
	public function checkoperator($phone) {
	    $phone_number = $phone;
	    $first_number = substr($phone_number, 0, 1);
	    $start_number = substr($phone_number, 0, 3);
	    $phone_length = strlen($phone_number);
	    $operator = 0;
	    // replace with 95 with 0 if phone number starts with 09
	    if ($first_number == 0) {
	      	$phone_number = "95".substr($phone_number, 1);
	    }
    	elseif ($first_number == 9){
      		if($start_number == "959"){
        		if($phone_length == 8){ // 959 can be 9 + mpt
          			$operator = 1; //MPT
          			return $this->sendSuccessResponse($operator, "95".$phone_number);
        		}
        		elseif($phone_length == 9){ // 959 can be a pure ooredoo
          			$operator = 2; // Ooredoo
          			return $this->sendSuccessResponse($operator, $phone_number);
        		}
      		}
      		else{ // add 95 because already started with 9

        		if($this->isOoredoo("959".$phone_number)){
		          	$operator = 2; // Ooredoo
		          	return $this->sendSuccessResponse($operator, "959".$phone_number);
        		}
		        // $phone_number = "95".$phone_number;
		        // return $phone_number;
		        return $this->sendFailResponse();
      		}
    	}
    	else{
      		$phone_number = "959".$phone_number;
    	}
	    if($this->is_mpt($phone_number)){
	      	$operator = 1; // MPT
	    }elseif($this->isTelenor($phone_number)){
	      	$operator = 5; //Telenor
	    }elseif($this->isOoredoo($phone_number)){
	      	$operator = 2; // Ooredoo
	    }elseif($this->isMytel($phone_number)){
	      	$operator = 6; // Mytel
	    }elseif($this->isMec($phone_number)){
	      	$operator = 4; // MEC
	    }
	    if(in_array($operator, [0, 3, 4])){
	      	return $this->sendFailResponse();
	    }
	    return $this->sendSuccessResponse($operator, $phone_number);
  	}

  
	function is_mpt($phone){
	    $is_mpt = false;

	    $first_4 = substr($phone,0,4);
	    $first_5 = substr($phone,0,5);

	    $ph_length = strlen($phone);

	    switch ($first_4) {
	        
	        case '9592':
	            if($ph_length == 10){
	                $is_mpt = true;
	            }
	            elseif ($ph_length == 12) {
	                if($first_5 == '95925' || $first_5 == '95926'){
	                    $is_mpt = true;
	                }
	            }
	            
	            break;


	        case '9594':
	            if($ph_length == 11){
	                if($first_5 == '95941' || $first_5 == '95943'){
	                    $is_mpt = true;
	                }
	                
	            }
	            elseif ($ph_length == 12) {
	                if($first_5 == '95940' || $first_5 == '95942' || $first_5 == '95944' || $first_5 == '95945'){
	                    $is_mpt = true;
	                }
	            }
	            
	            break;

	        case '9595':
	            if($ph_length == 10){
	                $is_mpt = true;
	            }
	            
	            break;


	        case '9598':
	            if($ph_length == 12){
	                if($first_5 == '95988' || $first_5 == '95989'){
	                    $is_mpt = true;
	                }
	                
	            }
	            
	            break;

	        
	        default:
	            # code...
	            break;
	    }
	    return $is_mpt;
  	}
  	function isTelenor($phone = ""){
	    $is_telenor = false;
	    $start_number = substr($phone, 0, 4);
	    $phone_length = strlen($phone);
	    if($start_number == "9597" && $phone_length == 12){
	      $is_telenor = true;
	    }
	    return $is_telenor;
  	}
  	function isOoredoo($phone = ""){
	    $is_ooredoo = false;
	    $start_number = substr($phone, 0, 4);
	    $phone_length = strlen($phone);
	    if($start_number == "9599" && $phone_length == 12){
	      $is_ooredoo = true;
	    }
	    return $is_ooredoo;
  	}
  	function isMyTel($phone = ""){
	    $is_mytel = false;
	    $start_number = substr($phone, 0, 4);
	    $phone_length = strlen($phone);
	    if($start_number == "9596" && $phone_length == 12){
	      $is_mytel = true;
	    }
	    return $is_mytel;
  	}
  	function isMec($phone = ""){
	    $is_mec = false;
	    $start_number = substr($phone, 0, 4);
	    $phone_length = strlen($phone);
	    if($start_number == "9593"){
	      if($phone_length == 11){
	        $is_mec = true;
	      }elseif($start_number == "95934" && $phone_length == 12){
	        $is_mec = true;
	      }
	    }
	    return $is_mec;
  	}
  	private function sendSuccessResponse($operator, $phone_number){
	    return response()->json([
	      "status" => 1,
	      "message" => "Successful",
	      "operator_name" => $operator,
	      "phone_number" => $phone_number 
	    ]);
  	}
  	private function sendFailResponse(){
	    return response()->json([
	      "status" => 0,
	      "message" => "Operator Not Support"
	    ]);
  	}
}