<?php
    require_once "core/db.php";


    if(isset($_POST['ok'])){

        extract($_POST);

        $in = $db->query("INSERT INTO donor SET institution = '$donation_center', name = '$name', email = '$email', phone = '$phone', blood_group = '$blood_group', donation_date = '$donation_date', donation_time = '$donation_time', o_type = 'donor'");

        set_flash("Your request has been submitted successfully","success");
        header("location:donate.php");
        exit();
    }
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <head>
        <title>Student Blood Bank - Donate Blood</title>
        <?php include_once "meta.php"; ?>

    <body> 


        <!--  HEADER -->

        <?php include_once "header.php"; ?>



        <section class="page-header">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">

                        <h3>
                            Donate Blood
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="#">Home</a> / Donate Blood
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section>


        <section class="section-content-block section-our-team">

            <div class="container wow fadeInUp">

                <div class="row section-heading-wrapper">

                    <div class="col-md-12 col-sm-12 text-center">
                        <h2 class="section-heading">Donate Blood</h2>
                        <p class="section-subheading">Donate Blood Today and Save a life</p>
                    </div> <!-- end .col-sm-10  -->

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <?php flash();?>
                        <div class="appointment-form-wrapper text-center clearfix">
                            <h3 class="join-heading">Submit Donation Request</h3>
                            <form class="appoinment-form" method="post" action="" role="form">
                                <div class="form-group col-md-6">
                                    <input id="your_name" name="name" required class="form-control" placeholder="Name" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="your_email"  name="email" required class="form-control" placeholder="Email" type="email">
                                </div>
                                <div class="form-group col-md-6">
                                    <input id="your_phone" name="phone" required class="form-control" placeholder="Phone" type="tel">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="select-style">
                                        <select class="form-control" name="donation_center" required>
                                            <option value="">Donation Center</option>
                                            <?php
                                                $all_centers = $db->query("SELECT * FROM institution");
                                                while($rs = $all_centers->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                    <option value="<?php echo $rs['id']; ?>">
                                                        <?php echo $rs['name'].", ".$rs['campus']." Campus, ".$rs['location'];?>
                                                    </option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <input id="your_date" required name="donation_date" class="form-control" placeholder="Date" type="date">
                                </div>


                                <div class="form-group col-md-6">
                                    <input id="your_time"  required name="donation_time" class="form-control" placeholder="Time" type="time">
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="select-style">
                                        <select class="form-control" name="blood_group" required>
                                            <option value="">Blood Group</option>
                                            <option>A+</option>
                                            <option>A-</option>
                                            <option>AB+</option>
                                            <option>AB-</option>
                                            <option>O+</option>
                                            <option>O-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <button id="btn_submit" name="ok" class="btn-submit" type="submit">Submit Request</button>
                                </div>

                            </form>

                        </div>


                    </div>
                </div>
            </div>
        </section>


        <?php include_once "footer.php"; ?>
    </body>

</html>