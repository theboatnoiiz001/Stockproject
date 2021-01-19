<?php
header("Content-type: application/json; charset=utf-8");
include("../core/config.php");
if(isset($_POST['graph'])){
	for($i=7;$i>0;$i--){
		$day =  strtotime(date("d-m-Y"))+(86400)-(86400)*$i;
		$dayStart = $day;
		$dayEnd = $day+86399;
		$getdata = $connect->prepare("SELECT SUM(`summoney`) as summoney , SUM(`expense`) as expense FROM `orders` WHERE `uid` = ? AND `created_at` BETWEEN ? AND ?");
		$getdata->execute([$_SESSION['uid'],$dayStart,$dayEnd]);
		$getdata = $getdata->fetch();
		$daylist[] = date("D",$day);
		$incomelist[] = $getdata['summoney'];
		$profit[] = ($getdata['summoney']-$getdata['expense']);
	}
	
	$data = [
		"daylist" => $daylist,
		"incomelist" => $incomelist,
		"profit" => $profit
	];
	echo json_encode($data,true);
	exit();
}

?>