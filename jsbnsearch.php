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
		global $condition;
		$jsbn_number=$_GET["jsbn_number"];
		$condition .="book_new_gyan.jsbn_number like '$jsbn_number%'";
		$query="SELECT * FROM book_new_gyan where $condition";
			$result=mysqli_query($connection, $query);
				if(mysqli_num_rows($result))
				{
					$x=0;
				 	$response=array();
					while($row = mysqli_fetch_array($result))
					{
						$response[$x]["book_new_id"]=intval($row['book_new_id']);
						// $response[$x]["CategoryName"]=$row['cat_name'];
						$response[$x]["publisher_no"]=$row['publisher_no'];
						$response[$x]["publisher_jsbn_id"]=$row['publisher_jsbn_id'];
						$response[$x]["book_title"]=$row['book_title'];
						$response[$x]["alternate_title"]=$row['alternate_title'];
						$response[$x]["part"]=$row['part'];
						$response[$x]["type"]=$row['type'];
						$response[$x]["other_type"]=$row['other_type'];
						$response[$x]["contents"]=$row['contents'];
						$response[$x]["author_type1"]=$row['author_type1'];
						$response[$x]["author_type2"]=$row['author_type2'];
						$response[$x]["author_type3"]=$row['author_type3'];
						$response[$x]["author_type4"]=$row['author_type4'];
						$response[$x]["author_type5"]=$row['author_type5'];
						$response[$x]["author_name1"]=$row['author_name1'];
						$response[$x]["author_name2"]=$row['author_name2'];
						$response[$x]["author_name3"]=$row['author_name3'];
						$response[$x]["author_name4"]=$row['author_name4'];
						$response[$x]["author_name5"]=$row['author_name5'];
						$response[$x]["language"]=$row['language'];
						$response[$x]["subject1"]=$row['subject1'];
						$response[$x]["subject2"]=$row['subject2'];
						$response[$x]["subject3"]=$row['subject3'];
						$response[$x]["other_subject"]=$row['other_subject'];
						$response[$x]["pages"]=$row['pages'];
						$response[$x]["publication_year"]=$row['publication_year'];
						$response[$x]["jsbn_number"]=$row['jsbn_number'];
						$response[$x]["qrcode"]=$row['qrcode'];
						$response[$x]["qrcode_image"]=$row['qrcode_image'];
						$response[$x]["status"]=$row['status'];

						 $x++;
					}	
			$res=array(
				'Status' => 1,
				'JSBNDetails'=>$response,
				'Message' =>'Book Listed Sucessfully.'
			);
	header('Content-Type: application/json');
	echo json_encode($res);
	}
	else
	{
		$res=array(
				'Status' => 0,
				'Message' =>'No Book Listed Sucessfully.'
			);
	header('Content-Type: application/json');
	echo json_encode($res);	
	}
			
				
		
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
