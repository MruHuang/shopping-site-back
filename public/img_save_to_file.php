<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
    $imagePath = asset("temp/");

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	//Check write Access to Directory

	if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access'
		);
		print json_encode($response);
		return;
	}
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);			
		}
	  else
		{
			
	      $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );
 			$FTP_file = $filename;
		  move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);
		 //fopen($imagePath . $_FILES["img"]["name"], "r")or die("Unable to open file!");
		  saveImage($_FILES["img"]["name"],$filename);
		  $response = array(
			"status" => 'success',
			"url" => $imagePath.$_FILES["img"]["name"],
			"width" => $width,
			"height" => $height
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
		);
	  }
	  
	  print json_encode($response);

	public function saveImage(
        $file_name,
        $file
    ){
        $ftp = ftp_connect("163.13.127.89");
        ftp_login($ftp, "imagefile", "postimage");
        ftp_put($ftp,$file_name, $file, FTP_BINARY); 
        ftp_close($ftp); 
    }
?>
