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


if(isset($_GET['act']) && $_GET['act'] == "del"){
    $id = $_GET['id'];
    $sql = $db->query("DELETE FROM institution WHERE id = '$id'");
    set_flash("Institution deleted successfully","success");
    header("location:all_institution.php");
    exit();
}



$page_name = "All Institution";
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
                        <div class="widget-header"><h4><i class=""></i> <?php echo $page_name;?></h4></div>
                        <div class="widget-content">
                            <?php flash();?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Campus</th>
                                            <th>Location</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $all = $db->query("SELECT * FROM institution");
                                        $sn = 0;
                                        while($rs = $all->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <tr>
                                                <td><?php echo ++$sn;?></td>
                                                <td><?php echo $rs['name'];?></td>
                                                <td><?php echo $rs['campus'];?></td>
                                                <td><?php echo $rs['location'];?></td>
                                                <td>
                                                    <a href="edit_institution.php?id=<?php echo $rs['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                                    <a href="all_institution.php?act=del&id=<?php echo $rs['id'];?>" onclick="return confirm('Are you sure you want to delete this Institution');" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash-o"></i> Delete
                                                    </a>
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
