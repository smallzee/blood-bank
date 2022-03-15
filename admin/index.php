<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 8/17/2019
 * Time: 12:56 PM
 */

include_once "../core/db.php";
if(!admin()){
    header("location:login.php");
    exit();
}




$page_name = "";
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title>Dashboard</title>
    <?php
        include_once "meta.php";
    ?>
    <script>$(document).ready(function () {
            App.init();
            Plugins.init();
            FormComponents.init()
        });</script>
    <script type="text/javascript" src="assets/js/custom.js"></script>
    <script type="text/javascript" src="assets/js/demo/pages_calendar.js"></script>
    <script type="text/javascript" src="assets/js/demo/charts/chart_filled_blue.js"></script>
    <script type="text/javascript" src="assets/js/demo/charts/chart_simple.js"></script>

</head>
<body class="theme-light">
<?php
    include_once "nav.php";
?>

<div id="container">

    <?php include_once "sidebar.php";?>

    <div id="content">
        <div class="container">
            <div class="crumbs">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><i class="icon-home"></i> <a href="index">Dashboard</a></li>
                    <li class="current"><a href="#" title=""><?php echo @$page_name;?></a></li>
                </ul>

            </div>

            <?php
                include_once "site_nav.php";
            ?>



            <div class="row">
                <div class="col-md-12">
                    <div class="widget box">
                        <div class="widget-header"><h4><i class=""></i> Statistics</h4></div>
                        <div class="widget-content">

                            <table class="table table-bordered">
                            <tr>
                                <th>
                                Total Institution
                                </th>
                                <td class=""><?php echo $db->query("SELECT NULL FROM institution")->rowCount();?></td>
                            </tr>

                            <tr>
                                <th>
                                Total Donors
                                </th>
                                <td  class=""><?php echo $db->query("SELECT NULL FROM donor WHERE o_type = 'donor'")->rowCount();?></td>
                            </tr>

                                <tr>
                                    <th>
                                        Total Receivers
                                    </th>
                                    <td  class=""><?php echo $db->query("SELECT NULL FROM donor WHERE o_type = 'receiver'")->rowCount();?></td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">

                <div class="col-md-8 col-sm-12">

                    <p>Student Blood Bank System (A case study of Lautech Teaching Hospital, Osogbo) - Designed by Opikhara Anthony A (HC201702386)</p>

                </div>

                <div class="col-md-4 col-sm-12">
                    <p>Supervised Mr. Adekunle A.U</p>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
