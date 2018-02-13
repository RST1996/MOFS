<?php
	function add_ques($sub_id,$ques)
	{
		global $dbcon;
		$stmt = $dbcon->prepare("INSERT INTO `acad_form_questions` (`id`, `sub_cat_id`, `question`) VALUES ('', ?,?)");
		$stmt->bind_param("ss", $sub_cat_id, $question);
		$sub_cat_id = $sub_id;
		$question = $ques;
		if($stmt->execute())
		{
			return true;
		}
		else
		{
			//echo $stmt->error;
			return false;
		}
		$stmt->close();
	}
?>