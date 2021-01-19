<?php
header('Content-Type: application/json');
include("../core/config.php");
if(isset($_GET['date1'])){
    $date1 = strtotime($_GET['date1']);
    $date2 = strtotime($_GET['date2']);
    
    $getp = $connect->prepare("SELECT DISTINCT `province` FROM `orders` WHERE `uid` = ?");
    $getp->execute([$_SESSION['uid']]);
    while($row = $getp->fetch()){
        $sum = $connect->prepare("SELECT SUM(`summoney`) as totalmoney,SUM((`summoney`-`expense`)) as totalprofit FROM `orders` WHERE `uid` = ? AND `province` = ? AND `created_at` BETWEEN ? AND ?");
        $sum->execute([$_SESSION['uid'],$row['province'],$date1,$date2+86399]);
        $sum = $sum->fetch();
        $province[] = [
            'name' => $row['province'],
            'money' => number_format($sum['totalmoney'],2),
            'profit' => number_format($sum['totalprofit'],2)
        ];
    }

    $getp = $connect->prepare("SELECT DISTINCT `sector` FROM `orders` WHERE `uid` = ?");
    $getp->execute([$_SESSION['uid']]);
    while($row = $getp->fetch()){
        $sum = $connect->prepare("SELECT SUM(`summoney`) as totalmoney,SUM((`summoney`-`expense`)) as totalprofit FROM `orders` WHERE `uid` = ? AND `sector` = ? AND `created_at` BETWEEN ? AND ?");
        $sum->execute([$_SESSION['uid'],$row['sector'],$date1,$date2+86399]);
        $sum = $sum->fetch();
        $sector[] = [
            'name' => $row['sector'],
            'money' => number_format($sum['totalmoney'],2),
            'profit' => number_format($sum['totalprofit'],2)
        ];
    }

    $getp = $connect->prepare("SELECT DISTINCT `id_prod`,`prod_name` FROM `order_detail` WHERE `uid` = ?");
    $getp->execute([$_SESSION['uid']]);
    while($row = $getp->fetch()){
        $sum = $connect->prepare("SELECT SUM(d2.purchase_price*d1.amount) as cost , SUM((d1.price*d1.amount)-d1.discount) as income, (SUM((d1.price*d1.amount)-d1.discount)-SUM(d2.purchase_price*d1.amount)) as profit FROM order_detail as d1 INNER JOIN product as d2 ON(d1.id_prod = d2.id_prod) WHERE d1.uid = ? AND d1.id_prod = ? AND d1.created_at BETWEEN ? AND ?");
        $sum->execute([$_SESSION['uid'],$row['id_prod'],$date1,$date2+86399]);
        $sum = $sum->fetch();
        $product[] = [
            'name' => $row['prod_name'],
            'money' => number_format($sum['income'],2),
            'profit' => number_format($sum['profit'],2)
        ];
    }

    $getp = $connect->prepare("SELECT DISTINCT `id_cate` FROM `category` WHERE `uid` = ?");
    $getp->execute([$_SESSION['uid']]);
    while($row = $getp->fetch()){
        $sum = $connect->prepare("SELECT SUM((d1.price*d1.amount)-d1.discount) as income,SUM(d2.purchase_price*d1.amount) as cost,d3.name as name FROM order_detail as d1 INNER JOIN product as d2 ON (d1.id_prod = d2.id_prod) INNER JOIN category as d3 ON (d2.id_cate = d3.id_cate) WHERE d1.uid = ? AND d3.id_cate = ? AND d1.created_at BETWEEN ? AND ?");
        $sum->execute([$_SESSION['uid'],$row['id_cate'],$date1,$date2+86399]);
        $sum = $sum->fetch();
        $category[] = [
            'name' => $sum['name'],
            'money' => number_format($sum['income'],2),
            'profit' => number_format(($sum['income']-$sum['cost']),2)
        ];
    }

    $checkDate = ($date2-$date1)/86400;
    if($checkDate <= 30){
		$type = true;
	}else{
		$type = false;
	}
	if($type){
		for($i=$checkDate+1;$i>0;$i--){
			$day =  strtotime($_GET['date2'])+(86400)-(86400)*$i;
			$dayStart = $day;
			$dayEnd = $day+86399;
			$getdata = $connect->prepare("SELECT SUM(`summoney`) as summoney , SUM(`expense`) as expense FROM `orders` WHERE `uid` = ? AND `created_at` BETWEEN ? AND ?");
			$getdata->execute([$_SESSION['uid'],$dayStart,$dayEnd]);
			$getdata = $getdata->fetch();
			$daylist[] = date("d-m-Y",$day);
			if(is_null($getdata['summoney'])){
                $summoney = 0;
            }else{
                $summoney = $getdata['summoney'];
            }
            if(is_null($getdata['summoney']-$getdata['expense'])){
                $profit1 = 0;
            }else{
                $profit1 = $getdata['summoney']-$getdata['expense'];
            }
			$incomelist[] = $summoney;
			$profit[] = $profit1;
		}
	}else{
		for($i=12;$i>0;$i--){
			$day = cal_days_in_month(CAL_GREGORIAN, $i, date("Y"));
			$dayStart =  strtotime("01-".$i."-" . date("Y") . " 00:00");
			$dayEnd = strtotime($day."-".$i."-" . date("Y") . " 23:59");
			$getdata = $connect->prepare("SELECT SUM(`summoney`) as summoney , SUM(`expense`) as expense FROM `orders` WHERE `uid` = ? AND `created_at` BETWEEN ? AND ?");
			$getdata->execute([$_SESSION['uid'],$dayStart,$dayEnd]);
			$getdata = $getdata->fetch();
            $daylist[] = date("M",$dayStart);

            if(is_null($getdata['summoney'])){
                $summoney = 0;
            }else{
                $summoney = $getdata['summoney'];
            }
            if(is_null($getdata['summoney']-$getdata['expense'])){
                $profit1 = 0;
            }else{
                $profit1 = $getdata['summoney']-$getdata['expense'];
            }
			$incomelist[] = $summoney;
			$profit[] = $profit1;
		}
	}
	
	$dataGraph = [
		"daylist" => $daylist,
		"incomelist" => $incomelist,
		"profit" => $profit
    ];
    
    $sectorAll = ["sector" => $sector];
    $provinceAll = ["province" => $province];
    $produceAll = ["product" => $product];
    $categoryAll = ["category" => $category];
    $graphAll = ['graph'=>$dataGraph];
    
    $data = $sectorAll + $provinceAll + $produceAll + $categoryAll+$graphAll;
    echo json_encode($data);
}
?>