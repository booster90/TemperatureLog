<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!--<meta charset="utf-8">-->
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.ico">
        <title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>

        <!-- moje style zadzialalo-->
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />

        <!-- bootstrapy -->
        <!-- Bootstrap core CSS -->
        <link href="<?php bloginfo('template_url'); ?>/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="<?php bloginfo('template_url'); ?>/assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Custom styles for this template -->
        <link href="<?php bloginfo('template_url'); ?>/carousel.css" rel="stylesheet">
        <?php wp_head(); ?>
    </head>
    <body>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php bloginfo('template_url'); ?>/dist/js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <script src="<?php bloginfo('template_url'); ?>/assets/js/vendor/holder.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<?php bloginfo('template_url'); ?>/assets/js/ie10-viewport-bug-workaround.js"></script>

        <div class="navbar-wrapper">
            <div class="container">
                <nav class="navbar navbar-inverse navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('url'); ?>"> <?php bloginfo('name'); ?> </a>
                        </div>


                        <?php
                        /**
                         * 
                         * tutaj dodajemy menu..
                         * 
                         */
                        wp_nav_menu(array(
                            'theme_location' => 'Main menu',
                            'menu' => 'Main menu',
                            'container' => 'div',
                            'container_id' => 'navbar',
                            'container_class' => 'collapse navbar-collapse',
                            'menu_class' => 'nav navbar-nav',
                            'depth' => 0)
                        );
                        ?>      

                        <!--
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#about">About</a></li>
                                <li><a href="#contact">Contact</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li class="dropdown-header">Nav header</li>
                                        <li><a href="#">Separated link</a></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        -->
                    </div>
                </nav>
            </div>
        </div>