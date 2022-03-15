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


if(!isset($_GET['id'])){
    header("location:all_institution.php");
    exit();
}

$id = $_GET['id'];
$sql = $db->query("SELECT * FROM institution WHERE id = '$id'");

$rs = $sql->fetch(PDO::FETCH_ASSOC);

extract($rs);

if(isset($_POST['ok'])){
    $name = $_POST['name'];
    $campus = $_POST['campus'];
    $location = $_POST['location'];

    $in = $db->query("UPDATE institution SET name = '$name', location = '$location', campus = '$campus' WHERE id = '$id'");
    set_flash("Institution updated successfully","success");
    header("location:edit_institution.php?id=$id");
    exit();
}


$page_name = "Edit  Institution - $name";
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

                            <form action="" method="post" role="form">
                                <div class="form-group">
                                    <label for="">Institution Name</label>
                                    <input type="text" name="name" class="form-control has-success" required value="<?php echo @$name;?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Institution Campus</label>
                                    <input type="text" name="campus" class="form-control has-success" required value="<?php echo @$campus;?>">
                                </div>

                                <div class="form-group">
                                    <label for="">Institution Location</label>
                                    <input type="text" name="location" class="form-control has-success" required  value="<?php echo @$location;?>">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="ok" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>
