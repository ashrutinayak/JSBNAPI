<?php
$connection=mysqli_connect('204.93.216.11','shraman_gyansetu','Gyansetu#51','shraman_gyanbhandarsetu');
if(!empty($_GET["jsbn_number"]))
{
	get_products();
}
else
{
	get_product();
}
function get_products()
	{
		global $connection;
		$jsbn_number=$_GET["jsbn_number"];
		// $pro_name=$_GET['pro_name'];
		$query="SELECT * FROM book_new_gyan where jsbn_number='".$jsbn_number."'";
		// if($pro_id != 0||$pro_name!=0)
		// {
			// $query="SELECT * FROM product WHERE pro_id=".$pro_id." or pro_name=".$pro_name."";
			
		 	// $x=0;
			$result=mysqli_query($connection, $query);
		
				$x=0;
				 $response=array();
				while($row = mysqli_fetch_array($result))
				{
					$response["book_new_id"]=intval($row['book_new_id']);
					// $response[$x]["CategoryName"]=$row['cat_name'];
					$response["publisher_no"]=$row['publisher_no'];
					$response["publisher_jsbn_id"]=$row['publisher_jsbn_id'];
					$response["book_title"]=$row['book_title'];
					$response["alternate_title"]=$row['alternate_title'];
					$response["part"]=$row['part'];
					$response["type"]=$row['type'];
					$response["other_type"]=$row['other_type'];
					$response["contents"]=$row['contents'];
					$response["author_type1"]=$row['author_type1'];
					$response["author_type2"]=$row['author_type2'];
					$response["author_type3"]=$row['author_type3'];
					$response["author_type4"]=$row['author_type4'];
					$response["author_type5"]=$row['author_type5'];
					$response["author_name1"]=$row['author_name1'];
					$response["author_name2"]=$row['author_name2'];
					$response["author_name3"]=$row['author_name3'];
					$response["author_name4"]=$row['author_name4'];
					$response["author_name5"]=$row['author_name5'];
					$response["language"]=$row['language'];
					$response["subject1"]=$row['subject1'];
					$response["subject2"]=$row['subject2'];
					$response["subject3"]=$row['subject3'];
					$response["other_subject"]=$row['other_subject'];
					$response["pages"]=$row['pages'];
					$response["publication_year"]=$row['publication_year'];
					$response["jsbn_number"]=$row['jsbn_number'];
					$response["qrcode"]=$row['qrcode'];
					$response["qrcode_image"]=$row['qrcode_image'];
					$response["status"]=$row['status'];

					// $x++;
				}	
		header('Content-Type: application/json');
		echo json_encode($response);
		
}
function get_product()
{
	$response=array(
				'Status' => 0,
				'Message' =>'Wrong Calling Function.'
			);
	header('Content-Type: application/json');
	echo json_encode($response);
}
?>
