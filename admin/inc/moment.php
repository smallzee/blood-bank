<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 5/7/2019
 * Time: 4:48 AM
 */
?>
<style type="text/css">
    /*-- timer --*/
    .timer {
        font-size: 3em;
        display: inline-block;
        vertical-align: top;
        color: #F00;
        font-weight: 600;
    }
    .ttext {
        font-size: .9em;
        color: #F00;
        margin-top: 0.5em;
        text-align: center;
        letter-spacing: 1px;
    }
    .clock .column {
        padding: 1em .5em;
        float: left;
        width: 19.2%;
        background: none;
        border:none;
        border-left: none;
        text-align: center;
        transition: all 0.2s ease-in-out;
        -moz-transition: all 0.2s ease-in-out;
        -webkit-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
    }
    .column.days {
        border-left:none;
    }
    .days {
        display: none;
    }
</style>
<?php
    echo "<h4>$the_msg</h4>";
?>
<div class="agileits-timer">
    <div class="clock">
        <div class="column days">
            <div class="timer" id="days"></div>
            <div class="ttext">Days</div>
        </div>
        <div class="timer days"></div>
        <div class="column">
            <div class="timer" id="hours"></div>
            <div class="ttext">Hours</div>
        </div>
        <div class="timer"></div>
        <div class="column">
            <div class="timer" id="minutes"></div>
            <div class="ttext">Minutes</div>
        </div>
        <div class="timer"></div>
        <div class="column">
            <div class="timer" id="seconds"></div>
            <div class="ttext">Seconds</div>
        </div>
        <div class="clear"> </div>
    </div>
</div>
