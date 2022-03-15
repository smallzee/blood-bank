<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 11/1/2019
 * Time: 2:09 PM
 */


$all_donors = $db->query("SELECT NULL FROM donor WHERE o_type='donor'");
$accepted_donors = $db->query("SELECT NULL FROM donor WHERE o_type='donor' AND status = 'Donated'");

$all_donors2 = $db->query("SELECT NULL FROM donor WHERE o_type='receiver'");
$accepted_donors2 = $db->query("SELECT NULL FROM donor WHERE o_type='receiver' AND status = 'Received'");

?>

<div class="page-header">
    <div class="page-title"><h3>Hi Admin</h3></div>
    <ul class="page-stats">
        <li>
            <div class="summary"><span>Total Donor</span>
                <h3><?php echo $all_donors->rowCount();?></h3></div>

        </li>

        <li>
            <div class="summary"><span>Total Receiver</span>
                <h3><?php echo $all_donors2->rowCount();?></h3></div>

        </li>
        <li>
            <div class="summary"><span>Total Blood Donated</span>
                <h3><?php echo $accepted_donors->rowCount();?></h3></div>
        </li>

        <li>
            <div class="summary"><span>Total Blood Received</span>
                <h3><?php echo $accepted_donors2->rowCount();?></h3></div>
        </li>
    </ul>
</div>
