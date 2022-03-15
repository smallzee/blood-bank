<?php

//<img src="http://upliftingsa.co.za/eagle.gif">
//exit();
define( 'TIMEBEFORE_NOW','Just now' );
define( 'TIMEBEFORE_MINUTE','{num} minute ago' );
define( 'TIMEBEFORE_MINUTES','{num} minutes ago' );
define( 'TIMEBEFORE_HOUR', '{num} hour ago' );
define( 'TIMEBEFORE_HOURS', '{num} hours ago' );
define( 'TIMEBEFORE_YESTERDAY', 'Yesterday' );
define( 'TIMEBEFORE_FORMAT',  '%e %b' );
define( 'TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y' );

define( 'TIMEBEFORE_DAYS',    '{num} days ago' );
define( 'TIMEBEFORE_WEEK',    '{num} week ago' );
define( 'TIMEBEFORE_WEEKS',   '{num} weeks ago' );
define( 'TIMEBEFORE_MONTH',   '{num} month ago' );
define( 'TIMEBEFORE_MONTHS',  '{num} months ago' );

date_default_timezone_set("Africa/Lagos");

function admin()
{
    if(!isset($_SESSION['blood-admin'])){
        return false;
    }else{
        return true;
    }
}

function set_flash($msg,$type)
{
    $_SESSION['flash'] = "<div class='alert alert-".$type."'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
}

function set_flash_2($msg,$type)
{
    $_SESSION['flash'] = "<div style='padding: 4px; background-color: #85CE36 ; color: #fc1231; margin: 2px auto; text-align: center'>$msg</div>";
}


function flash()
{
    if(isset($_SESSION['flash']))
    {
        echo $_SESSION['flash'];
        unset($_SESSION['flash']);
    }
}

function login_check()
{
    auto_transfer();
    global $db;
    $now = time();
    $duration = "300";
    $session = session_id();
    $time_check = $now - $duration;
    $user_id = $_SESSION['cre-user'];


    $sql = "SELECT * FROM online_users WHERE session_id = '$session'";
    $result = $db->query($sql);

    $count = $result->rowCount();

    if($count == "0"){

        $sql1 = "INSERT INTO online_users(session_id, last_seen, user_id)VALUES('$session','$now','$user_id')";
        $result1 = $db->query($sql1);
    }
    else {
        $sql2 = "UPDATE online_users SET last_seen = '$now' WHERE session_id = '$session'";
        $result2 = $db->query($sql2);
    }


    // if over 5 minute, delete session
    //$next
    $next = $now - (300);
    $sql4 = "DELETE FROM online_users WHERE last_seen < $next";
    $result4 = $db->query($sql4);

    $result->closeCursor();
    //$result2->closeCursor();
    $result4->closeCursor();


}

function m_status($status)
{
    if($status == 1){
        return "Active";
    }elseif ($status == 2) {
        return "SUSPENDED";
    }elseif ($status == 0) {
        return "Banned / Pending";
    }
}

function acc_status($status)
{
    if($status == 1){
        return "Active";
    }elseif ($status == 2) {
        return "Deleted";
    }elseif ($status == 0) {
        return "Pending";
    }
}

function ticket_status($status)
{
    if($status == 0){
        return "Active";
    }elseif ($status == 1) {
        return "Closed";
    }
}

function wallet_status($status)
{
    if($status == 0){
        return "Unconfirmed";
    }elseif ($status == 1) {
        return "Confirmed";
    }elseif ($status == 2){
        return "Cleared";
    }
}

function admin_role($n)
{
    if($n == 0)
    {
        return "Moderator";
    }
    
    elseif ($n == 1) 
    {
        return "Global Admin";
    }
        elseif ($n == 2) 
    {
        return "Support";
    }
}


function time_ago($time)
{
    $out    = ''; // what we will print out
    $now    = time(); // current time
    $diff   = $now - $time; // difference between the current and the provided dates

    if( $diff < 60 ) // it happened now
        return TIMEBEFORE_NOW;

    elseif( $diff < 3600 ) // it happened X minutes ago
        return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES );

    elseif( $diff < 3600 * 24 ) // it happened X hours ago
        return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS );

    elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
        return TIMEBEFORE_YESTERDAY;

    elseif( $diff < 3600 * 24 * 7 )
        return str_replace( '{num}', round( $diff / ( 3600 * 24 ) ), TIMEBEFORE_DAYS );

    elseif( $diff < 3600 * 24 * 7 * 4 )
        return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 ) ) ), $out == 1 ? TIMEBEFORE_WEEK : TIMEBEFORE_WEEKS );

    elseif( $diff < 3600 * 24 * 7 * 4 * 12 )
        return str_replace( '{num}', ( $out = round( $diff / ( 3600 * 24 * 7 * 4 ) ) ), $out == 1 ? TIMEBEFORE_MONTH : TIMEBEFORE_MONTHS );


    else // falling back on a usual date format as it happened later than yesterday
        return strftime( date( 'Y', $time ) == date( 'Y' ) ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time );
}

