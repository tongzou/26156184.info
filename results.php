<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
</head>
<body>

<?php
mb_language('uni');
mb_internal_encoding('UTF-8');

$sql_host = 'mysql.26156184.info';
$sql_db = 'amen_db';
$sql_user = 'amenuser';
$sql_password = 'wbq511iaq418';

$search = $_POST['search'];
$searchNum = 0;

if (empty($search)) {
	echo 'Please enter a search term or number before you proceed.';
	exit;
}

@ $db = new mysqli($sql_host, $sql_user, $sql_password, $sql_db);

if (mysqli_connect_errno()) {
	echo 'Error: Could not connect to database. Please try again later. ';
	exit;
}

$db->query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");

if (is_numeric($search)) {
	$searchNum = (int)$search;
} else {
	$len = strlen($search);
	for ($i = 0; $i < $len; $i++) {
		$n = ord(strtolower(substr($search, $i, 1)));
		if ($n >= 97 && $n <= 122) {
			$searchNum += $n - 96;
		}
	}
	echo "The number for your phrase is ".$searchNum."<br />";
}

if ($searchNum > 0) {
	$query = "select * from data where Number = ".$searchNum;
	$result = $db->query($query);
	$num_results = $result->num_rows;
	echo '<b>Your search results are listed below:</b><br />';
	for ($i = 0; $i < $num_results; $i++) {
		$row = $result->fetch_assoc();
		echo '<b>'.$row['Data'].'</b><br />';	
	}
	$result->free();
}

$db->close();
?>
</body>
</html>
