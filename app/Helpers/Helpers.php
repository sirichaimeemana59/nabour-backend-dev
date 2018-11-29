<?php

function humanTiming ($time)
{
    $time = strtotime($time);
    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'messages.year',
        2592000 => 'messages.month',
        604800 => 'messages.week',
        86400 => 'messages.day',
        3600 => 'messages.hour',
        60 => 'messages.minute',
        1 => 'messages.second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.trans_choice($text,$numberOfUnits)." ".trans('messages.ago');
    }

}

function calOverdue ($due_date,$payment_date = null) {
    if($payment_date) $now = strtotime($payment_date);
    else $now = time();
    $due = strtotime($due_date);
    $day = floor( ( $now-$due ) / 86400 );
    $day .= " ".trans_choice('messages.day',$day);
    return $day;
}

function calOverdueDays ($due_date,$payment_date = null) {
    if($payment_date) $now = strtotime($payment_date);
    else $now = time();
    $due = strtotime($due_date);
    $day = floor( ( $now-$due ) / 86400 );
    return $day;
}

function calOverdueMonth ($due_date,$payment_date = null) {
    if($payment_date) $now = strtotime($payment_date);
    else $now = strtotime(date('Y-m-d'));
    $due = strtotime($due_date);
    $date_start = date('d',$now);
    $date_end   = date('d',$due);
    $month = round(($now-$due) / 60 / 60 / 24 / 30)-1;
    if($date_start > $date_end) {
        $month++;
    }
    return $month>0?$month:0;
}

function invoiceNumber($no) {
    return str_pad($no, 8, '0', STR_PAD_LEFT);
}

function payeeNumber($no) {
    return str_pad($no, 3, '0', STR_PAD_LEFT);
}

function receivedNumber($no) {
    return "RC-".str_pad($no, 4, '0', STR_PAD_LEFT);
}

function greaterThanNow ($date,$time) {
    return (strtotime($date." ".$time) > time());
}

function greaterThanNow_ ($datetime) {
    return (strtotime($datetime) > time());
}

function laterThanNow ($date,$time) {
    return (strtotime($date." ".$time) < time());
}

function laterThanNow_ ($datetime) {
    return (strtotime($datetime) < time());
}

function cropProfileImg ($name,$x,$y,$w,$h) {
        $array = explode('.', $name);
        $ext = end($array);
        $pathName = public_path().DIRECTORY_SEPARATOR.'upload_tmp'.DIRECTORY_SEPARATOR.$name;

        switch (strtolower($ext))
        {
            case 'jpeg':
            case 'jpg':
                $source = imagecreatefromjpeg($pathName);
            break;
            case 'gif':
                $source = imagecreatefromgif($pathName);
            break;
            case 'png':
                $source = imagecreatefrompng($pathName);
            break;
            default:
                die('Invalid image type');
        }

        $real_profile_img   = ImageCreateTrueColor(120,120);

        imagecopyresampled($real_profile_img, $source, 0, 0, $x, $y, 120, 120, $w, $h);
        switch (strtolower($ext))
        {
            case 'jpeg':
            case 'jpg':
               imagejpeg($real_profile_img,$pathName,100);
            break;
            case 'gif':
                imagegif($real_profile_img,$pathName);
            break;
            case 'png':
                imagepng($real_profile_img,$pathName,9);
            break;
            default:
                die('Invalid image type');
        }
        imagedestroy($real_profile_img);
        chmod($pathName, 0777);
        imagedestroy($source);
    }

function selectYearOption () {
    $c_year = date('Y');
    $year = array('' => trans_choice('messages.year',1) );
    $plus = (App::getLocale() == 'th')?543:0;
    for ($i = $c_year+1; $i >= 1900; $i--) {
        $year += array($i=>$i+$plus);
    }
    return $year;
}

function localDate($date) {
    if($date) {
        $date = str_replace('/','-',$date);
        $plus = (App::getLocale() == 'th')?543:0;
        $totime = explode('-',$date);
        $day = date('j',strtotime($date));
        return $day." ".trans('messages.dateMonth.'.$totime[1])." ". ($totime[0] + $plus);
    } else return "-";

}

function localDateShort($date) {
    $totime = explode('-',$date);
    $day = date('j',strtotime($date));
    $year = date('y',strtotime($date));
    $plus = (App::getLocale() == 'th')?43:0;
    return $day." ".trans('messages.dateMonthShort.'.$totime[1])." ". ($year+$plus);
}

