<?php
	$fileName = $_FILES['fileUPLOAD']['name'][0];

	$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/img/struc/origin/";

	$target_file = basename($_FILES["fileUPLOAD"]["name"][0]);

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	$date = date("_Y_m_d_h_i_s");

	$target_file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $target_file) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);

	$req_file = $target_file;

	$target_file_name = $target_file;

	$target_file = $target_dir.$target_file;

	if (move_uploaded_file($_FILES["fileUPLOAD"]["tmp_name"][0], $target_file)) {

		//echo "The file ". basename( $_FILES["fileUPLOAD"]["name"]). " has been uploaded.";

		$target_filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($_FILES["fileUPLOAD"]["name"][0])) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);

		$thumbFolders = array("100", "200", "300", "400", "500");
		$thumbSizes = array(100, 300, 600, 900, 1200);
		$input_path = $_SERVER['DOCUMENT_ROOT'] .'/img/struc/origin/';
		$output_path = $_SERVER['DOCUMENT_ROOT'] .'/img/struc';
		$input_name = $req_file;
		$output_name = $req_file;
		$x = 0;

		if (strtoupper($imageFileType) == 'SVG'){

			$file = $_SERVER['DOCUMENT_ROOT'] .'/img/struc/origin/'.$req_file;

			//$newfile = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image/test.svg';

			foreach ($thumbFolders as $thumbFolderName) {

				$x++;

				if (!copy($file, $output_path.'/'.$thumbFolderName.'/'.$output_name)) {

					//echo 'failed to copy '.$file.'..';

				}

			}

		} else {
		
			foreach ($thumbFolders as $thumbFolderName) {

				$x++;

				createSquare($input_path.$input_name , $output_path.'/'.$thumbFolderName.'/'.$output_name, $thumbSizes[$x-1], $quality=100);
			
			}					
		}
	}
?>