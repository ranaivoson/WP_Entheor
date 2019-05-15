<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <a href="<?php echo home_url('/') ?>"><img id="logo" src="<?php echo get_template_directory_uri(); ?>/assets/image/logo-entheor.png" alt="Logo Entheor"  /></a>
        <nav class="text-uppercase"><b><?php echo wp_nav_menu() ?></b></nav>
    </header>