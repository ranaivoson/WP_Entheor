<?php
echo 'BRIVE';
if (isset($_POST['form_mise_en_relation_hidden']))
{
    $data = array(
        "codePostal" => $_POST['zip'],
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
var_dump($data);exit;
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



//    // Mail envoye par smtp de sentingblue
//    $header = array('Accept: application/json', 'Content-Type: application/json', 'api-key: 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');
//
//    $curl = curl_init();
//
//    curl_setopt_array($curl, array(
//        CURLOPT_HTTPHEADER => $header,
//        CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => "",
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 30,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => "POST",
//        CURLOPT_POSTFIELDS => json_encode($data)
//    ));
//
//    $response = curl_exec($curl);
//    $err = curl_error($curl);
//
//    curl_close($curl);

    // A décommenter pour voir le retour de l'api en cas d'erreur
//        if ($err) {
//            echo "cURL Error #:" . $err;
//        } else {
//            echo $response;
//        }

}
