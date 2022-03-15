<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <head>
        <title>Student Blood Bank</title>
        <?php include_once "meta.php"; ?>

    <body> 


        <!--  HEADER -->

        <?php include_once "header.php"; ?>

        <!--  HOME SLIDER BLOCK  -->

        <div class="slider-wrap">

            <div id="slider_1" class="owl-carousel owl-theme">

                <div class="item">
                    <img src="images/home_1_slider_1.jpg" alt="img">
                    <div class="slider-content text-center">
                        <div class="container">

                            <div class="slider-contents-info">
                                <h2>
                                    Student Blood Bank System
                                </h2>
                                <h3>
                                    (A case study of Lautech Teaching Hospital, Osogbo)
                                </h3>
                                <a href="donate.php" class="btn btn-slider">Donate Blood Now <i class="fa fa-long-arrow-right"></i></a>
                            </div> <!-- end .slider-contents-info  -->
                        </div><!-- /.slider-content -->
                    </div>
                </div>

                <div class="item">
                    <img src="images/home_1_slider_1.jpg" alt="img">
                    <div class="slider-content text-center">
                        <div class="container">
                            <div class="slider-contents-info">
                                <h2>
                                    Student Blood Bank System
                                </h2>
                                <h3>
                                    (A case study of Lautech Teaching Hospital, Osogbo)
                                </h3>
                                <a href="receive.php" class="btn btn-slider">Request Blood Transfusin<i class="fa fa-long-arrow-right"></i></a>
                            </div><!-- /.slider-content -->
                        </div> <!-- end .slider-contents-info  -->
                    </div>

                </div>
            </div>

        </div>

        <!-- HIGHLIGHT CTA  -->   

        <section class="cta-section-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <p>
                            You can give blood at any of our blood donation center all over the world.

                        </p>
                    </div> <!--  end .col-md-8  -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <a class="btn btn-cta-1" href="donate.php">Donate Now</a>
                    </div> <!--  end .col-md-4  -->
                </div> <!--  end .row  -->
            </div>
        </section> 

        <!--  SECTION DONATION PROCESS -->

        <section class="section-content-block section-process">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-md-12 col-sm-12 text-center">
                        <h2 class="section-heading"><span>Donation</span> Process</h2>
                        <p class="section-subheading">The donation process from the time you arrive center until the time you leave</p>
                    </div> <!-- end .col-sm-10  -->                    

                </div> <!--  end .row  -->

                <div class="row wow fadeInUp">

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="process-layout">

                            <figure class="process-img">

                                <img src="images/process_1.jpg" alt="process" />
                                <div class="step">
                                    <h3>1</h3>
                                </div>
                            </figure> <!-- end .process-img  -->

                            <article class="process-info">
                                <h2>Registration</h2>   
                                <p>You need to complete a very simple registration form. Which contains all required contact information to enter in the donation process.</p>
                            </article>

                        </div> <!--  end .process-layout -->

                    </div> <!--  end .col-lg-3 -->



                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="process-layout">

                            <figure class="process-img">
                                <img src="images/process_2.jpg" alt="process" />
                                <div class="step">
                                    <h3>2</h3>
                                </div>
                            </figure> <!-- end .cau<h5 class="step">1</h5>se-img  -->

                            <article class="process-info">                                   
                                <h2>Screening</h2>
                                <p>A drop of blood from your finger will take for simple test to ensure that your blood iron levels are proper enough for donation process.</p>
                            </article>

                        </div> <!--  end .process-layout -->

                    </div> <!--  end .col-lg-3 -->


                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="process-layout">

                            <figure class="process-img">
                                <img src="images/process_3.jpg" alt="process" />
                                <div class="step">
                                    <h3>3</h3>
                                </div>
                            </figure> <!-- end .process-img  -->

                            <article class="process-info">
                                <h2>Donation</h2>
                                <p>After ensuring and passed screening test successfully you will be directed to a donor bed for donation. It will take only 6-10 minutes.</p>
                            </article>

                        </div> <!--  end .process-layout -->

                    </div> <!--  end .col-lg-3 -->



                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <div class="process-layout">

                            <figure class="process-img">
                                <img src="images/process_4.jpg" alt="process" />
                                <div class="step">
                                    <h3>4</h3>
                                </div>
                            </figure> <!-- end .process-img  -->

                            <article class="process-info">
                                <h2>Refreshment</h2>
                                <p>You can also stay in sitting room until you feel strong enough to leave our center. You will receive awesome drink from us in donation zone. </p>
                            </article>

                        </div> <!--  end .process-layout -->

                    </div> <!--  end .col-lg-3 -->

                </div> <!--  end .row --> 

            </div> <!--  end .container  -->

        </section> <!--  end .section-process --> 


        <section class="section-content-block cta-section-3">       
            <div class="container wow fadeIn animated">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cta-content text-center">
                            <h2>Donate blood now and save life</h2>
                            <a class="btn-cta-3" href="donate.php">Become Volunteer</a>
                        </div>
                    </div> <!-- end .col-md-12 -->
                </div> <!-- end .row  -->
            </div> <!-- end .container  -->
        </section>   <!-- end cta-section  -->  





        <?php
            include_once "footer.php";
        ?>
    </body>

</html>