<?php

	class Db_connect
  	{
    	var $user;
		var $pass;
		var $db;
		var $host;
		var $table;

		function Db_connect($host,$user_name,$password,$database)
	  	{
			$this->con=mysqli_connect($host, $user_name, $password,$database) or die ('cannot connect to the database because: ' . mysqli_error() );
	 	}
	 	
	 	function insert_record($table,$field)
	   	{
		  	$q="";
		  	$q1 = "";
		 	foreach($field as $i => $value)
		 	{
				$value = addslashes($value);
				$q=$q.$i.",";
			 	$q1=$q1."'".$value."',";
				//echo $q1;
				//die();
	     	}	  
			$q=substr($q,0,strlen($q)-1);
			$q1=substr($q1,0,strlen($q1)-1);
		 	$sql="insert into `$table` (".$q .") values (".$q1.")";
		 	//echo "Insert SQL==".$sql; die;

 	     	$rs=mysqli_query($this->con,$sql) or die("There is some error in insert query in table ".$table.mysqli_error());
		 	return $rs;
		}

		function select_query($table,$fields,$condition="",$limit="",$display_query="")
     	{
			$this->table=$table;

	   		$sql="select ".$fields." from ".$table." ".$condition." ".$limit;
		//echo "<br> query is ".$sql."<br>";
			if($display_query !="")
			{
				echo "<br> query is ".$sql."<br>";
			}
			//echo $sql;
			//echo $sql;
			$result=mysqli_query($this->con,$sql) or die("There is some error in select query table name is :".$table.mysqli_error($link));	   

			return $result;
     	}
		function total_records($rs)
     	{
			return mysqli_num_rows($rs);
     	}


	 
	}//end of class DB_connect



?>