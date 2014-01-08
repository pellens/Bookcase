<?php
	
	// Define a destination

	$targetFolder = "/Bookcase/uploads/"; // Relative to the root
	$thumbQuality = 80;
	$verifyToken  = md5('unique_salt' . $_POST['timestamp']);

	if (!empty($_FILES) && $_POST['token'] == $verifyToken)
	{
	
		$tempFile   = $_FILES['Filedata']['tmp_name'];
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	
		// Validate the file type
		$fileTypes = array('jpg','jpeg','gif','png','JPEG','JPG','mp4','pdf','zip','doc','xls','xlsx','docx'); // File extensions
		
		$fileParts = pathinfo($_FILES['Filedata']['name']);
		
		if (in_array($fileParts['extension'],$fileTypes))
		{
		
			$ext  = $fileParts['extension'];

			$time = time();
			
			$imageFileClean = preg_replace("/[ !#$%^&*()+=]/", "", $fileParts["filename"]);  
			$targetFile = rtrim($targetPath,'/') . '/' . $time."_".$imageFileClean.".".$fileParts['extension'];
			move_uploaded_file($tempFile,$targetFile);

			// IMAGE RESIZEN

			if($ext == "JPG" || $ext == "JPEG" || $ext == "jpg" || $ext == "jpeg")
			{
				
			}

			echo $time."_".$imageFileClean.".".$fileParts['extension'];
			
			
		} else {
			echo 'Filetype';
		}
	}
	
?>