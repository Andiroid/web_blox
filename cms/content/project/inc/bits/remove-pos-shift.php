<?php

/* ============================================================
	UPDATE OTHER ITEMS POSITIONS START
============================================================ */

	$sql="SELECT item_pos, item_id FROM p_item WHERE item_nr='$p_id' ORDER BY item_pos ASC";
	$result=mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($result);
	$x = 1;
	//echo $num_rows;
	// if item pos is last simply upload

	if($item_pos > $num_rows){

	} else {

		//echo '<br>Mein neues Item is Nummer:<span style="color:red;"> ' .$item_pos . ' </span>from<span style="color:red;"> ' . $num_rows . ' </span><br><br>';
			
		$new_pos_Array = array();
		$current_pos_Array = array();
		$current_id_Array = array();

		while ($row = mysqli_fetch_array($result, 1)) {

			$this_item_pos = $row['item_pos'];
			$this_item_id = $row['item_id'];
			//echo $row['item_id'];
			if ($item_pos <= $this_item_pos){

				$new_item_pos = $this_item_pos - 1;
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

		//echo $current_pos_Array[$x].'-->'.$newArr.'<br>';
				
		$sql = "UPDATE p_item SET item_pos ='$newArr' WHERE item_id ='".$current_id_Array[$x]."'";

		if ($conn->query($sql) === TRUE) {
			//echo "Record updated successfully";
			//echo $current_pos_Array[$x].'-->'.$new_pos_Array[$x].'<br>';				
		} else {
			echo "Error updating record: " . $conn->error;
		}

	}

/* ============================================================
	UPDATE OTHER ITEMS POSITIONS END
============================================================ */

?>