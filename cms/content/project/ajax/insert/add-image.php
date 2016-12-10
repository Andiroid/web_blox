<?php 

	require_once($_SERVER['DOCUMENT_ROOT'] . "/inc/general.php");

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/core_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/file_functions.php');

include_once($_SERVER['DOCUMENT_ROOT'] . '/cms/lib/gfx_functions.php');

	$new_item_id = $_POST['id'];
	$p_id = $_POST['coreID'];
	$item_pos = $_POST['itemPOS'];
	$item_type = 'image';

//echo $_POST['id'];

$fileName = $_FILES['fileUPLOAD']['name'][0];
//$fileName = $_FILES['fileUPLOAD']['id'][0];
//echo $fileName;
/*
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/img/project/core/";
$target_file = $target_dir . basename($_FILES["fileUPLOAD"]["name"][0]);
//echo $target_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileUPLOAD"]["tmp_name"][0]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileUPLOAD"]["size"][0] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileUPLOAD"]["tmp_name"][0], $target_file)) {
        echo "The file ". basename( $_FILES["fileUPLOAD"]["name"][0]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


*/


//var_dump($_FILES);
//var_dump($_POST);

$fileName = $_FILES['fileUPLOAD']['name'][0];


		$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/img/project/image/origin/";
		$target_file = basename($_FILES["fileUPLOAD"]["name"][0]);

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		$date = date("_Y_m_d_h_i_s");
		$target_file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $target_file) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);
		//echo "<br>".$target_file ;
		$out = $target_file ;
		$target_file_name = $target_file;
		$target_file = $target_dir.$target_file;





		if (move_uploaded_file($_FILES["fileUPLOAD"]["tmp_name"][0], $target_file)) {

			//echo "The file ". basename( $_FILES["fileUPLOAD"]["name"]). " has been uploaded.";

			$target_filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($_FILES["fileUPLOAD"]["name"][0])) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);

			//$sql = ("UPDATE p_item SET item_file='$out' WHERE item_id=' $last_item_id'");

			$sql = "INSERT INTO item_img (img_nr, img_file)
			VALUES ('$new_item_id', '$out')";

			if ($conn->query($sql) === TRUE) {
				
				//echo "New record created successfully";

				$thumbFolders = array("100", "200", "300", "400", "500");
				$thumbSizes = array(100, 300, 600, 900, 1200);
				$input_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image/origin/';
				$output_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image';
				$input_name = $out;
				$output_name = $out;
				$x = 0;

				if (strtoupper($imageFileType) == 'SVG'){
					$file = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image/origin/'.$out;
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
						createThumb($input_path.$input_name , $output_path.'/'.$thumbFolderName.'/'.$output_name, $thumbSizes[$x-1], $quality=100);
					}					
				}
				//echo'OK';
				//echo "Error updating record: " . $conn->error;

			}
			//header('Location: '.$_SERVER['REQUEST_URI']);
			
		}





	/* 

		$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/img/project/image/origin/";
		$target_file = basename($_FILES["fileUPLOAD"]["name"]);
		echo '$target_file';
	echo $target_file;

		
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		$date = date("_Y_m_d_h_i_s");
		$target_file = preg_replace('/\\.[^.\\s]{3,4}$/', '', $target_file) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);
		//echo "<br>".$target_file ;
		$out = $target_file ;
		$target_file_name = $target_file;
		$target_file = $target_dir.$target_file;




	$item_file = $out;

	$sql = "INSERT INTO p_item (item_nr, item_type, item_file, item_pos)
	VALUES ('$p_id', '$item_type', '$item_file', '$item_pos')";











if(isset($item_pos)) {

	$sql="SELECT item_pos, item_id FROM p_item WHERE item_nr='$p_id' ORDER BY item_pos ASC";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$x = 1;
	//echo $num_rows;
	// if item pos is last simply upload
	if($item_pos > $num_rows){

	} else {


		//echo '<br>Mein neues Item is Nummer:<span style="color:red;"> ' . $item_pos . ' </span>from<span style="color:red;"> ' . $num_rows . ' </span><br><br>';
			
		$new_pos_Array = array();
		$current_pos_Array = array();
		$current_id_Array = array();

		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {

			$this_item_pos = $row['item_pos'];
			$this_item_id = $row['item_id'];
			//echo $row['item_id'];
			if ($item_pos <= $this_item_pos){

				$new_item_pos = $this_item_pos + 1;
				//echo $this_item_pos.'='.$new_item_pos.'<br>';
				$new_pos_Array[] = $new_item_pos;
				$current_pos_Array[] = $this_item_pos;
				$current_id_Array[] = $this_item_id;

			}

			$x++;

		}
	}
	
	for ($x = 0; $x <= count($new_pos_Array)-1; $x++) {
		$currentArr = $current_pos_Array[$x];
		$newArr = $new_pos_Array[$x];
		//echo $current_id_Array[$x];

				
				$sql = "UPDATE p_item SET item_pos ='$newArr' WHERE item_id ='".$current_id_Array[$x]."'";

				if ($conn->query($sql) === TRUE) {
					//echo "Record updated successfully";
					//echo $current_pos_Array[$x].'-->'.$new_pos_Array[$x].'<br>';				
				} else {
					echo "Error updating record: " . $conn->error;
				}
			
	}
}



if ($uploadOk == 0) {

	if(isset($_POST["submit"])) {
		echo "file was NOT uploaded";
	}

} else {

	if (move_uploaded_file($_FILES["fileUPLOAD"]["tmp_name"], $target_file)) {

		//echo "The file ". basename( $_FILES["fileUPLOAD"]["name"]). " has been uploaded.";

		$target_filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($_FILES["fileUPLOAD"]["name"])) . ($date) . "." .pathinfo($target_file,PATHINFO_EXTENSION);

		$sql = ("UPDATE p_item SET item_file='$out' WHERE item_id=' $last_item_id'");
		
		if ($conn->query($sql) === TRUE) {
			
			//echo "New record created successfully";



			$thumbFolders = array("100", "200", "300", "400", "500");
			$thumbSizes = array(100, 300, 600, 900, 1200);
			$input_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image/origin/';
			$output_path = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image';
			$input_name = $out;
			$output_name = $out;
			$x = 0;

			if (strtoupper($imageFileType) == 'SVG'){
				$file = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image/origin/'.$out;
				//$newfile = $_SERVER['DOCUMENT_ROOT'] .'/img/project/image/test.svg';
				foreach ($thumbFolders as $thumbFolderName) {
					$x++;
					if (!copy($file, $output_path.'/'.$thumbFolderName.'/'.$output_name)) {
						echo 'failed to copy '.$file.'..';
					}
				}
			} else {
			
				foreach ($thumbFolders as $thumbFolderName) {
					$x++;
					createThumb($input_path.$input_name , $output_path.'/'.$thumbFolderName.'/'.$output_name, $thumbSizes[$x-1], $quality=100);
				}					
			}

			//echo "Error updating record: " . $conn->error;

		}
		//header('Location: '.$_SERVER['REQUEST_URI']);
		echo 'OK';
	}

}
*/


?>