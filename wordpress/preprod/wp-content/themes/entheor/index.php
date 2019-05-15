<?php
/**
 * Created by PhpStorm.
 * User: Brice
 * Date: 20/01/2019
 * Time: 19:13
 */
?>

<?php get_header(); ?>
<?php //var_dump(get_post_permalink(90));

// Permet de communiquer avec la BDD
global $wpdb;

?>


<section id="search_block" class="text-uppercase">
    <img src="<?php echo get_template_directory_uri() ?>/assets/image/img-principal.jpg" alt="Faire une validation des acquis professionnels avec Enthéor c’est trouver le bon accompagnement VAE" width="100%" />
    <div id="text_button_search" class="container text-uppercase">
        <div class="block_intro_search">
            <p>Pour chaque projet VAE, un interlocuteur dédié.<br>
                Trouvez le vôtre :
            </p>
        </div>
        <p id="block_btn_to_access_search_center">
            <button class="btn my-2 text-uppercase" id="btn_to_access_search_center_by_zip_france">En France</button>
            <button class="btn my-2 text-uppercase" id="btn_to_access_search_center_foreigner">A l'étranger</button>
        </p>

        <div id="form_search_center_home" style="display: none;">
            <form action="" method="post">
                <input type="number" name="zip_search_center" placeholder="Code Postal" class="col-md-3" required="required">
                <input type="submit" name="search_center" value="Rechercher" id="zip_search_center_submit" class="btn">
            </form>
        </div>

    </div>
</section>

<section id="three_step">
    <div class="container text-center">
        <h1 class="text-uppercase">Votre diplôme par la VAE en 3 étapes</h1>
        <p class="introduction">La VAE est un droit qui vous permet de faire valider les acquis de votre expérience en vue d'obtenir un diplôme, un titre ou un certificat de qualification. L'accompagnement à la VAE peut se dérouler pendant le temps de travail ou hors temps de travail, en présentiel ou à distance et est ouverte aux expatriés.</p>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <picture>
                    <img src="<?php echo get_template_directory_uri() ?>/assets/image/icone-cv.png" alt="Un accompagnement vae pour la rédaction de votre dossier vae livret 1"/>
                </picture>
                <p class="description_img"><span class="text-uppercase title">Livret 1 : votre cv </span><br><span class="sub_title">Rendez votre démarche VAE officielle</span></p>
            </div>
            <div class="col-sm-6 col-md-4">
                <picture>
                    <img src="<?php echo get_template_directory_uri() ?>/assets/image/icone-livret2.png" alt="Justifiez de votre expérience professionnelle grâce au dossier vae livret 2"/>
                </picture>
                <p class="description_img"><span class="text-uppercase title">Livret 2 : vos compétences cv</span> <br><span class="sub_title">Rendez votre démarche VAE officielle</span></p>
            </div>
            <div class="col-sm-6 col-md-4">
                <picture>
                    <img src="<?php echo get_template_directory_uri() ?>/assets/image/icone-jury.png" alt="Décrochez votre validation des acquis (VAE)"/>
                </picture>
                <p class="description_img"><span class="text-uppercase title">Passage devant le jury</span> <br><span class="sub_title">Présenter votre dossier aux jurés</span></p>
            </div>
        </div>
        <button class="btn" id="btn_launch_form">+ Demande d'information</button>
    </div>
    <!-- Form : ajout beneficiaire -->
    <?php get_template_part( 'template/form_add_beneficiaire' ); ?>

</section>

<section id="numbers">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-3 numbers_detail">
               <p>2.5 millions <br><span>de visiteurs</span></p>
            </div>
            <div class="col-sm-6 col-md-3 numbers_detail">
                <p>800 personnes <br><span>accompagnées chaque année</span></p>
            </div>
            <div class="col-sm-6 col-md-3 numbers_detail">
                <p>8000 formations <br><span>dans 300 villes</span></p>
            </div>
            <div class="col-sm-6 col-md-3 numbers_detail">
                <p>60 consultants <br><span>dans 300 villes</span></p>
            </div>
        </div>
    </div>
</section>

