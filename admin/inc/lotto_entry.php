<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 5/7/2019
 * Time: 11:26 AM
 */


//var_dump($lotto_rs);
?>

<div id="lotto-info">
    <div class="row text-center">
        <div class="col mt-3 mb-4">
            <span class="fa-3x">&#8358; </span><span class="stake fa-3x"></span>
            <p><em><small>Ticket Price</small></em></p>
        </div>
        <div class="col mt-3 mb-4">
            <span class="fa-3x">&#8358; </span> <span class="lotto-users fa-3x"></span>
            <p><em><small>Current Jackpot</small></em></p>
        </div>
    </div>
</div>

<form action="" method="post" role="form" id="enrol-form" class="hide">
    <input type="hidden" name="stake" id="the-stake">
    <input type="hidden" name="lid" id="the-lid">
    <div class="text-center" align="center">
        <button  style="display: inline-block; margin-left: auto; margin-right: auto;" type="submit" name="ok" class="btn btn-lg btn-success round gradient-crystal-clear" id="entry-btn" >Buy Ticket</button>
    </div>
</form>
