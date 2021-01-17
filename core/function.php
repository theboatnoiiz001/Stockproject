<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
function getlink($id){
    global $partUpload;
    return $partUpload . $id . ".jpg";
}
function getStatus($data){
    if($data == 1){
        return " (ปิดประกาศแล้ว)";
    }else if($data == 2){
        return " (ประกาศถูกระงับ)";
    }
}
function getCategory($id,$connect){
    $check = $connect->prepare("SELECT `name` FROM `category` WHERE `id_cate` = ? AND `uid` = ?");
    $check->execute([$id,$_SESSION['uid']]);
    if($check->rowCount() != 0){
        $data = $check->fetch();
        return $data['name'];
    }else{
        return "ไม่พบหมวดหมู่";
    }
}
?>