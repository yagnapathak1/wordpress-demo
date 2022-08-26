<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, IE=11, IE=10">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
    <div class="navbar navbar-light">
        <div class="container-fluid">
            <?php echo get_custom_logo();?>

            <ul class="nav navbar-nav">
                <button class="navbar-toggler pull-xs-right" id="navbarSideButton" type="button">
                    &#9776;
                </button>
            </ul>
        </div>
    </div>
    <section class="container">
        <nav class="navbar navbar-light navbar-static bg-faded" role="navigation">
            <?php 
                if ( has_nav_menu( 'primary-menu' ) ){
                    wp_nav_menu( 
                        array(
                            'theme_location'    => 'primary-menu',
                            'depth'             => 0,
                            'container'         => false,
                            'container_class'   => 'navbar-side',
                            'menu_class'        => 'navbar-side',
                            'add_li_class'  => 'navbar-side-item',
                            'add_a_class'=>'side-link'
                        )
                    ); 
            }
            ?>
            <div class="overlay"></div>
        </nav>
    </section>