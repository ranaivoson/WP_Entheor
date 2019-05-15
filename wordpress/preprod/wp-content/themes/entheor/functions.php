<?php
/**
 * Created by PhpStorm.
 * User: Brice
 * Date: 20/01/2019
 * Time: 23:15
 */

add_theme_support( 'post-thumbnails' );
function add_meta_tags() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
}
add_action('wp_head', 'add_meta_tags');

function add_theme_scripts() {
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  ';
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css',false,'1.0','all');
    wp_enqueue_style( 'header', get_template_directory_uri() . '/assets/css/header.css',false,'1.0','all');
    wp_enqueue_style( 'footer', get_template_directory_uri() . '/assets/css/footer.css',false,'1.0','all');
    wp_enqueue_style( 'centre', get_template_directory_uri() . '/assets/css/centre.css',false,'1.0','all');
    wp_enqueue_style( 'landing_article', get_template_directory_uri() . '/assets/css/landing_article.css',false,'1.0','all');
    wp_enqueue_style( 'owl.carousel.min', get_template_directory_uri() . '/assets/external_plugin/owl_carousel_2-2.3.4/dist/assets/owl.carousel.min.css',false,'1.0','all');
    wp_enqueue_style( 'owl.theme.default', get_template_directory_uri() . '/assets/external_plugin/owl_carousel_2-2.3.4/dist/assets/owl.theme.default.min.css',false,'1.0','all');
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

// js : start
function add_js(){
    echo '
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3gY2iTno749_CwwQ47wJoWEXNNS2IH4o&callback=initMap"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    ';
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', false, 1.0, true);
    wp_enqueue_script( 'centre', get_template_directory_uri() . '/assets/js/centre.js', false, 1.0, true);
    wp_enqueue_script( 'beneficiaire', get_template_directory_uri() . '/assets/js/beneficiaire.js', false, 1.0, true);
    wp_enqueue_script( 'owl.carousel.min', get_template_directory_uri() . '/assets/external_plugin/owl_carousel_2-2.3.4/dist/owl.carousel.min.js',false,'1.0','all');
    // pour faire fonctionner de l'ajax : http://www.geekpress.fr/tuto-ajax-wordpress-methode-simple/
    wp_localize_script('beneficiaire', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

  }
add_action('wp_footer', 'add_js');


function get_centre(){
    global $wpdb;
    $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}centrevae", OBJECT );
}

//------------------------ AJOUT URL CUSTOM ----------------------------------------------------------

// Ajouter url custom : https://codex.wordpress.org/Rewrite_API/add_rewrite_rule , j'ai suivi ce tuto
// Ne pas oublier de sauvegarder les Permaliens pour Wordpress soit au courant de l'url (Réglage->Permaliens->Enregistrer)

function custom_rewrite_tag() {
    add_rewrite_tag('%ville%', '([^&]+)');
    add_rewrite_tag('%id_bureau%', '([^&]+)');
    // Ci dessous : ajouter un second parametre
    // add_rewrite_tag('%testparam%', '([^&]+)');
}
add_action('init', 'custom_rewrite_tag', 10, 0);

function custom_rewrite_rule() {
    add_rewrite_rule('^vae-([^/]*)/([^/]*)/?','index.php?page_id=138&ville=$matches[1]&id_bureau=$matches[2]','top');

    // Ci dessous : ajouter une seconde url avec le 2nd parametre
    add_rewrite_rule('^temoignages-vae/?','index.php?page_id=177','top');
}
add_action('init', 'custom_rewrite_rule', 10, 0);


// Recherche de Bureau pour afficher une page détail de centre VAE
function traitement_formulaire()
{
    if (isset($_POST['search_center'])) {

        // Lancement Curl pour récupérer la ville
        $url = "https://appli-dev.entheor.com/web/app_dev.php/api/offices?zip=" . $_POST['zip_search_center'] . "&limit=1";

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
           // var_dump($result);exit;
            if(is_array($result)){
                if(count($result) > 0){
                    $idBureau = $result[0]->id;
                    $slugVille = $result[0]->ville->slugVille;

                    wp_redirect( home_url().'/vae-'.$slugVille.'/'.$idBureau.'/' );
                }else{
                    echo "Pas de résultat";
                }
            }else{
                // bureau à distance
                $idBureau = $result->id;
                $slugVille = $result->ville->slugVille;
                wp_redirect( home_url().'/vae-'.$slugVille.'/'.$idBureau.'/' );
            }
        }
    }
}
add_action('template_redirect', 'traitement_formulaire');


// Ajax pour récupérer les domaines métiers en bdd
function domaine_metier_vae_ajax() {
    global $wpdb;

    $id = (isset($_POST["id_domaine_vae"])) ? $_POST["id_domaine_vae"] : '';

    $metier =
        $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}domaine_vae_metier WHERE id_dom_vae = %d ORDER BY name_metier ASC",
            $id
        )
    );

    echo json_encode($metier);
    exit;
}
add_action('wp_ajax_nopriv_domaine_metier_vae_ajax', 'domaine_metier_vae_ajax');
add_action('wp_ajax_domaine_metier_vae_ajax', 'domaine_metier_vae_ajax');


