<?php
/**
 * Template Name: Bureau
 */
get_header();

// Permet de recuperer param dans url
global $wp_query;
$idBureau = $wp_query->query_vars['id_bureau'];

global $wp;
$currentUrl = home_url( $wp->request );

// Permet de communiquer avec la BDD
global $wpdb;


// Lancement Curl pour récupérer le bureau
$url = "https://appli-dev.entheor.com/web/app_dev.php/api/offices/".$idBureau;

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
    //var_dump($result);
}

?>
<input type="hidden" value="<?php echo $currentUrl ?>" name="current_url">
<article>
    <div id="block_header_photo" style="background: url(<?php echo get_template_directory_uri() ?>/assets/image/entheor-paris.jpg) no-repeat center;background-size: cover;">
        <div id="overlay"></div>
        <h1>Accompagnement VAE à <?php echo $result->ville->nom ?></h1>
        <h2 class="text-uppercase"><?php echo $result->nombureau ?></h2>
        <div id="note">
            <?php
                $notesTotal = 0;
                $nombreBeneficiaire = count($result->beneficiaires);
                foreach($result->beneficiaires as $beneficiaire){
                    if(count($beneficiaire->avis) > 0){
                        $noteBeneficiaire = $beneficiaire->avis[0]->noteGlobale;
                        $notesTotal = $notesTotal + $noteBeneficiaire;
                    }else{
                        $nombreBeneficiaire = $nombreBeneficiaire - 1;
                    }
                }
                if($notesTotal > 0){
                    $noteToDisplay = $notesTotal / $nombreBeneficiaire;
                    $noteToDisplay = round($noteToDisplay);
                }
            ?>
            <?php if(isset($noteToDisplay) && $noteToDisplay > 0) : ?>
                <p id="moyenne_note"><?php echo $noteToDisplay; ?></p>
                <div id="moyenne_note_stars">
                    <?php for($i = 1; $i <= $noteToDisplay; $i++) : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icon_star_note.png" alt="Note globale"  width="22px" />
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <section id="content" class="container">
        <div class="row">
            <div id="block_content_centre" class="col-md-9">
                <div class="row">
                    <nav id="tab_list">
                        <ul>
                            <li><a href="#tab_description"><?php echo $result->nombureau ?></a></li>
                            <li><a href="#tab_trainer">L'équipe</a></li>
                            <li><a href="#tab_review">Avis VAE</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="row">
                    <div id="content_block">
                        <div id="tab_description">
                            <p><?php echo $result->intro ?></p>
                            <div class="row">
                                <img class="col-md-8 img_focus" src="<?php echo get_template_directory_uri() ?>/assets/image/entheor-paris.jpg" />
                                <div class="col-md-4 block_img_then">
                                    <div class="row">
                                        <img class="col-md-12" src="<?php echo get_template_directory_uri() ?>/assets/image/entheor-paris.jpg" />
                                        <img class="col-md-12" src="<?php echo get_template_directory_uri() ?>/assets/image/entheor-paris.jpg" />
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div id="tab_trainer">
                            <p id="title">Nos consultants vous reçoivent pour votre projet VAE</p>
                            <?php foreach($result->consultants as $consultant) : ?>
                                <article>
                                    <div class="row">
                                        <div class="img_profile_trainer col-md-3" style="background: url(https://via.placeholder.com/150x350) no-repeat center;background-size: cover;"></div>
                                        <div class="description_trainer col-md-9">
                                            <p class="trainer_name"><?php echo $consultant->prenom.' '.$consultant->nom ?></p>
                                            <p class="trainer_detail"><?php echo $consultant->description ?></p>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>

                        <div id="tab_review">
                            <?php foreach($result->beneficiaires as $beneficiaire) : ?>
                                <?php //var_dump($beneficiaire) ?>
                                <?php if(count($beneficiaire->avis) > 0) : ?>
                                    <article>
                                        <?php
                                            $datePublishRaw = $beneficiaire->avis[0]->date;
                                            $datePublishFinal = new DateTime($datePublishRaw);
                                        ?>
                                        <p class="date">Publié le <?php echo $datePublishFinal->format('d/m/Y') ?></p>
                                        <div class="note">
                                            <?php for($i = 1; $i <= $beneficiaire->avis[0]->noteGlobale; $i++) : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/icon_star_note.png" alt="Note globale"/>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="reviewer"><?php echo $beneficiaire->prenomConso ?>, 34 ans <span class="reviewer_domain"><i>VAE Management</i></span></p>

                                        <p class="detail_review">
                                            <i>"<?php echo $beneficiaire->avis[0]->commentaireGeneral ?>"</i>
                                        </p>
                                    </article>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <aside class="col-md-3">
                <div class="row">
                   <p class="col-md-12" id="etre_rappele">Être rappelé</p>
                    <!-- Form : ajout beneficiaire -->
                    <div id="form_mer">
                        <form id="form_mise_en_relation" action='<?php echo admin_url( 'admin-post.php' ); ?>' method="post">
                            <input type="hidden" name="zip" value="<?php echo $result->ville->cp ?>"/>
                            <?php get_template_part( 'template/form_mer'); ?>
                        </form>
                    </div>

                </div>
            </aside>
        </div>
        <div class="row" id="localisation">
            <div id="block_map" class="col-md-9">
                <div id="map"></div>
            </div>
            <aside class="col-md-3">
                <div class="row">
                    <div id="information_place" class="col-md-12">
                        <p class="text-uppercase title">adresse</p>
                        <ul>
                            <li class=""><?php echo $result->adresse."<br>".ucfirst(strtolower($result->ville->cp." ".$result->ville->dpt)); ?></li>
                        </ul>

                        <p class="text-uppercase title">accès</p>
                        <ul>
                            <li class=""><?php echo $result->acces ?></li>
                        </ul>

                    </div>
                </div>
            </aside>
        </div>
    </section>
</article>

<section id="diagnostic" class="container-fluid">
    <div class="container text-center">
        <h3 class="text-uppercase"><b>Votre diagnostic vae avec <?php echo $result->nombureau ?></b></h3>
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
    <?php include 'form_add_beneficiaire.php'; ?>
</section>



<script>
    var adress = {lat: <?php echo $result->ville->latitude ?>, lng: <?php echo $result->ville->longitude ?>};
    function initMap() {
        // The location of Uluru

        // The map, centered at Uluru
        var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 13, center: adress});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: adress, map: map});
    }
</script>

<?php
// ... more ...
get_footer();