<?php
/**
 * Template Name: Avis
 */
get_header();

?>

<section id="reviews_page" class="category_page">
    <div id="block_header_photo_landing" style="background: url() no-repeat center;background-size: cover;">
        <div id="overlay"></div>
        <h1>Ils racontent leur accompagnement VAE avec Enthéor</h1>
    </div>

    <div class="container">
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

            <?php foreach($result as $avis) : ?>
                <?php //var_dump($avis) ?>
                <article class="block_review col-sm-6 col-md-4">
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
        </div>
    </div>
</section>

<?php get_footer(); ?>