function localDateShortNotime($date) {
    $totime = explode('-',$date);
    $day = date('j',strtotime($date));
    $year = date('y');
    $plus = (App::getLocale() == 'th')?43:0;
    return $day." ".trans('messages.dateMonthShort.'.$totime[1])." ". ($year+$plus);
}

function localYear ($year, $lang = null) {
    if(!$lang) $lang = App::getLocale();
    return $year += ($lang == 'th')?543:0;
}

function localFutureYearOption () {
    $c_year = date('Y') - 5;
    $next_5_year = $c_year+8;
    $year = array();
    $plus = (App::getLocale() == 'th')?543:0;
    for ($i = $c_year; $i <= $next_5_year; $i++) {
        $year += array($i=>$i+$plus);
    }
    return $year;
}

function getMonth () {
    return [
        "01" => trans('messages.dateMonth.01'),
        "02" => trans('messages.dateMonth.02'),
        "03" => trans('messages.dateMonth.03'),
        "04" => trans('messages.dateMonth.04'),
        "05" => trans('messages.dateMonth.05'),
        "06" => trans('messages.dateMonth.06'),
        "07" => trans('messages.dateMonth.07'),
        "08" => trans('messages.dateMonth.08'),
        "09" => trans('messages.dateMonth.09'),
        "10" => trans('messages.dateMonth.10'),
        "11" => trans('messages.dateMonth.11'),
        "12" => trans('messages.dateMonth.12')
    ];
}

function getMonthYearText($str) {
    $str_arr = explode('-',$str);
    $year = $str_arr[0];
    if(App::getLocale() == 'th') $year += 543;
    $month = trans('messages.dateMonth.');
    switch ($str_arr[1]) {
        case "01":
            $month = trans('messages.dateMonth.01');
            break;
        case "02":
            $month = trans('messages.dateMonth.02');
            break;
        case "03":
            $month = trans('messages.dateMonth.03');
            break;
        case "04":
            $month = trans('messages.dateMonth.04');
            break;
        case "05":
            $month = trans('messages.dateMonth.05');
            break;
        case "06":
            $month = trans('messages.dateMonth.06');
            break;
        case "07":
            $month = trans('messages.dateMonth.07');
            break;
        case "08":
            $month = trans('messages.dateMonth.08');
            break;
        case "09":
            $month = trans('messages.dateMonth.09');
            break;
        case "10":
            $month = trans('messages.dateMonth.10');
            break;
        case "11":
            $month = trans('messages.dateMonth.11');
            break;
        case "12":
            $month = trans('messages.dateMonth.12');
            break;
    }

    return $month." ".$year;
}

function isMobile () {
    $mobile_agents = '!(tablet|pad|mobile|phone|symbian|android|ipod|ios|blackberry|webos)!i';
    return preg_match($mobile_agents, $_SERVER['HTTP_USER_AGENT']);
}

function convertIntToTextThai($number){
    $number = number_format($number, 2,'.', '');
    $rare = "";
    $amount = explode(".",$number);
    $million = "";
    if(strlen($amount[0])>6){
        $million_digit = substr($amount[0],0,-6);
        $million = digitToTxtTh($million_digit)."ล้าน";
        $amount_after_string = substr($amount[0],-1,6);
        $amount_after_num = number_format($amount_after_string, 2,'.', '');
        //$amount[0] =
        $digit_m = ((int)$million_digit)*1000000;
        $total = $amount[0] - $digit_m;

        if($total <= 0)  {
            $front = ""."บาท";
        }else{
            $front = digitToTxtTh($total)."บาท";
        }
    }else{
        $front = digitToTxtTh($amount[0])."บาท";
    }

    if($amount[1] > 0) $rare = digitToTxtTh($amount[1])."สตางค์";
    return $million.$front.$rare;
}
function digitToTxtTh($number){
    $array_digit = [
        '1' => '',
        '2' => 'สิบ',
        '3' => 'ร้อย',
        '4' => 'พัน',
        '5' => 'หมื่น',
        '6' => 'แสน'
    ];

    $array_num_text = [
        '0' => 'ศูนย์',
        '1' => 'หนึ่ง',
        '2' => 'สอง',
        '3' => 'สาม',
        '4' => 'สี่',
        '5' => 'ห้า',
        '6' => 'หก',
        '7' => 'เจ็ด',
        '8' => 'แปด',
        '9' => 'เก้า',
    ];
    if($number > 0) {
        $digit_max = strlen($number);
        $arr1 = str_split($number);
        $total_str = "";
        $digit_two = 0;
        foreach ($arr1 as $key=>$item){
            $digit = $digit_max - $key;
            if($item != 0) {
                if($digit == 2){
                    $digit_two = $item;
                    if($item == 1){
                        $blah = "";
                    }elseif($item == 2){
                        $blah = "ยี่";
                    }else{
                        $blah = $array_num_text[$item];
                    }
                }elseif($digit == 1){
                    if($digit_two != "0" && $item == "1"){
                        $blah = "เอ็ด";
                    }else{
                        $blah = $array_num_text[$item];
                    }
                }else{
                    $blah = $array_num_text[$item];
                }

                $blahs = $array_digit[$digit_max - $key];
                $total_str .= $blah . $blahs;
            }
        }
    } else {
        $total_str = $array_num_text[0];
    }

    return $total_str;
}