<section id="reviews">
    <div class="container">
        <h2 class="text-center">Ils racontent leur accompagnement VAE avec Enthéor</h2>
        <div class="row">
            <?php
                // Lancement Curl pour récupérer le bureau
                $url = "https://appli-dev.entheor.com/web/app_dev.php/api/advices?limit=6";

                $auth = "devEntheo:3E5_yu*C";

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                    CURLOPT_USERPWD => $auth,
                    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false
                ));


                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $result = json_decode($response);

                }
            ?>
            <div class="owl-carousel">
                <?php foreach($result as $avis) : ?>
                    <?php //var_dump($avis) ?>
                    <article class="block_review">
                        <div class="block_article">
                            <?php
                            $datePublishRaw = $avis->date;
                            $datePublishFinal = new DateTime($datePublishRaw);
                            ?>
                            <p class="date"><i>Publié le <?php echo $datePublishFinal->format('d/m/Y') ?></i></p>

                            <!--<picture>
                                <img class="block_profile_img" src="" alt="Photo de la personne témoignant"/>
                            </picture>-->
                            <p class="info_review">
                                <i>
                                    <span class="name"><?php echo $avis->beneficiaire->prenomConso ?></span><br>
                                    VAE <span class="domain"><?php echo $avis->beneficiaire->domaineVae ?></span>
                                </i>

                            </p>
                            <div class="note">
                                <?php for($i = 1; $i <= $avis->noteGlobale; $i++) : ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icon_star_note.png" alt="Note globale"/>
                                <?php endfor; ?>
                            </div>
                            <p class="extract">
                                <i>"<?php echo $avis->commentaireGeneral; ?>"</i>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?php //$reviews = get_posts( array('category_name' => 'temoignages')); ?>
<!--                --><?php //foreach($reviews as $review) : ?>
<!--                    <article class="block_review">-->
<!--                        <div class="block_article">-->
<!--                            <picture>-->
<!--                                <img class="block_profile_img" src="" alt="Photo de la personne témoignant"/>-->
<!--                            </picture>-->
<!--                            <p><span class="name"></span><br><span class="domain"></span></p>-->
<!--                            <p class="extract">-->
<!--                                <i>"--><?php //echo $review->post_excerpt; ?><!--"</i>-->
<!--                            </p>-->
<!--                        </div>-->
<!--                        <div class="content_to_split d-none" >-->
<!--                            --><?php //echo $review->post_content; ?>
<!--                        </div>-->
<!--                    </article>-->
<!--                --><?php //endforeach; ?>
            </div>
        </div>
        <div id="block_btn_more_reviews">
            <?php
                $category_id = get_cat_ID( 'temoignages' );
                $category_link = get_category_link( $category_id );
            ?>
            <a href="<?php echo home_url('/') ?>temoignages-vae" target="_blank" class="btn center" id="btn_more_reviews">+ Témoignages VAE</a>
        </div>
    </div>
</section>

<section id="trainer">
    <?php $articleAccompagnateur = get_post(160); ?>
    <img src="<?php echo get_template_directory_uri() ?>/assets/image/accompagnateur-vae.jpg" alt="Faire une formation pour devenir accompagnateur VAE avec Enthéor" width="100%" />
    <div id="block_trainer_text" class="container">
        <div class="col-md-8 offset-md-4 col-sm-12 offset-sm-0">
            <h2 class="text-uppercase">Devenez conseiller/accompagnateur VAE</h2>
            <p><?php echo substr($articleAccompagnateur->post_content, 0, 600); ?>...</p>
            <a href="<?php echo get_permalink($articleAccompagnateur->ID) ?>" target="_blank" class="btn center" id="">+ Découvrez le programme</a>
        </div>
    </div>
</section>

<section id="article_focus">
    <div class="container">
        <div class="row">
            <div class="owl-carousel">
                <?php $articles = get_posts( array('category_name' => 'landing')); ?>
                <?php foreach($articles as $article) : ?>
                    <article>
                        <div class="block_article">
                            <h2><a href="<?php echo get_permalink($article->ID) ?>"><?php echo $article->post_title; ?></a></h2>
                            <a href=<?php echo get_permalink($article->ID) ?>"><picture style="background: url(<?php echo get_the_post_thumbnail_url($article->ID) ?>) no-repeat center;background-size: cover;"></picture></a>
                            <p class="extract">
                                <?php echo $article->post_excerpt; ?>
                            </p>
                            <a href="<?php echo get_permalink($article->ID) ?>" target="_blank" class="btn center btn_see_more" id="">+ En savoir plus</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section id="vae_distance">
    <img src="<?php echo get_template_directory_uri() ?>/assets/image/vae-distance-expat.jpg" alt="Validation des acquis professionnels (VAE) à distance avec Enthéor" width="100%" />
    <div id="vae_distance_text" class="container">
        <div class="text-center">
            <h2 class="text-uppercase">VAE À DISTANCE & EXPATRIÉS</h2>
            <p>
                Validez votre expérience professionnelle acquise à l’étranger.<br> Enthéor vous propose un accompagnement VAE à distance.
            </p>
            <a href="" target="_blank" class="btn center text-uppercase" >+ Faire un diagnostic vae</a>
        </div>
    </div>
