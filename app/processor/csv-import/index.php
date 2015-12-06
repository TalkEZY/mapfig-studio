<?PHP
	require_once(dirname(__FILE__)."/../../../include/master.inc.php");
	
	$error   = "";
	$success = "";
	if(!isLogin()){
		redirect(BASEURL."app/login.php");
	}
	
	if(isset($_POST['import'])){
		
		$delimiter = (strlen($_POST['delimiter']) <= 1) ? $_POST['delimiter'] : ',';
		$enclosure = (strlen($_POST['enclosure']) <= 1) ? $_POST['enclosure'] : '"';
		$escape    = (strlen($_POST['escape']) <= 1) ? $_POST['escape'] : '\\';
		
		$file = basename($_FILES["file"]["name"]);
		$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
		
		if($_FILES["file"]["size"] == 0) {
			$error = "Something is wrong. File size is zero.";
		}
		else if ($_FILES["file"]["size"] > 50000000) {
			$error = "Sorry, your file is too large.";
		}
		else if(!in_array($_FILES['file']['type'], $mimes)) {
			$error = "Sorry, only csv file is allowed.";
		}
		else { /* Success */
			$content = file_get_contents($_FILES["file"]["tmp_name"]);
			$content = str_replace("\r\n", "\n", $content);
			$content = str_replace("\r", "\n", $content);
			
			$path_parts = pathinfo($_FILES["file"]["name"]);
			
			$rows = str_getcsv($content, "\n");
			foreach($rows as &$row) { $row = str_getcsv($row, $delimiter, $enclosure, $escape); }
	
			$_SESSION['csv']['data'] = $rows;
			redirect(BASEURL."app/csv-create.php?action=import");
		}
	}
	else {
		$error = "Invalid Request";
	}
	
	$_SESSION['response']['csv-import']['error']   = $error;
	redirect(BASEURL."app/csv-import.php");
?>