// Ajout d'un bénéficiaire dans Entheo
function submit_form_add_beneficiaire(){

    if (isset($_POST['formulaire_add_beneficiaire']))
    {
        $data = array(
            "codePostal" => (isset($_POST['zip'])) ? $_POST['zip'] : '',
            "domaineVae" => $_POST['domaine_activite'],
            "statut" => (isset($_POST['status'])) ? $_POST['status'] : '',
            "diplomeVise" => (isset($_POST['degree_wanted'])) ? $_POST['degree_wanted'] : '',
            "civiliteConso" => $_POST['civility'],
            "telConso" => $_POST['telephone'],
            "emailConso" => $_POST['email'],
            "heureRappel" => $_POST['time_preference'],
            "nomConso" => $_POST['name'],
            "prenomConso"=> $_POST['surname'],
            "origineMer" => 'entheor_com_naturel',
            "poste" => (isset($_POST['metiers'])) ? $_POST['metiers'] : '',
            "experience" => (isset($_POST['experience'])) ? $_POST['experience'] : '',
            "motivation" => (isset($_POST['reason'])) ? $_POST['reason'] : '',
        );

        // Lancement Curl pour insérer un bénéficiaire
        $url = "https://appli-dev.entheor.com/web/app_dev.php/api/beneficiaries";

        $auth = "devEntheo:3E5_yu*C";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
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
        //var_dump($result);exit;

        // Mail envoye par smtp de sentingblue
        $message = "
            <img src='https://entheor.com/assets/image/logo-entheor.png'>
            <p>Voici les informations du contact : </p>
            <ul>
                <li>Date et heure de la mise en relation : ".date('d/m/Y à h:i')."</li>
                <li>Civilité, nom et prénom : ".ucfirst($data['civiliteConso'])." ".ucfirst($data['nomConso'])." ".ucfirst($data['prenomConso'])."</li>
                <li>Statut : ".ucfirst($data['statut'])."</li>
                <li>Téléphone : ".$data['telConso']."</li>
                <li>Horaire de rappel : ".$data['heureRappel']."</li>
                <li>Email : ".$data['emailConso']."</li>
                <li>Diplôme : ".$data['diplomeVise']."</li>
                <li>Secteur d'activité : ".$data['domaineVae']."</li>
            </ul>
        ";

        $data_to_send_mail = array(
            'sender' => array('email' => 'admin@entheor.com', 'name' => 'Admin Entheor'),
            'replyTo' => array('email' => 'admin@entheor.com', 'name' => 'Admin Entheor'),
            'to' => array(
                array('email' => 'brice.lof@gmail.com', 'name' => 'Brice Lof'),
            ),
            'subject' => 'Mise en relation',
            'htmlContent' => $message,
            'tags' => array('mer_entheor.com')
        );

        $header = array('Accept: application/json', 'Content-Type: application/json', 'api-key: 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');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data_to_send_mail),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        // A décommenter pour voir le retour de l'api en cas d'erreur
//        if ($err) {
//            echo "cURL Error #:" . $err;
//        } else {
//            echo $response;
//        }

        wp_redirect( home_url().'/demande-contact-enregistre/' );

    }
}
add_action('admin_post_nopriv_submitFormAddBeneficiaire', 'submit_form_add_beneficiaire');
add_action('admin_post_submitFormAddBeneficiaire', 'submit_form_add_beneficiaire');


// Page contact
function submit_form_contact(){
    if (isset($_POST['formulaire_contact'])) {
        $data = array(
            "objet" => (isset($_POST['objet'])) ? $_POST['objet'] : '',
            "nom" => (isset($_POST['nom'])) ? $_POST['nom'] : '',
            "prenom" => (isset($_POST['prenom'])) ? $_POST['prenom'] : '',
            "telephone" => (isset($_POST['telephone'])) ? $_POST['telephone'] : '',
            "email" => (isset($_POST['email'])) ? $_POST['email'] : '',
            "message" => (isset($_POST['message'])) ? $_POST['message'] : '',
        );

        // Mail envoye par smtp de sentingblue
        $message = "
            <img src='https://entheor.com/assets/image/logo-entheor.png'>
            <p>Voici les informations du contact : </p>
            <ul>
                <li>Objet : " . $data['objet'] . "</li>
                <li>Nom et prénom : ".ucfirst($data['nom']) . " " . ucfirst($data['prenom']) . "</li>
                <li>Téléphone : " . $data['telephone'] . "</li>
                <li>Email : " . $data['email'] . "</li>
                <li>Message : " . $data['message'] . "</li>
            </ul>
        ";

        $data_to_send_mail = array(
            'sender' => array('email' => 'admin@entheor.com', 'name' => 'Admin Entheor'),
            'replyTo' => array('email' => 'admin@entheor.com', 'name' => 'Admin Entheor'),
            'to' => array(
                array('email' => 'brice.lof@gmail.com', 'name' => 'Brice Lof'),
            ),
            'subject' => 'Demande de contact',
            'htmlContent' => $message,
            'tags' => array('demande_contact_entheor.com')
        );

        $header = array('Accept: application/json', 'Content-Type: application/json', 'api-key: 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');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data_to_send_mail),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        // A décommenter pour voir le retour de l'api en cas d'erreur
//        if ($err) {
//            echo "cURL Error #:" . $err;
//        } else {
//            echo $response;
//        }

        wp_redirect(home_url() . '/demande-contact-enregistre/');
    }
}
add_action('admin_post_nopriv_submitFormContact', 'submit_form_contact');
add_action('admin_post_submitFormContact', 'submit_form_contact');