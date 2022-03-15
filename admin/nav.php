<?php
/**
 * Created by PhpStorm.
 * User: Hollyphat
 * Date: 8/17/2019
 * Time: 1:08 PM
 */


?>
<header class="header navbar navbar-fixed-top" role="banner">
    <div class="container">
        <ul class="nav navbar-nav">
            <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
        </ul>
        <a class="navbar-brand" href="index.php"> <img src="assets/img/logo.png" alt="logo"/> <strong>Blood</strong>Bank
        </a> <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom"
                data-original-title="Toggle navigation"> <i class="icon-reorder"></i> </a>
        <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
            <li><a href="index.php"> Dashboard </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i
                        class="icon-male"></i>
                    <span class="username">
                        Admin
                    </span>
                    <i class="icon-caret-down small"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="logout"><i class="icon-key"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>

</header>