function convertIntToTextEng($number) {

    $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
    return $f->format($number);
}

function convertUrl ($text) {
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    // Check if there is a url in the text
    if(preg_match($reg_exUrl, $text, $url)) {
           // make the urls hyper links
           return preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.getHost($url[0]).'</a>', $text);
    } else {
           // if no urls in the text just return the text
           return $text;
    }
}

function getHost ($url) {
    $url = parse_url($url);
    return $url['host'];
}

function calBalance ($balance,$grand_total) {
    if( $balance >= $grand_total ) return "0.00";
    else return number_format($grand_total-$balance,2);
}

function calBillBalance ($bill,$property_unit) {
    //calulate balance flag
    $cal_balance_flag = (!$bill->is_common_fee_bill && $property_unit->balance > 0);
    $sum_sub = 0;
    $current_balance = $property_unit->balance;
    foreach ($bill->transaction as $tr) {
        if( !$tr->payment_date ) {
            $tr->payment_date = $bill->payment_date;
        }
        //chaeck calulate balance
        if( $cal_balance_flag && $property_unit->balance > 0 ) {
            $balance 				= calTransactionBalance ($property_unit->balance,$tr->total);
            $sum_sub += $balance['sub_to_balance'];
            $tr->final_total 		= $balance['t_final_total'];
            $tr->sub_from_balance 	= $balance['sub_to_balance'];
            $property_unit->balance = $balance['calculated_balance'];
        }
        $tr->payment_status = true;
        $tr->save();
    }

    if($cal_balance_flag) {
        $bill->final_grand_total 	= $bill->grand_total-$sum_sub;
        $bill->sub_from_balance 	= $sum_sub;
        $property_unit->save();
    }
    $bill->save();
}

function calTransactionBalance ($balance,$total) {
    /*
        return array of
        t_final_total 		=> transaction final total
        sub_to_balance 		=> real substract value for balance
        calculated_balance 	=> current calculated balance
    */
    if( $balance >= $total )
        return array('t_final_total' => 0, 'sub_to_balance' => $total, 'calculated_balance' => $balance-$total);
    else {
        $sub = $total-$balance;
        return array('t_final_total' => $sub, 'sub_to_balance' => $sub, 'calculated_balance' => 0);
    }
}

function calBetweenMonth ($from,$to) {
    $date1 = strtotime($from);
    $date2 = strtotime($to);
    $months = 0;

    while (($date1 = strtotime('+1 MONTH', $date1)) <= $date2)
        $months++;

    return $months;
}

function displayTextAreaVal ($text) {
    return  nl2br(e(str_replace(' ', '&nbsp;', $text)));
}

function displayPrice ($price) {
    if(substr($price, -1) == "0") {
        $digit = 2;
    } else {
        $digit = 3;
    }
    return number_format($price, $digit);
}

/**
 *  $rateData = array['type','num_user','rate','minimum_price','minimum_unit','progressive_rate']
 * */
