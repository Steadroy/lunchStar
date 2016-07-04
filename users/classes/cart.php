<?php

 class cart{
	private $dbConnection;
	
	function __construct(){
		// This temp fix ( not to  be  done  )
		//$this->dbConnection = new mysqli(MYSQLSERVER, MYSQLUSER, MYSQLPASSWORD, MYSQLDB);
		$this->dbConnection = new mysqli("lunchstar.db.10315035.hostedresource.com", "lunchstar", "Rexbob1234#", "lunchstar");
	}
	
	function __destruct(){
		$this->dbConnection->close();
	}
	
	public function getProducts(){
		$arr = array();
		$dbConnection = $this->dbConnection;
		$dbConnection->query( "SET NAMES 'UTF8'" );
		$statement = $dbConnection->prepare("select id, product, price from products order by product asc");
		$statement->execute();
		$statement->bind_result( $id, $product, $price);
		while ($statement->fetch()){
			$line = new stdClass;
			$line->id = $id; 
			$line->product = $product; 
			$line->price = $price;
			$arr[] = $line;
		}
		$statement->close();
		return $arr;
	}
	
	public function addToCart(){

		$thesession = new Session();
		//$thesession->put('cart',"empty");
		$id = intval($_GET["id"]);
		if($id > 0){
				if($thesession->get('cart')!= ""){ //$thesession->get('cart')!= ""
				$cart = json_decode($thesession->get('cart'), true);
				$found = false;
				for($i=0;$i<count($cart);$i++){
					if($cart[$i]["product"] == $id){
						$cart[$i]["count"] = $cart[$i]["count"]+1;
						$found = true;
						break;
					}
				}
				if(!$found){
					$line = new stdClass;
					$line->product = $id; 
					$line->count = 1;
					$cart[] = $line;
				}
				$thesession->put('cart',json_encode($cart));
			}else{
				$line = new stdClass;
				$line->product = $id; 
				$line->count = 1;
				$cart[] = $line;
				$thesession->put('cart',json_encode($cart));
			}
		}
	}
	
	public function removeFromCart(){
		$thesession = new Session();
		$id = intval($_GET["id"]);
		if($id > 0){
			if($thesession->get('cart')!= ""){
				$cart = json_decode($thesession->get('cart'), true);
				for($i=0;$i<count($cart);$i++){
					if($cart[$i]["product"] == $id){
						$cart[$i]["count"] = $cart[$i]["count"]-1;
						if($cart[$i]["count"] < 1){
							unset($cart[$i]);
						}
						break;
					}
				}
				$cart = array_values($cart);
				$thesession->put('cart',json_encode($cart));
			}
		}
	}
	
	public function emptyCart(){
		$thesession = new Session();
		//$thesession->put('cart',"");
	}
	
	public function getCart(){
		$thesession = new Session();
		$cartArray = array();
		if($thesession->get('cart') != ""){
			$cart = json_decode($thesession->get('cart'), true);
			for($i=0;$i<count($cart);$i++){
				$lines = $this->getProductData($cart[$i]["product"]);
				$line = new stdClass;
				$line->id = $cart[$i]["product"];
				$line->count = $cart[$i]["count"];
				$line->product = $lines->product;
				$line->total = ($lines->price*$cart[$i]["count"]);
				$cartArray[] = $line;
			}
		}
		return $cartArray;
	}
	
	private function getProductData($id){
		$dbConnection = $this->dbConnection;
		$dbConnection->query( "SET NAMES 'UTF8'" );
		$statement = $dbConnection->prepare("select product, price from products where id = ? limit 1");
		$statement->bind_param( 'i', $id);
		$statement->execute();
		$statement->bind_result( $product, $price);
		$statement->fetch();
		$line = new stdClass;
		$line->product = $product; 
		$line->price = $price;
		$statement->close();
		return $line;
	}

	public function uppoint(){


    $userinfo = new user;
	$newvalue = $userinfo->data()->points + 10; 
	$parnewval = intval($newvalue);
	$id = intval($_GET["id"]); 
	$newvale = 70;
	$hh = intval($newvale);
		$dbConnection = $this->dbConnection;
		//$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$statement = $dbConnection->prepare('UPDATE users SET points=:calories WHERE id=:calories1');
	//	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$statement->bind_param(':calories', $newvale );
		//$statement->bind_param(':calories1', $id);
		//$statement->execute();
		//$statement->bind_result( $id );	
		
		//$statement->close();

		$sql = "UPDATE users SET points= $parnewval WHERE id= $id";
if($statement = $dbConnection->prepare($sql)){
  // $statement->bind_param($hh, PDO::PARAM_INT);	
    //$statement->bind_param($id, PDO::PARAM_INT);
	//	$statement->bind_param(':calories1', $id);
		$statement->execute();
		$statement->close();
    //rest of code here
}else{
   //error !! don't go further
  // var_dump($this->db->error);
}

	}
 }
 ?>