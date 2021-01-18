<?php
header("Content-type: application/json; charset=utf-8");
include("dataajax.php");
if(isset($_SESSION['pw_uid'])){
	$day = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));
	for($i=1;$i<=$day;$i++){
		$deposit = 0;
		$withdraw = 0;
		$dayStart = strtotime($i .'-'. date("m") .'-'. date("Y") . " 00:00");
		$dayEnd = strtotime($i .'-'. date("m") .'-'. date("Y") . " 23:59");
		$getdata = $connect->prepare("SELECT * FROM `pw_activity` WHERE `uid` = ? AND `status` = 1 AND `created` BETWEEN ? AND ? ORDER BY `id` DESC");
		$getdata->execute([$_SESSION['pw_uid'],$dayStart,$dayEnd]);
		while($row = $getdata->fetch()){
			if($row['type'] == 1){
				$deposit += $row['amount_usd'];
			}else{
				$withdraw += $row['amount_usd'];
			}								
		}
		$daylist[] = $i;
		$depositlist[] = $deposit;
		$withdrawlist[] = $withdraw;
	}
	$data = [
		"daylist" => $daylist,
		"depositlist" => $depositlist,
		"withdrawlist" => $withdrawlist
	];
	echo json_encode($data,true);
	exit();
}

?>