</section>

<section id="program">
    <img src="<?php echo get_template_directory_uri() ?>/assets/image/entheor-corporate.jpg" alt="VAE en entreprise, Enthéor vous propose un accompagnement VAE sur mesure " width="100%" />
    <div id="block_program_text" class="container">
        <div class="col-md-8">
            <h2 class="text-uppercase">LE PROGRAMME POUR<br> ACCOMPAGNER VOS COLLABORATEURS</h2>
            <p>
                Lorem Ipsum est un générateur de faux textes aléatoires. Vous choisissez le nombre de paragraphes, de mots ou de listes. Vous obtenez alors un texte aléatoire que vous pourrez ensuite utiliser librement dans vos maquettes.

                Le texte généré est du pseudo latin et peut donner l'impression d'être du vrai texte.

                Faux-Texte est une réalisation du studio de création de sites internet indépendant Prélude Prod.

                Si vous aimez la photographie d'art et l'esprit zen, jetez un œil sur le site de ce photographe à Palaiseau, en Essonne (France).
            </p>
            <a href="" target="_blank" class="btn center">+ Découvrez le programme</a>
        </div>
    </div>
</section>

<section id="actu">
    <div class="container">
        <h2>Actualités VAE à la une</h2>
        <div class="row">
            <?php $reviews = get_posts( array('category_name' => 'actualites-vae')); ?>
            <?php foreach($reviews as $review) : ?>
                <article class="col-sm-6 col-md-4">
                    <div class="block_article">
                        <a href="<?php echo get_permalink($review->ID) ?>"><picture style="background: url(<?php echo get_the_post_thumbnail_url($review->ID) ?>) no-repeat center;background-size: cover;"></picture></a>
                        <h3><a href="<?php echo get_permalink($review->ID) ?>"><?php echo $review->post_title; ?></a></h3>
                        <p class="extract">
                            <?php echo $review->post_excerpt; ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <?php
            // Get the ID of a given category
            $category_id = get_cat_ID( 'Actualités vae' );
            // Get the URL of this category
            $category_link = get_category_link( $category_id );
        ?>
        <a href="<?php echo $category_link ?>" target="_blank" class="btn center" id="btn_voir_plus_actu">+ Voir les actualités VAE</a>
    </div>
</section>

<section id="contact_us">
    <img src="<?php echo get_template_directory_uri() ?>/assets/image/contact-entheor.jpg" alt="Enthéor vous accompagne dans votre démarche VAE
" width="100%" />
    <div id="contact_us_text" class="container">
        <div class="">
            <h2 class="text-uppercase">NOUS SOMMES LÀ POUR VOUS ACCOMPAGNER</h2>
            <p>Nos équipes vous répondent dans l’heure</p>
            <a href="<?php echo get_permalink(90) ?>" target="_blank" class="btn center">+ Envoyer un message</a>
        </div>
    </div>
</section>

<section id="best_degree" class="container-fluid">
    <div class="container">
        <h2 class="text-uppercase">Les diplômes les plus demandés par la vae</h2>
        <p class="introduction">
            Vous avez l’expérience mais n’avez pas le diplôme équivalent ?  Offrez-vous cette chance grâce à la validation des acquis de l’expérience ! Trouvez parmi ces domaines, celui qui correspond à votre métier.
        </p>

        <div class="row">
            <?php $reviews = get_posts( array('category_name' => 'diplome-plus-demandes'));?>
            <div class="owl-carousel" id="best_degree_block">
                <?php foreach($reviews as $review) : ?>
                    <div class="best_degree_by_domain_block">
                        <div class="best_degree_by_domain">
                            <h3><?php echo $review->post_title ?></h3>
                            <p><?php echo $review->post_content ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section id="training_around_you" class="container-fluid">
    <div class="container">
        <h2 class="text-uppercase">Un accompagnement à la vae près de chez vous ?</h2>
        <p class="introduction">
            ENTHEOR vous propose également un accompagnement VAE à distance et à destination des expatriés.
        </p>
        <div class="row">
            <?php $reviews = get_posts( array('category_name' => 'vae-pres-de-chez-vous'));?>
            <div class="owl-carousel" id="training_around_you_block">
                <?php foreach($reviews as $review) : ?>
                    <div class="training_around_you_by_city_block">
                        <div class="training_around_you_by_city">
                            <h3><?php echo $review->post_title ?></h3>
                            <p><?php echo $review->post_content ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>