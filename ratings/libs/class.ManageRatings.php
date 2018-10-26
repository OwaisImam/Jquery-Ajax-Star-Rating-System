<?php
	class ManageRatings{
		protected $link;
		protected $db_host = 'localhost';
		protected $db_name = 'alamdar_data';
		protected $db_user = 'root';
		protected $db_pass = '';

		function __construct(){
			try{
				$this->link = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_pass);
				return $this->link;
			}
			catch(PDOException $e)
			{
				return $e->getMessage;
			}
		}
		
		function getItems($id = 17){
			if(isset($id)){
				$query = $this->link->query("SELECT * FROM nohay WHERE ID = '$id'");
			}
			else
			{
				$query = $this->link->query("SELECT * FROM nohay");
			}
			$rowCount = $query->rowCount();
			if($rowCount >= 1)
			{
				$result = $query->fetchAll();
			}
			else
			{
				$result = 0;
			}
			return $result;
		}
		
		function insertRatings($id,$rating,$total_rating,$total_rates,$ip_address){
			$query = $this->link->query("UPDATE nohay
			SET Ratings = '$rating',
			TotalRatings = '$total_rating',
			TotalRates = '$total_rates',
			IPAddress = CONCAT(IPAddress,',$ip_address') WHERE ID = '$id'");

			$rowCount = $query->rowCount();
			return $rowCount;
		}
	}
?>