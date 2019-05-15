<?php
/**
 * Created by PhpStorm.
 * User: Brice
 * Date: 20/01/2019
 * Time: 19:13
 */
?>

<?php get_header(); ?>

<?php
    $page = get_post();

    if ($page->post_name == 'contact' ){
        while ( have_posts() ){
            ?>
            <div id="block_header_photo_landing" style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center;background-size: cover;">
                <div id="overlay"></div>
                <h1>Contact</h1>
            </div>
            <section class="container" id="block_contact_form">
                <?php
                the_post();
                the_content();
                ?>
            </section>
            <?php

        }
    }else{
        while ( have_posts() ){
            ?>
            <section class="container">
                <?php
                the_post();
                the_content();
                ?>
            </section>
            <?php

        }
    }
?>

<?php get_footer(); ?>