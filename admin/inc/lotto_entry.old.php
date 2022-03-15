<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 5/7/2019
 * Time: 11:26 AM
 */


//var_dump($lotto_rs);
$lotto_id = $lotto_rs['lotto_id'];
$total_entries = $lotto_rs['users'];
$enrties = $db->query("SELECT user_id FROM lotto_entry WHERE lotto_id = '$lotto_id'");

$ent = $enrties->rowCount();
$winners = $lotto_rs['winners'];
$wins = $lotto_rs['win'];
$stake = $lotto_rs['stake'];
echo "<h4>Lotto ID: $lotto_id</h4>";
echo "<p>Stake: &#8358;$stake</p>";
echo "<p>Winners: $winners</p>";
echo "<p>Wins: &#8358;$wins per user</p>";



//users in lotto

$my_balance = log_user("balance");

if($my_balance > $stake){
    $className = '';
    $onsubmit = '';
}else{
    $className = 'disabled';
    $onsubmit = 'false; //';
}


if($total_entries == $enrties->rowCount()){
    $className = 'disabled';
    $onsubmit = 'false; //';
}
?>

<form action="" method="post" role="form" onsubmit="return <?php echo $onsubmit;?> confirm('Are you sure you want to enter?');">
    <input type="submit" name="ok" class="btn btn-warning btn-lg <?php echo $className;?> btn-block" value="Enter for &#8358; <?php echo $stake;?>">
</form>
</div>
</div>
<div class="card card-danger">
    <div class="card-block">
<?php
echo "<p>Lotto Entries: $ent of $total_entries </p>";

$me = $_SESSION['cre-user'];
?>
<ul class="list-inline">
        <?php
while($enrties_rs = $enrties->fetch(PDO::FETCH_ASSOC)){
    if($me == $enrties_rs['user_id']){
        $color = '#f00';
    }else{
        $color = '#333';
    }

    $uname = user_details($enrties_rs['user_id'],"name");

    echo "<li class='list-inline-item' style='color:$color'><i class='fa fa-user-circle'></i> $uname</li>";


}

    ?>
</ul>

    </div>
</div>
