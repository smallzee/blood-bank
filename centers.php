<?php
    require_once "core/db.php";
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <head>
        <title>Student Blood Bank - Donation Institution</title>
        <?php include_once "meta.php"; ?>

    <body> 


        <!--  HEADER -->

        <?php include_once "header.php"; ?>



        <section class="page-header">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">

                        <h3>
                            Donation Institution
                        </h3>

                        <p class="page-breadcrumb">
                            <a href="#">Home</a> / Donation Institution
                        </p>


                    </div>

                </div> <!-- end .row  -->

            </div> <!-- end .container  -->

        </section>


        <section class="section-content-block section-our-team">

            <div class="container wow fadeInUp">

                <div class="row section-heading-wrapper">

                    <div class="col-md-12 col-sm-12 text-center">
                        <h2 class="section-heading">Donation Institution</h2>
                        <p class="section-subheading">Checkout Institutions where you can donate and receive blood</p>
                    </div> <!-- end .col-sm-10  -->

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Name</th>
                                    <th>Campus</th>
                                    <th>Location</th>
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
        </section>


        <?php include_once "footer.php"; ?>
    </body>

</html>