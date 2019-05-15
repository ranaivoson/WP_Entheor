<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#efefef",
                        "text": "#404040"
                    },
                    "button": {
                        "background": "transparent",
                        "text": "#8ec760",
                        "border": "#8ec760"
                    }
                },
                "content": {
                    "message": "Notre site utilise des cookies afin que nous puissions vous fournir la meilleure expérience utilisateur. En navigant sur notre site, vous acceptez l'usage que nous en faisons. ",
                    "dismiss": "OK",
                    "link": "En savoir plus",
                    "href": "https://entheor.com/entheor_wordpress_production/wordpress/vie-privee/"
                }
            })});
    </script>
</head>

<body>
    <header>
        <a href="<?php echo home_url('/') ?>"><img id="logo" src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-entheor.png" alt="Logo Entheor"  /></a>
        <nav class="text-uppercase menu_theme_entheor"><b><?php echo wp_nav_menu() ?></b></nav>
    </header>