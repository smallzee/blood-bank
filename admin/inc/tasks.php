<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 5/7/2019
 * Time: 5:03 AM
 */

$my_id = $_SESSION['cre-user'];
$today = date("Y-m-d");

$sql_check = $db->query("SELECT NULL FROM daily_task WHERE user_id = '$my_id' AND date_stamp = '$today'");
if($sql_check->rowCount() > 0){
    echo "<div class=\"clearfix\"></div><h4>You have already submitted task for the day!</h4>";
}else{


    ?>
    <div class="clearfix"></div>
    <h5>Task for the day</h5>
    <form action="" method="post" role="form">
        <div class="form-group">
            <label for="">Facebook Post url</label>
            <input type="url" name="url" class="form-control" required placeholder="Facebook post url for today">
        </div>

        <div class="form-group">
            <p class="lead">INSTRUCTIONS</p>

            <ol>
                <li>Download the image below</li>
                <li>Write/compose a nice/unique post about Megathrifts stating why anyone seeing your post should join.</li>
                <li>At the end of your writeup you must include your referral link and our telegram link.</li>
                <li>Post your writeup with the image downloaded and get the post URL by clicking on the image you uploaded on facebook and copying the URL in the address bar for submission.</li>
                <li>Wait patiently while your URL submitted is manually checked for confirmation.</li>
            </ol>
            <p>Once confirmed you'd get additional 1% of your investment for that day.
                <br>
            Good luck
            </p>
        </div>

        <div class="form-group">
            <input type="submit" name="ok" class="btn btn-sm btn-success" value="Submit">
        </div>
    </form>
    <p>&nbsp;</p>
    <a target="_blank" href="../admin/imgs/<?php echo settings("task_image");?>"><img src="../admin/imgs/<?php echo settings('task_image');?>" class="img-responsive" width="400" alt="Daily Task image"></a>
    <?php


}