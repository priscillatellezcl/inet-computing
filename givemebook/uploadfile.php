<?php
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = explode(".", $_FILES["file"]["name"]);
//$test = $_FILES["file"]["type"];
//$test2 = $_FILES["file"]["size"];
//echo "$test , $test2";
if ((($_FILES["file"]["type"] == "image/JPEG")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/JPG"))
&& ($_FILES["file"]["size"] < 2000000))
  {
	 $file_name = $_FILES['file']['name'];
	
	// random 4 digit to add to our file name 
	// some people use date and time in stead of random digit 
	$random_digit=rand(0000,9999);
	//$cove = 
	//combine random digit to you file name to create new file name
	//use dot (.) to combile these two variables
	
	$new_file_name=$random_digit.$file_name;
	$cove = $new_file_name;
	//set where you want to store files
	//in this example we keep file in folder upload 
	//$new_file_name = new upload file name
	//for example upload file name cartoon.gif . $path will be upload/cartoon.gif
	$path= "bookimg/".$new_file_name;

		if(copy($_FILES['file']['tmp_name'], $path))
		{
			echo "<div align=\"center\"><h3 class=text-info>Picture Uploaded</h3></div>"; 
		
		}
		else
		{
			echo "<div align=\"center\"><h3 class=text-info>Upload Picture Error</h3></div>";
			
		}
  }
else
  {
  	echo "<div align=\"center\"><h3 class=text-info>Upload Picture Error: Invalid file type</h3></div>";
  }


?>