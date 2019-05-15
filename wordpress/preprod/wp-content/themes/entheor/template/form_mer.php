<?php
$domaines = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}domaine_vae ORDER BY nom_dom_vae ASC", OBJECT );
?>
<input type='hidden' name='action' value='submitFormAddBeneficiaire'/>
<div class="row" id="civility_block">
    <div class="civility_choice col-md-6"><p data-civility="Mme">Madame</p></div>
    <div class="civility_choice col-md-6"><p data-civility="M.">Monsieur</p></div>
</div>
<input type="hidden" name="civility" value="" required/>

<input type="text" name="name" placeholder="Nom" required/>
<input type="text" name="surname" placeholder="Prénom" required/>

<input type="email" name="email" placeholder="Email" required/>
<input type="tel" name="telephone" placeholder="Téléphone" maxlength="10" required/>

<select name="time_preference" required>
    <option>Plage horaire préféré</option>
    <option value="Avant 12 heures">Avant 12 heures</option>
    <option value="Entre 12 et 14 heures">Entre 12 et 14 heures</option>
    <option value="Entre 14 et 16 heures">Entre 14 et 16 heures</option>
    <option value="Après 16 heures">Après 16 heures</option>
    <option value="Indifférent">Indifférent</option>
</select>

<select name="status" required>
    <option value="">Statut</option>
    <option value="Salarié(e) du privé">Salarié(e) du privé</option>
    <option value="Salarié(e) du public">Salarié(e) du public</option>
    <option value="Dirigeant, Indépendant">Dirigeant, Indépendant</option>
    <option value="Demandeur d'emploi">Demandeur d'emploi</option>
</select>

<select name="domaine_activite" required>
    <option value="">Domaine</option>
    <?php foreach ($domaines as $domaine) : ?>
        <option value="<?php echo $domaine->nom_dom_vae ?>" data-id="<?php echo $domaine->id_dom_vae ?>"><?php echo $domaine->nom_dom_vae ?></option>
    <?php endforeach; ?>
</select>

<select name="degree" required>
    <option>Niveau</option>
    <option value="Bac, Titre professionnel">Bac, Titre professionnel</option>
    <option value=">Bac +2">Bac +2</option>
    <option value=">Bac +3">Bac +3</option>
    <option value="Master et plus">Master et plus</option>
</select>

<input type="submit" class="btn btn_submit_form_mer" value="Valider">
<p style="font-size: 11px;text-align: center;margin-top: 6px;">gratuit & sans engagement</p>
<input type="hidden" name="formulaire_add_beneficiaire"/>


