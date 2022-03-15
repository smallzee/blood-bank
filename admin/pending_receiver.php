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


if(isset($_POST['ok-confirm'])){

    $id = $_POST['id'];
    $now = time();
    $status = "Received";
    $o_type = "receiver";
    $up = $db->query("UPDATE donor SET status = '$status', date_donated = '$now' WHERE id = '$id' AND o_type = '$o_type'");

    set_flash("Blood transfusion confirmed successfully","success");
    //exit();
}


if(isset($_POST['ok-reject'])){
    $id = $_POST['id'];

    $now = time();
    $status = "Rejected";
    $o_type = 'receiver';
    $up = $db->query("UPDATE donor SET status = '$status' WHERE id = '$id' AND o_type = '$o_type'");

    set_flash("Blood transfusion rejected successfully","success");
}



$page_name = "Pending Blood Receiver";
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <title><?php echo $page_name;?></title>
    <?php
        include_once "meta.php";
    ?>
    <script>$(document).ready(function () {
            App.init();
            Plugins.init();
            FormComponents.init();
        });</script>


    <link rel="stylesheet" href="assets/css/plugins/datatables_bootstrap.css">
    <script type="text/javascript" src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="plugins/datatables/tabletools/TableTools.min.js"></script>
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
                        <div class="widget-header"><h4><i class=""></i> <?php echo $page_name;?></h4></div>
                        <div class="widget-content">
                            <?php flash();?>
                            <div class="table-responsive dataTable">
                                <table class="table table-striped table-bordered datatable">
                                    <thead>
                                        <tr>
                                            <th>Sn</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Blood Group</th>
                                            <th>Center</th>
                                            <th>Receive Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $all = $db->query("SELECT * FROM donor WHERE o_type = 'receiver' AND status = 'pending'");
                                        $sn = 0;
                                    while($rs = $all->fetch(PDO::FETCH_ASSOC)){
                                        $center_id = $rs['institution'];
                                        $ins = $db->query("SELECT * FROM institution WHERE id = '$center_id'");
                                        $ins_rs = $ins->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <tr>
                                            <td><?php echo ++$sn;?></td>
                                            <td><?php echo $rs['name'];?></td>
                                            <td><?php echo $rs['email'];?></td>
                                            <td><?php echo $rs['phone'];?></td>
                                            <td><?php echo $rs['blood_group'];?></td>
                                            <td>
                                                <?php
                                                echo $ins_rs['name'].", ".$ins_rs['campus']." Campus ".$ins_rs['location'];
                                                ?>
                                            </td>
                                            <td><?php echo $rs['donation_date'].", ".$rs['donation_time'];?></td>
                                                <td>
                                                    <?php
                                                        if($rs['status'] == "pending"){
                                                            ?>
                                                            <form action="" method="post" class="form-inline">
                                                                <input type="hidden" name="id" value="<?php echo $rs['id'];?>">
                                                                <input type="submit" name="ok-confirm" value="Confirm Transfusion" class="btn btn-sm btn-success" onclick="return confirm('Are you sure that the blood has been transfused to the user?');">
                                                                <input class="btn btn-sm btn-danger" type="submit" name="ok-reject" value="Reject Transfusion" onclick="return confirm('Are you sure you want to reject transfusion?');">
                                                            </form>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