function calWaterElectricPriceByType($rateData, $net_unit){
    $result = 0;
    switch ($rateData['type']) {
        case 1:
            // เหมาจ่าย
            $result = $rateData['rate'];
            break;
        case 2:
            // เหมาจ่ายรายหัว
            $result = $rateData['rate'] * $rateData['num_user'];
            break;
        case 3:
            // คิดตามจริง
            $result = $rateData['rate'] * $net_unit;
            break;
        case 4:
            // คิดตามจริงมีขั้นต่ำเป็นจำนวนเงิน
            $net_price = $rateData['rate'] * $net_unit;
            if($net_price <= $rateData['minimum_price']){
                $result = $rateData['minimum_price'];
            }else{
                $result = $net_price;
            }
            break;
        case 5:
            // คิดตามจริงมีขั้นต่ำเป็นจำนวนเงิน
            if($net_unit <= $rateData['minimum_unit']){
                $result = $rateData['minimum_price'];
            }else{
                $result = $rateData['rate'] * $net_unit;
            }
            break;
        case 6:
            $result = callWaterElectricPriceByProgressiveRate($net_unit,$rateData['progressive_rate']);
            break;
        default:
            $result = $rateData['rate'];
            break;
    }

    return $result;
}

function callWaterElectricPriceByProgressiveRate($net_unit,$progressive_rate){
    $results = 0;
    $progressive_rate_arr = json_decode($progressive_rate);
    $max_rate = end($progressive_rate_arr);
    if($net_unit >= $max_rate->min){
        $results = $net_unit*$max_rate->rate;
        return $results;
    }else{
        foreach ($progressive_rate_arr as $item) {
            $net_unit_convert = floatval($net_unit);
            $checking = ($net_unit_convert > $item->min && $net_unit_convert < $item->max);
            if($checking){
                $results = $item->rate*$net_unit_convert;
                break;
            }
        }
        return $results;
    }
}

function rateWaterElectricPriceByProgressiveRate($rateData, $net_unit){
    $results = 0;
    $progressive_rate_arr = json_decode($rateData['progressive_rate']);
    $max_rate = end($progressive_rate_arr);
    if($net_unit >= $max_rate->min){
        $results = $max_rate->rate;
        return $results;
    }else{
        foreach ($progressive_rate_arr as $item) {
            $net_unit_convert = floatval($net_unit);
            $checking = ($net_unit_convert > $item->min && $net_unit_convert < $item->max);
            if($checking){
                $results = $item->rate;
                break;
            }
        }
        return $results;
    }
}

function callWaterElectricPriceByProgressiveRate2($net_unit,$progressive_rate){
    $results = 0;
    $max_rate = end($progressive_rate);
    if($net_unit >= $max_rate['min']){
        $results = $net_unit*$max_rate['rate'];
        return $results;
    }else{
        foreach ($progressive_rate as $item) {
            $range = range($item['min'],$item['max']);
            $checking = in_array($net_unit, $range);
            if($checking){
                $results = $item['rate']*$net_unit;
                break;
            }
        }
        return $results;
    }
}

function calOperatingDays ($start_date,$end_date = null) {
    if(!$end_date) $end_date = date('Y-m-d H:i:s');

    $time_from  = explode(" ",$start_date);
    $time_to    = explode(" ",$end_date);

    $now = strtotime($time_to[0]);
    $due = strtotime($time_from[0]);

    $day = floor( ( $now-$due ) / 86400 );

    $time_from  = explode(" ",$start_date);
    $time_to    = explode(" ",$end_date);
    
    $time_from  = strtotime($time_from[1]);
    $time_to    = strtotime($time_to[1]);
    if( $time_from > $time_to && $day > 0  ) $day--;

    $time = ( $time_to - $time_from ) % 86400; //mod by min in a day to get remaining secs
    $hour = floor($time / 3600); // divide to hour
    if($hour < 0) $hour += 24;

    return array($day, $hour);
}

function showDateTime ($date) {
    $time = date('H:i',strtotime($date));
    return trans('messages.date_time',['d' => localDateShort($date),'t' => $time]);
}

function customRunningId($label,$create_date=null){
    $property_id = Auth::user()->property_id;
    $property_id_aa = Auth::user();

    if ($property_id == '1518183e-8e96-463d-83f3-bd8c876df1e1'){
        $cut_str = substr($label,2);
        $custom_label = 'NBH.'.$cut_str.'V';



        if($create_date != null){
            $date=date_create($create_date);
            date_format($date,"Ym");
            $custom_label .= date_format($date,"Ym");
        }
    }else{
        $custom_label = $label;
    }

    return $custom_label;
}

function date_sort($a, $b) {
    return strtotime($a) - strtotime($b);
}