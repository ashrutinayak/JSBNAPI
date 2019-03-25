<?php

$file = fopen("php://input","r");

$jsonInput ="";

while(!feof($file))
{
	$jsonInput .= fgets($file);	
}

fclose($file);

	$input_params = json_decode($jsonInput,true);
    


    include("includes/common_class.php");
	include("includes/config.php");

    	
		$book_title=$input_params['book_title'];

		$publisher_no=$input_params['publisher_no'];
		
		$language=$input_params['language'];
		
		$subject=$input_params['subject'];
		
		$author_name=$input_params['author_name'];
	

	
	$condition = "status = 1";
	
	if(!empty($book_title))
	{
		 $condition .= " and book_title like '%".$book_title."%'";
	}
	elseif (!empty($publisher_no)) 
	{
		$condition .= " and publisher_no like '%".$publisher_no."%'";
	}
	elseif (!empty($language)) 
	{
		$condition .= " and language like '%".$language."%'";
	}
	elseif (!empty($subject)) 
	{
		$condition .= " and subject1 like '%".$subject."%' or subject2 like '%".$subject."%' or subject3 like '%".$subject."%' or other_subject like '%".$subject."%'";
	}
	elseif (!empty($author_name)) 
	{
		$condition .= " and author_name1 like '%".$author_name."%' or author_name2 like '%".$author_name."%' or author_name3 like '%".$author_name."%' or author_name4 like '%".$author_name."%' or author_name5 like '%".$author_name."%' ";
	}
	elseif(empty($book_title) && empty($publisher_no) && empty($language) && empty($subject) && empty($author_name))
	{
		$condition.=" and book_title like '%".$book_title."%'";
	}

	$JSBNDetailsQuery=$con->select_query("book_new_gyan","*","where $condition");
		if($con->total_records($JSBNDetailsQuery) != 0)
			{
				$x=0;
				$JSBNDetail=array();
				while($row = mysqli_fetch_array($JSBNDetailsQuery))
				{
					$JSBNDetail[$x]["book_new_id"]=intval($row['book_new_id']);
					// $response[$x]["CategoryName"]=$row['cat_name'];
					$JSBNDetail[$x]["publisher_no"]=$row['publisher_no'];
					$JSBNDetail[$x]["publisher_jsbn_id"]=$row['publisher_jsbn_id'];
					$JSBNDetail[$x]["book_title"]=$row['book_title'];
					$JSBNDetail[$x]["alternate_title"]=$row['alternate_title'];
					$JSBNDetail[$x]["part"]=$row['part'];
					$JSBNDetail[$x]["type"]=$row['type'];
					$JSBNDetail[$x]["other_type"]=$row['other_type'];
					$JSBNDetail[$x]["contents"]=$row['contents'];
					$JSBNDetail[$x]["author_type1"]=$row['author_type1'];
					$JSBNDetail[$x]["author_type2"]=$row['author_type2'];
					$JSBNDetail[$x]["author_type3"]=$row['author_type3'];
					$JSBNDetail[$x]["author_type4"]=$row['author_type4'];
					$JSBNDetail[$x]["author_type5"]=$row['author_type5'];
					$JSBNDetail[$x]["author_name1"]=$row['author_name1'];
					$JSBNDetail[$x]["author_name2"]=$row['author_name2'];
					$JSBNDetail[$x]["author_name3"]=$row['author_name3'];
					$JSBNDetail[$x]["author_name4"]=$row['author_name4'];
					$JSBNDetail[$x]["author_name5"]=$row['author_name5'];
					$JSBNDetail[$x]["language"]=$row['language'];
					$JSBNDetail[$x]["subject1"]=$row['subject1'];
					$JSBNDetail[$x]["subject2"]=$row['subject2'];
					$JSBNDetail[$x]["subject3"]=$row['subject3'];
					$JSBNDetail[$x]["other_subject"]=$row['other_subject'];
					$JSBNDetail[$x]["pages"]=$row['pages'];
					$JSBNDetail[$x]["publication_year"]=$row['publication_year'];
					$JSBNDetail[$x]["jsbn_number"]=$row['jsbn_number'];
					$JSBNDetail[$x]["qrcode"]=$row['qrcode'];
					$JSBNDetail[$x]["qrcode_image"]=$row['qrcode_image'];
					$JSBNDetail[$x]["status"]=$row['status'];
				 $x++;
				}
				header('Content-type: application/json');
				echo json_encode(array("Status"=>1,"JSBNDetails"=>$JSBNDetail,"Message"=>"JSBN Details Listed Successfully")); 
				}
				else
				{
					header('Content-type: application/json');
					echo json_encode(array("Status"=>0,"Message"=>"Book Not Found."));
				}
?>