<?php

get_header();

global $wp_query;

$post = get_post();
$category = get_the_category($post->ID);
?>
<article>
    <div id="block_header_photo_landing" style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center;background-size: cover;">
        <div id="overlay"></div>
        <h1><?php echo $post->post_title; ?></h1>
    </div>

    <section id="content" class="container">
        <div class="row">
            <div id="block_content_article" class="col-md-9">
                <?php echo $post->post_content; ?>
            </div>
            <aside class="col-md-3">
                <div class="row">
                    <p class="col-md-12" id="etre_rappele">Être rappelé</p>
                    <!-- Form : ajout beneficiaire -->
                    <div id="form_mer">
                        <form id="form_mise_en_relation" action='<?php echo admin_url( 'admin-post.php' ); ?>' method="post">
                            <?php get_template_part( 'template/form_mer'); ?>
                        </form>
                    </div>

                </div>
            </aside>
        </div>
    </section>

    <section id="other_landings" class="container">
        <h2>
            <?php if($category[0]->slug == 'actualites-vae') : ?>
                Actualités VAE
                <?php $articles = get_posts( array('category_name' => 'actualites-vae')); ?>
            <?php elseif ($category[0]->slug == 'landing') : ?>
                Nos Prestations
                <?php $articles = get_posts( array('category_name' => 'landing')); ?>
            <?php endif; ?>
        </h2><span class="line"></span>
        <div class="row">
            <?php foreach($articles as $article) : ?>
                <?php if (get_permalink($article->ID) != get_permalink()) : ?>
                    <article class="col-sm-6 col-md-4">
                        <div class="block_article">
                            <a href="<?php echo get_permalink($article->ID) ?>"><picture style="background: url(<?php echo get_the_post_thumbnail_url($article->ID) ?>) no-repeat center;background-size: cover;"></picture></a>
                            <p class="extract">
                                <?php echo $article->post_excerpt; ?>
                            </p>
                            <a href="<?php echo get_permalink($article->ID) ?>" target="_blank" class="btn center btn_see_more" id="">+ En savoir plus</a>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="diagnostic" class="container-fluid">
        <div class="container text-center">
            <h3 class="text-uppercase"><b>Votre diagnostic vae avec Enthéor</b></h3>
            <p>
                <b>Le présent questionnaire va nous permettre de diagnostiquer vos possibilités d'accès à un diplôme par la VAE. Il devra être suivi d'un <br>
                    entretien. Les données fournies resteront confidentielles et ne peuvent être transmises à aucune entité externe à ENTHEOR.
                </b>
            </p>
            <button class="btn" id="btn_launch_form">Commencer</button>
        </div>
    </section>

    <section id="form_step_diagnostic" class="container-fluid">
        <!-- Form : ajout beneficiaire -->
        <?php get_template_part( 'template/form_add_beneficiaire' ); ?>
    </section>
</article>

<?php
// ... more ...
get_footer();