function settings($name)
{
    global $db;
    $set = $db->prepare('SELECT value FROM settings WHERE name = :name');
    $set->execute(array('name' => $name));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['value'];
    $set->closeCursor();
}

function u_name($id)
{
    global $db;
    $set = $db->prepare('SELECT name FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['name'];
    $set->closeCursor();
}


 function u_bank($id)
    {
        global $db;
        $set = $db->prepare('SELECT bank_name FROM users WHERE id = :id');
        $set->execute(array('id' => $id));
        $rs = $set->fetch(PDO::FETCH_ASSOC);
        return $rs['bank_name'];
        $set->closeCursor(); 
        }

function u_loc($id)
{
    global $db;
    $set = $db->prepare('SELECT country FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['country'];
    $set->closeCursor();
}


function us_country($id)
{
    global $db;
    $set = $db->prepare('SELECT country FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['country'];
    $set->closeCursor();
}


//user status given user id
function u_status($id)
{
    global $db;
    $set = $db->prepare('SELECT status FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['status'];
    $set->closeCursor();
}



function u_mail($id)
{
    global $db;
    $set = $db->prepare('SELECT email FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['email'];
    $set->closeCursor();
}

function u_phone($id)
{
    global $db;
    $set = $db->prepare('SELECT phone FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs['phone'];
    $set->closeCursor();
}

function order_status($n)
{
    if($n == 0)
    {
        return "UNPAID";
    }elseif ($n == 1) 
    {
        return "PAID-UNCONFIRMED";
    }elseif ($n == 2) {
        return "FULLY PAID";
    }
}



function my_curl($data)
{
    $post_str = "";

    foreach ($data as $key => $value) {
        $post_str .= $key."=".urlencode($value)."&";
    }

    $post_str = substr($post_str, 0, -1);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://cheapglobalsms.com/api_v1');
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $response = curl_exec($ch);

    curl_close($ch);
}


function send_ph_message($name1,$name2,$sum1,$phone1,$bitcoin,$exp_time,$phone2)
{
    $subject = "ALLOCATION: Credit Alertz Clubs";
    $message = "<html><body><div style='font-family:calibri; max-width:800px; padding:30px 20px;'>";

    $message .= "<br>";
    $message .= "Dear $name1, You have been allocated to pay the sum of $sum1 to $name2.<br>";
    $message .= "<br>";
    $message .= "The recipient's details are as stated below.<br>";
    $message .= "<br>";
    $message .= "Name = ".$name2;
    $message .= "<br>Phone = ".$phone1;
    $message .= "<br>BTC wallet = ".$bitcoin;
    $message .= "<br>";
    $message .= "<br>";
    $message .= "</div></body></html>";    
    $headers = "From: info@creditalertz.club\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    @mail($email, $subject, $message, $headers); //MAIL

    //SMS




}

//function to merge

function auto_merge_old($gh_id,$user_id)
{
    global $db;
    //GET GH DETAILS

    $gh = $db->prepare("SELECT * FROM gh WHERE status = :status and id = :id");
    $gh->execute(array(
        'status' => 0,
        'id' => $gh_id
    ));
    $gh_rs = $gh->fetch(PDO::FETCH_ASSOC);
    $gh->closeCursor();
    $gh_amount = $gh_rs['amount'];
    $gh_type = $gh_rs['gh_type'];

    if($gh_type == 0){
        $m_type = 0;
        $m_type2 = 1;
    }elseif ($gh_type == 1) {
        $m_type = 0;
        $m_type2 = 2;
    }elseif ($gh_type == 2) {
        $m_type = 1;
        $m_type2 = 2;
    }

    // var_dump($gh_rs);
    // exit();

    //Check for last ph

    /*$sql = $db->prepare("SELECT ph_id as id,user_id, amount,date_added,ph_type, 'ph_extra' as source FROM ph_extra WHERE status = :status2 and user_id != :user_id and (ph_type = :gh_type or ph_type = :m_type or ph_type = :m_type2) AND :now > merge_date UNION SELECT id,user_id,amount,date_added,ph_type, 'ph' as source FROM ph WHERE status = :status and user_id != :user_id  and (ph_type = :gh_type or ph_type = :m_type or ph_type = :m_type2) GROUP BY id ASC");
    $sql->execute(array(
        'status' => 0,
        'status2' => 0,
        'gh_type' => $gh_type,
        'm_type' => $m_type,
        'm_type2' => $m_type2,
        'user_id' => $user_id
        ));*/

    $sql = $db->prepare("SELECT ph_id as id,user_id, amount,date_added,ph_type, 'ph_extra' as source FROM ph_extra WHERE status = :status2 and user_id != :user_id and (ph_type = :gh_type or ph_type = :m_type or ph_type = :m_type2) AND country = :country UNION SELECT id,user_id,amount,date_added,ph_type, 'ph' as source FROM ph WHERE status = :status and user_id != :user_id  and (ph_type = :gh_type or ph_type = :m_type or ph_type = :m_type2) AND country =:country GROUP BY id ASC");
    $sql->execute(array(
        'status' => 0,
        'status2' => 0,
        'gh_type' => $gh_type,
        'm_type' => $m_type,
        'm_type2' => $m_type2,
        'user_id' => $user_id,
        'country' => $gh_rs['country']
    ));

    //var_dump($sql->rowCount());
    //exit();

    $gh_rem = $gh_amount;
    $c_amount = 0;
    $excess = 0;
    while($rs = $sql->fetch(PDO::FETCH_ASSOC))
    {
        //var_dump($rs);
        //exit();
        if($c_amount == $gh_amount){
            //break loop
            //var_dump($excess);
            break;
        }

        $extra_amount = $rs['amount'];
        if($extra_amount >= $gh_rem){
            $amount = $gh_rem;
            $excess = $extra_amount - $amount;
        }else{
            $excess = 0;
            $amount = $extra_amount;
        }

        $source = $rs['source'];
        $p_id = $rs['id'];
        $update = $db->query("UPDATE $source SET status = 1 WHERE ph_id = '$p_id'");
        /*var_dump($update->rowCount());
        var_dump($source);
        var_dump($p_id);*/

        if($excess > 0){
            //save into ph_extra

            $save_extra = $db->prepare("INSERT INTO ph_extra(user_id,amount,date_added,status,ph_id,ph_type) VALUES(:user_id,:amount,:date_added,:status,:ph_id,:ph_type)");
            $save_extra->execute(array(
                'user_id' => $rs['user_id'],
                'amount' => $excess,
                'date_added' => time(),
                'status' => 0,
                'ph_id' => $rs['id'],
                'ph_type' => $rs['ph_type']
            ));
            $save_extra->closeCursor();
        }

        $c_amount += $amount;
        $object = array();
        $object['gh_id'] = $gh_id;
        $object['ph_id'] = $rs['id'];
        $object['user1'] = $user_id;
        $object['user2'] = $rs['user_id'];
        $object['amount'] = $amount;
        $object['t_type'] = $gh_type."_".$rs['ph_type'];
        $object['date_added'] = time();
        $object['status'] = 0;
        $date_exp = date("l");
        switch ($date_exp) {
            case 'Friday':
            case 'Saturday':
            case 'Sunday':
                $object['expired'] = time() + (60*60*settings('expire'));
                $exp_time = settings('expire');
                # code...
                break;

            default:
                $object['expired'] = time() + (60*60*settings('expire'));
                $exp_time = settings('expire');
                # code...
                break;
        }


        $insert = $db->prepare('INSERT INTO orders(gh_id,ph_id,user1,user2,amount,date_added,status,expired,t_type) VALUES(:gh_id,:ph_id,:user1,:user2,:amount,:date_added,:status,:expired,:t_type)');

        $insert->execute($object);
        $order_no = $db->lastInsertId();

        $order_id = "S".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".$order_no;

        $insert->closeCursor();

        $insert2 = $db->prepare('UPDATE orders SET order_id = :order_id WHERE id = :id');
        $insert2->execute(array(
            'order_id' => $order_id,
            'id' => $order_no
        ));
        $insert2->closeCursor();


        $name1 = u_name($rs['user_id']); //ph
        $name2 = u_name($gh_rs['user_id']); //gh
        $phone1 = u_phone($gh_rs['user_id']); //gh

        $phone2 = u_phone($rs['user_id']); //ph

        $email = u_mail($rs['user_id']); //ph
        $email1 = u_mail($gh_rs['user_id']); //gh
        $sum1 = $amount;

        //GET ACCOUNT
        $sql_1 = $db->prepare('SELECT * FROM users WHERE id = :id');
        $sql_1->execute(array('id' => $gh_rs['account_id']));
        $sql_12 = $sql_1->fetch(PDO::FETCH_ASSOC);
        $sql_1->closeCursor();

        $acc_name = $sql_12['account_name'];
        $acc_no = $sql_12['account_no'];
        $bank_name = $sql_12['bank_name'];
        $acc_type = "";


        send_ph_message($name1,$name2,$sum1,$phone1,$acc_name,$acc_no,$acc_type,$bank_name,$exp_time,$phone2);


        /*$update = $db->prepare('UPDATE ph SET status = :status WHERE ph_id = :id');
        $update->execute(
              array(
                'status' => 1,
                'id' => $rs['id']
                )
            );
          $update->closeCursor();

        $update_ex = $db->prepare('UPDATE ph_extra SET status = :status WHERE ph_id = :id');
        $update_ex->execute(
              array(
                'status' => 1,
                'id' => $rs['id']
                )
            );
          $update_ex->closeCursor();*/

        /*$update = $db->prepare('UPDATE '.$source.' SET status = :status WHERE ph_id = :id');
        $update->execute(
                array(
                  'status' => 1,
                  'id' => $rs['id']
                  )
              );
        $update->closeCursor();*/



        //var_dump("Amount = ".$amount);

        $gh_rem = $gh_amount - $c_amount;

        //var_dump("GH Rem = ".$gh_rem);

        //var_dump($rs);
    }

    //update gh

    $gh_update = $db->prepare("UPDATE gh set status = :status WHERE id = :id");
    $gh_update->execute(array(
        'status' => 1,
        'id' => $gh_id
    ));
    $gh_update->closeCursor();

    //check if gh_amount is less than cummulative

    //var_dump($gh_amount." ". $c_amount);
    //exit;

    if($gh_amount > $c_amount){
        //give user fund
        $balance = $gh_amount - $c_amount;
        $in_wallet = $db->prepare('INSERT INTO wallet(wallet_id,user_id,wallet_type,date_added,amount1,amount2,amount3,released_date,status,status2) VALUES(:wallet_id,:user_id,:wallet_type,:date_added,:amount1,:amount2,:amount3,:released_date,:status,:status2)');

        $wallet_type = "MONEY BACK";
        $w_id = "R".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".$gh_id;

        //$amt_rem = $rs['amount'];
        $released_date = time();
        $in_wallet->execute(array(
            'wallet_id' => $w_id,
            'user_id' => $user_id,
            'wallet_type' => $wallet_type,
            'date_added' => time(),
            'amount1' => $balance,
            'amount2' => $balance,
            'amount3' => $balance,
            'released_date' => $released_date,
            'status' => 1,
            'status2' => 2
        ));
        $in_wallet->closeCursor();
    }

    $gh->closeCursor();
    $sql->closeCursor();
}

function site_url()
{
    $base = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/wealth_society";
    return $base;
}

function t_type($n)
    {
    if($n == 0)
    {
        return "Kenya Shilling";
    }
    
    /*elseif ($n == 1) 
    {
        return "Local & BTC";
    }*/
    
    elseif ($n == 2) 
    {
        return "Bitcoin";
    }
    
        elseif ($n == 7) 
    {
        return "KEEPER";
    }
}

function amount_format($amt){
    //$usd = $amt; // settings("e_rates") * $amt;
    $usd = settings("e_rates") * $amt;
    //@$btc = file_get_contents("https://blockchain.info/tobtc?currency=USD&value=".$usd);
    $url = "https://blockchain.info/tobtc?currency=USD&value=".$usd;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $btc = number_format(curl_exec($ch),5); // ADDED FIVE DECIMAL ROUNDING FOR BTC
    curl_close($ch);

    //$btc = curl_exec($ch);

    //curl_close($ch);
    //var_dump($ch);
    //exit();
    return "&#8358; ".number_format($amt); //." (US$ ".number_format($usd).") (".$btc." BTC)";
}

function url_get_contents ($Url) {
    if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}


function send_to_telegram($message){

    $apiToken = "917986658:AAH-p_38wXXggzUXOn-hKuv0ROBJk0-I8EI";

    $data = [
        'chat_id' => '-1001376887983',
        'text' => $message
    ];

    $response = url_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );


    return $response;
}

function send_photo_to_telegram($message,$image){

    $apiToken = "917986658:AAH-p_38wXXggzUXOn-hKuv0ROBJk0-I8EI";

    $data = [
        'photo' => $image,
        'chat_id' => '-1001376887983',
        'caption' => $message
    ];

    /*$response = url_get_contents("https://api.telegram.org/bot$apiToken/sendPhoto?" . http_build_query($data) );


    return $response;*/
}

function alert($msg,$type,$close = false)
{
    if($close == false){
        $msg = "<div class='alert alert-".$type."'>".$msg."</div>";
    }else{
        $msg = "<div class='alert alert-".$type."'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$msg."</div>";
    }

    echo $msg;
}

function dollar_amt($amt){
    $usd = settings("e_rates") * $amt;
    return "";
    //return number_format($usd);
}

function btc_amt($amt){
    $usd = settings("e_rates") * $amt;
    $btc = file_get_contents("https://blockchain.info/tobtc?currency=USD&value=".$usd);
    return $btc;
}

function payment_status($n){
    if($n == 0){
        return "POP not uploaded";
    }elseif ($n == 1){
        return "POP Uploaded, waiting for confirmation";
    }elseif ($n == 2){
        return "Payment confirmed";
    }
}

function user_details($id,$field)
{
    global $db;
    $set = $db->prepare('SELECT * FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    return $rs[$field];
    $set->closeCursor();
}

function log_user($field)
{
    global $db;
    $id = $_SESSION['cre-user'];
    $set = $db->prepare('SELECT * FROM users WHERE id = :id');
    $set->execute(array('id' => $id));
    $rs = $set->fetch(PDO::FETCH_ASSOC);
    $set->closeCursor();
    return $rs[$field];

}

function order_type($t){
    $ts = explode("_", $t);
    return "GH => ".t_type($ts[0]).", PH => ".t_type($ts[1]);
}

function new_notification($user,$title,$url){
    global $db;

    $sql = $db->prepare("INSERT INTO notifications(user_id,title,url,date_added) VALUES (:user_id,:title,:url,:date_added)");
    $sql->execute(array(
        'user_id' => $user,
        'title' => $title,
        'url' => $url,
        'date_added' => time()
    ));
}

function msg_status($s){
    if($s == 0){
        return "unread";
    }else{
        return "read";
    }
}


function send_email($subject,$to,$message,$cc = FALSE)
{
    //require_once "lib/PHPMailer/PHPMailerAutoload.php";
    $email_tmp = url_get_contents("email.html");
    $message2 = str_replace("{{TITLE}}", $subject, $email_tmp);

    $message = str_replace("{{TEXT}}", $message, $message2);

    //str_replace(search, replace, subject)

    $full_name = "Credit Alertz Club";
    $email_from = "no-reply@creditalertz.club";

    $from = "$full_name <$email_from>";
    $headers = 'From:'.$full_name.'<'.$email_from.'>'."\r\n";
    if($cc != FALSE)
    {
        $headers .= 'BCC: '. implode(",", $cc) . "\r\n";
    }
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    //$headers .= "Return-Path: no-reply@creditalertz.club";

    @mail($to, $subject, $message, $headers);
    


}

function auto_merge($gh_id,$user_id){
    global $db;

    $gh = $db->query("SELECT * FROM gh WHERE status = '0' and id = '$gh_id'");
    $gh_rs = $gh->fetch(PDO::FETCH_ASSOC);
    $gh->closeCursor();
    $gh_amount = $gh_rs['amount'];
    $gh_type = $gh_rs['gh_type'];

    if($gh_type == 0){ //local currency
        $m_type = 0;
        $m_type2 = 1;
    }elseif ($gh_type == 1) { //local & btc
        $m_type = 0;
        $m_type2 = 2;
    }elseif ($gh_type == 2) { //btc only
        $m_type = 1;
        $m_type2 = 2;
    }


    $country = $gh_rs['country'];
    $ph_extra_query = "SELECT ph_id as id,user_id, amount,date_added,ph_type, 'ph_extra' as source FROM ph_extra WHERE status = '0' and user_id != '$user_id'";

    $ph_query = "SELECT id,user_id,amount,date_added,ph_type, 'ph' as source FROM ph WHERE status = '0' and user_id != '$user_id'";
    /*if($gh_type == 0) { //check country
         $ph_extra_query .= " AND country = '$country'";

         $ph_query .= " AND country = '$country'";
    }*/

    $sql = $db->query("$ph_extra_query UNION $ph_query GROUP BY id ASC");

    $gh_rem = $gh_amount;
    $c_amount = 0;
    $excess = 0;
    while($rs = $sql->fetch(PDO::FETCH_ASSOC))
    {
        //var_dump($rs);
        //exit();
        if($c_amount == $gh_amount){
            //break loop
            //var_dump($excess);
            break;
        }

        $extra_amount = $rs['amount'];
        if($extra_amount >= $gh_rem){
            $amount = $gh_rem;
            $excess = $extra_amount - $amount;
        }else{
            $excess = 0;
            $amount = $extra_amount;
        }

        $source = $rs['source'];
        $p_id = $rs['id'];
        $update = $db->query("UPDATE $source SET status = 1 WHERE ph_id = '$p_id'");
        /*var_dump($update->rowCount());
        var_dump($source);
        var_dump($p_id);*/

        if($excess > 0){
            //save into ph_extra

            $save_extra = $db->prepare("INSERT INTO ph_extra(user_id,amount,date_added,status,ph_id,ph_type) VALUES(:user_id,:amount,:date_added,:status,:ph_id,:ph_type)");
            $save_extra->execute(array(
                'user_id' => $rs['user_id'],
                'amount' => $excess,
                'date_added' => time(),
                'status' => 0,
                'ph_id' => $rs['id'],
                'ph_type' => $rs['ph_type']
            ));
            $save_extra->closeCursor();
        }

        $c_amount += $amount;
        $object = array();
        $object['gh_id'] = $gh_id;
        $object['ph_id'] = $rs['id'];
        $object['user1'] = $user_id;
        $object['user2'] = $rs['user_id'];
        $object['amount'] = $amount;
        $object['t_type'] = $gh_type."_".$rs['ph_type'];
        $object['date_added'] = time();
        $object['status'] = 0;
        $date_exp = date("l");
        switch ($date_exp) {
            case 'Friday':
            case 'Saturday':
            case 'Sunday':
                $object['expired'] = time() + (60*60*settings('expire'));
                $exp_time = settings('expire');
                # code...
                break;

            default:
                $object['expired'] = time() + (60*60*settings('expire'));
                $exp_time = settings('expire');
                # code...
                break;
        }


        $insert = $db->prepare('INSERT INTO orders(gh_id,ph_id,user1,user2,amount,date_added,status,expired,t_type) VALUES(:gh_id,:ph_id,:user1,:user2,:amount,:date_added,:status,:expired,:t_type)');

        $insert->execute($object);
        $order_no = $db->lastInsertId();

        $order_id = "S".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".$order_no;

        $insert->closeCursor();

        $insert2 = $db->prepare('UPDATE orders SET order_id = :order_id WHERE id = :id');
        $insert2->execute(array(
            'order_id' => $order_id,
            'id' => $order_no
        ));
        $insert2->closeCursor();


        $name1 = u_name($rs['user_id']); //ph
        $name2 = u_name($gh_rs['user_id']); //gh
        $phone1 = u_phone($gh_rs['user_id']); //gh

        $phone2 = u_phone($rs['user_id']); //ph

        $email = u_mail($rs['user_id']); //ph
        $email1 = u_mail($gh_rs['user_id']); //gh
        $sum1 = $amount;

        //GET ACCOUNT
        $sql_1 = $db->prepare('SELECT * FROM users WHERE id = :id');
        $sql_1->execute(array('id' => $gh_rs['account_id']));
        $sql_12 = $sql_1->fetch(PDO::FETCH_ASSOC);
        $sql_1->closeCursor();

        $acc_name = $sql_12['account_name'];
        $acc_no = $sql_12['account_no'];
        $bank_name = $sql_12['bank_name'];
        $bitcoin = $sql_12['bitcoin'];
        $acc_type = "";


        //send_ph_message($name1,$name2,$sum1,$phone1,$acc_name,$acc_no,$acc_type,$bank_name,$exp_time,$phone2);
        send_ph_message($name1,$name2,$sum1,$phone1,$bitcoin,$exp_time,$phone2);


        /*$update = $db->prepare('UPDATE ph SET status = :status WHERE ph_id = :id');
        $update->execute(
              array(
                'status' => 1,
                'id' => $rs['id']
                )
            );
          $update->closeCursor();

        $update_ex = $db->prepare('UPDATE ph_extra SET status = :status WHERE ph_id = :id');
        $update_ex->execute(
              array(
                'status' => 1,
                'id' => $rs['id']
                )
            );
          $update_ex->closeCursor();*/

        /*$update = $db->prepare('UPDATE '.$source.' SET status = :status WHERE ph_id = :id');
        $update->execute(
                array(
                  'status' => 1,
                  'id' => $rs['id']
                  )
              );
        $update->closeCursor();*/



        //var_dump("Amount = ".$amount);

        $gh_rem = $gh_amount - $c_amount;

        //var_dump("GH Rem = ".$gh_rem);

        //var_dump($rs);
    }

    //update gh

    $gh_update = $db->prepare("UPDATE gh set status = :status WHERE id = :id");
    $gh_update->execute(array(
        'status' => 1,
        'id' => $gh_id
    ));
    $gh_update->closeCursor();

    //check if gh_amount is less than cummulative

    //var_dump($gh_amount." ". $c_amount);
    //exit;

    if($gh_amount > $c_amount){
        //give user fund
        $balance = $gh_amount - $c_amount;
        $in_wallet = $db->prepare('INSERT INTO wallet(wallet_id,user_id,wallet_type,date_added,amount1,amount2,amount3,released_date,status,status2) VALUES(:wallet_id,:user_id,:wallet_type,:date_added,:amount1,:amount2,:amount3,:released_date,:status,:status2)');

        $wallet_type = "RETURNED";
        $w_id = "R".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".rand(0,9)."".$gh_id;

        //$amt_rem = $rs['amount'];
        $released_date = time();
        $in_wallet->execute(array(
            'wallet_id' => $w_id,
            'user_id' => $user_id,
            'wallet_type' => $wallet_type,
            'date_added' => time(),
            'amount1' => $balance,
            'amount2' => $balance,
            'amount3' => $balance,
            'released_date' => $released_date,
            'status' => 1,
            'status2' => 2
        ));
        $in_wallet->closeCursor();
    }

    $gh->closeCursor();
    $sql->closeCursor();


}


function ph_info($ph_id,$f){
    global $db;

    $sql = $db->query("SELECT * FROM ph WHERE id = '$ph_id'");
    $rs = $sql->fetch(PDO::FETCH_ASSOC);

    $sql->closeCursor();

    return $rs[$f];
}


function package($n){
    global $db;

    $sql = $db->query("SELECT * FROM package WHERE id = '$n'");
    return $sql->fetch(PDO::FETCH_ASSOC);
}


function transact($user_id,$amount,$descr,$type = 'debit', $currency = 'NGN'){
    global $db;

    if($type == 'credit') {
        if($currency == "NGN"){
            $up = $db->query("UPDATE users SET balance = balance + $amount WHERE id = '$user_id'");
        }else{
            $up = $db->query("UPDATE users SET balance_btc = balance_btc + $amount WHERE id = '$user_id'");
        }
    }else{
        if($currency == "NGN") {
            $up = $db->query("UPDATE users SET balance = balance - $amount WHERE id = '$user_id'");
        }else{
            $up = $db->query("UPDATE users SET balance_btc = balance_btc - $amount WHERE id = '$user_id'");
        }
    }

    //create credit transactions
    $ins = $db->prepare("INSERT INTO transactions(user_id, amount, t_type, date_added, descr, currency) VALUES (:ui, :a, :tt, :da, :de, :cr)");

    $ins->execute(array(
        'ui' => $user_id,
        'a' => $amount,
        'tt' => $type,
        'da' => time(),
        'de' => $descr,
        'cr' => $currency
    ));
}

function transact_fund($user_id,$amount,$descr,$type = 'debit', $currency = 'NGN'){

    global $db;



    //create credit transactions user_id, amount, descr, date_added
    $ins = $db->prepare("INSERT INTO funds(user_id, amount, date_added, descr,currency) VALUES (:ui, :a, :da, :de, :cr)");

    $ins->execute(array(
        'ui' => $user_id,
        'a' => $amount,
        'da' => time(),
        'de' => $descr,
        'cr' => $currency
    ));
}


function active_lotto(){
    global $db;

    $active_lotto = $db->query("SELECT id,lotto_id,date_started,stake,users,winners,win,status2 FROM lotto WHERE status = '0'");

    if($active_lotto->rowCount() == 0){
        create_lotto();
        return active_lotto();
    }else{
        return $active_lotto->fetch(PDO::FETCH_ASSOC);
    }
}


function create_lotto(){
    global $db;

    $users = rand(settings("min_lotto_users"),settings("max_lotto_users"));
    $l_wins = settings("lotto_winners");
    $l_wins_arr = explode(",",$l_wins);


    $winners = rand($l_wins_arr[0],end($l_wins_arr));

    $stakes_array = explode(",",settings("lotto_stake"));

    $stake_win = array_rand($stakes_array,1);

    $stake_entry = $stakes_array[$stake_win];

    $perc = settings("lotto_win_percent") / 100;
    $win = ($perc * $stake_entry * $users) / $winners;


    $ds = time();

    $new_lotto = $db->query("INSERT INTO lotto(date_started, stake, users, winners, win) VALUES('$ds','$stake_entry','$users','$winners','$win')");
    $in_id = $db->lastInsertId();
    $lotto_id = "L".rand(0,9).rand(0,9).rand(0,9).rand(0,9).$in_id;

    $up = $db->query("UPDATE lotto SET lotto_id = '$lotto_id' WHERE id = '$in_id'");

    $up->closeCursor();
    $new_lotto->closeCursor();

}




function enter_lotto($user_id,$lotto_id,$stake,$max_users){
    global $db;
    $total = get_lotto_entries($lotto_id);
    if($total < $max_users) {
        $my_id = $user_id;
        $insert = $db->query("INSERT INTO lotto_entry(lotto_id,user_id,amount) VALUES('$lotto_id','$my_id','$stake')");
        transact("$my_id", "$stake", "Lotto entry for $lotto_id");
        $insert->closeCursor();
        return true;
    }else{
        return false;
    }
}


function get_lotto_entries($lotto_id){
    global $db;
    $sql = $db->query("SELECT NULL FROM lotto_entry WHERE lotto_id = '$lotto_id'");
    return $sql->rowCount();
}

function get_lotto_users($lotto_id,$user_id){
    global $db;
    $sql = $db->query("SELECT lotto_entry.user_id,users.username FROM lotto_entry INNER JOIN users ON lotto_entry.user_id = users.id WHERE lotto_entry.lotto_id = '$lotto_id'");

    $ul = '<ul class="list-inline">';
    while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
        if($user_id == $rs['user_id']){
            $color = '#f00';
        }else{
            $color = '#333';
        }
        $ul .= "<li class='list-inline-item' style='color:$color'><i class='fa fa-user-circle'></i> ".$rs['username']."</li>";
    }
    $ul .= "<ul>";

    return $ul;


}


function close_lotto($lotto_id){
    global $db;
    $de = time() + (30);
    $sql= $db->query("UPDATE lotto SET status2 = '1', date_ending = '$de' WHERE lotto_id = '$lotto_id'");
    $sql->closeCursor();
}


function get_winners($lotto_id,$winners,$win_amt){
    global $db;

    $lotto_winners = $db->query("SELECT user_id FROM lotto_entry WHERE lotto_id ='$lotto_id' ORDER BY RAND() LIMIT $winners");

    $wins = array();
    while($lotto_winners_rs = $lotto_winners->fetch(PDO::FETCH_ASSOC)){
        //$win_amt = $lotto_rs['win'];
        $winner_id = $lotto_winners_rs['user_id'];
        $descr = "Win from Lotto $lotto_id";
        transact_fund("$winner_id","$win_amt","$descr");
        $url = "https://creditalertz.club/users/lottos.php";
        new_notification("$winner_id","Congrats, You just won $win_amt in lotto $lotto_id","$url");
        $wins[] = $winner_id;
    }

    $win1 = $wins[0];


    if(count($wins) == 1){
        $win2 = 0;
    }else {
        $win2 = $wins[1];
    }
    $up_lotto = $db->query("UPDATE lotto SET status = '1', win1 = '$win1', win2 = '$win2' WHERE lotto_id = '$lotto_id'");

    $up_lotto->closeCursor();
}



function nextWorkingDays($start,$days = 5){

    $startdate = date("Y-m-d",$start);
    $d = new DateTime($startdate);
    $numberofdays = $days;
    $t = $start;




// loop for X days
    for($i=0; $i<$numberofdays; $i++){

        // add 1 day to timestamp
        $addDay = 86400;

        // get what day it is next day
        $nextDay = date('w', ($t+$addDay));


        // if it's Saturday or Sunday get $i-1
        if($nextDay == 0 || $nextDay == 6) {
            $i--;
        }

        // modify timestamp, add 1 day
        $t = $t+$addDay;

        $d->setTimestamp($t);
    }


    return $d->format('U');
}


function paginate ($base_url, $query_str, $total_pages, $current_page, $paginate_limit)
{
    // Array to store page link list
    $page_array = array ();
    // Show dots flag - where to show dots?
    $dotshow = true;
    // walk through the list of pages
    for ( $i = 1; $i <= $total_pages; $i ++ )
    {
        // If first or last page or the page number falls
        // within the pagination limit
        // generate the links for these pages
        if ($i == 1 || $i == $total_pages ||
            ($i >= $current_page - $paginate_limit &&
                $i <= $current_page + $paginate_limit) )
        {
            // reset the show dots flag
            $dotshow = true;
            // If it's the current page, leave out the link
            // otherwise set a URL field also
            if ($i != $current_page)
                $page_array[$i]['url'] = $base_url . "" . $query_str .
                    "" . $i;
            $page_array[$i]['text'] = strval ($i);
        }
        // If ellipses dots are to be displayed
        // (page navigation skipped)
        else if ($dotshow == true)
        {
            // set it to false, so that more than one
            // set of ellipses is not displayed
            $dotshow = false;
            $page_array[$i]['text'] = "...";
        }
    }
    // return the navigation array
    return $page_array;
}


function total_online(){
    global $db;
    $online_sql = $db->query("SELECT NULL FROM online_users");
    $online_sql_counts = $online_sql->rowCount();
    $online_sql->closeCursor();
    return $online_sql_counts;
}


function task_status($n){
    if($n == 0){
        return "Pending";
    }elseif ($n == 1){
        return "Approved";
    }elseif ($n == 2){
        return "Rejected";
    }
}



function auto_transfer(){

    auto_transfers();
    return;
    global $db;
    global $config;


    $check_ph = $db->query("SELECT * FROM ph WHERE  status ='0'");

    if($check_ph->rowCount() == 0){
        return 0;
    }

    while($check_rs = $check_ph->fetch(PDO::FETCH_ASSOC)) {

        $user = $check_rs['user_id'];
        $ph_id = $check_rs['id'];

//var_dump($check_rs);

        $currency = $check_rs['currency'];

//check timeline

        $now = time();

        $available_check = $db->query("SELECT NULL FROM ph_timeline WHERE ph_id = '$ph_id' AND withdraw_date <= '$now' AND status = '1'");

        $available = $db->query("SELECT SUM(amount) as total FROM ph_timeline WHERE ph_id = '$ph_id' AND withdraw_date <= '$now' AND status = '1'");

        //var_dump($available_check->rowCount());

        //var_dump($available->fetch(PDO::FETCH_ASSOC));

        //exit();

        if($available_check->rowCount() == 0){
            return;
        }

        $available_rs = $available->fetch(PDO::FETCH_ASSOC);

        $amount = $available_rs['total'];


        $url = $config['site_url'] . "/users/funds.php";
        new_notification("$user", "Investment funds available for withdrawal", "$url");
//send fund to funds
        $descr = "Investment auto withdrawal";
        transact_fund("$user", "$amount", "$descr", "credit", "$currency");

//update the ph_timeline to 2

        $available = $db->query("UPDATE ph_timeline SET status = '2' WHERE ph_id = '$ph_id' AND withdraw_date <= '$now' AND status = '1'");
    }

}



function auto_transfers(){

    global $db;
    global $config;


    $check_ph = $db->query("SELECT * FROM ph WHERE  status ='0'");



    if($check_ph->rowCount() == 0){
        return 0;
    }

    while($check_rs = $check_ph->fetch(PDO::FETCH_ASSOC)) {

        $user = $check_rs['user_id'];
        $ph_id = $check_rs['id'];



        $currency = $check_rs['currency'];

//check timeline

        $now = time();

        $available_check = $db->query("SELECT NULL FROM ph_timeline WHERE ph_id = '$ph_id' AND withdraw_date <= '$now' AND status = '1'");

        $available = $db->query("SELECT SUM(amount) as total FROM ph_timeline WHERE ph_id = '$ph_id' AND withdraw_date <= '$now' AND status = '1'");




        //exit();

        if($available_check->rowCount() == 0){
            continue;
        }


        /*var_dump("PH ID ".$ph_id);
        var_dump($available_check->rowCount());

        var_dump($available->fetch(PDO::FETCH_ASSOC));*/


        $available_rs = $available->fetch(PDO::FETCH_ASSOC);

        $amount = $available_rs['total'];


        $url = $config['site_url'] . "/users/funds.php";
        new_notification("$user", "Investment funds available for withdrawal", "$url");
//send fund to funds
        $descr = "Investment auto withdrawal";
        transact_fund("$user", "$amount", "$descr", "credit", "$currency");

//update the ph_timeline to 2

        $availables = $db->query("UPDATE ph_timeline SET status = '2' WHERE ph_id = '$ph_id' AND withdraw_date <= '$now' AND status = '1'");
    }

}
?>