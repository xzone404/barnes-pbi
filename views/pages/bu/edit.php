<?php

if (!defined('ENV')) die();

require_once(PATH_CLASSES . 'Form.php');

$contact_required = ($_POST['recipient'] ?? '') == 'helper';

$form_method = 'POST';
$form_register = new Form('register', [
	new Field('human', 'bool', 'Accepter les conditions de conservation et d\'utilisation de mes données personnelles', true),

	new Field('recipient', 'text', 'Titulaire du contrat', true),
	new Field('owner_status', 'text', 'Statut du titulaire', false),
	
	//new Field('contact_gender', 'text', 'Civilité de naissance', $contact_required),
	new Field('contact_name', 'name', 'Nom de naissance', $contact_required),
	new Field('contact_firstname', 'name', 'Prénom de naissance', $contact_required),
	new Field('contact_email', 'email', 'E-mail actuel', $contact_required),
	new Field('contact_phone', 'tel', 'Téléphone actuel', false),
	new Field('contact_address', 'text', 'Adresse actuelle', $contact_required),
	new Field('contact_address2', 'text', 'Complément d\'adresse', false),
	new Field('contact_cp', 'int', 'Code postal de naissance', $contact_required),
	new Field('contact_city', 'name', 'Commune de naissance', $contact_required),
	new Field('contact_country', 'name', 'Pays de naissance', $contact_required),
	
	new Field('birth_gender', 'text', 'Civilité de naissance', true),
	new Field('birth_name', 'name', 'Nom de naissance', true),
	new Field('birth_firstname', 'name', 'Prénom de naissance', true),
	new Field('birth_firstname_others', 'name', 'Autres prénoms de naissance', false),
	new Field('birth_date', 'date_ymd', 'Date de naissance', true),
	new Field('birth_cp', 'int', 'Code postal de naissance', true),
	new Field('birth_city', 'name', 'Commune de naissance', true),
	new Field('birth_country', 'name', 'Pays de naissance', true),

//	new Field('curr_gender', 'text', 'Civilité d\'usage', false),
	new Field('curr_name', 'name', 'Nom d\'usage', false),
//	new Field('curr_firstname', 'name', 'Prénom d\'usage', false),
//	new Field('curr_firstname_others', 'name', 'Autres prénoms d\'usage', false),
	new Field('curr_address', 'text', 'Adresse actuelle', !$contact_required),
	new Field('curr_address2', 'text', 'Complément d\'adresse', false),
	new Field('curr_cp', 'int', 'Code postal actuel', !$contact_required),
	new Field('curr_city', 'name', 'Commune actuelle', !$contact_required),
	new Field('curr_country', 'name', 'Pays actuel', !$contact_required),
	new Field('curr_email', 'email', 'E-mail actuel', !$contact_required),
	new Field('curr_phone', 'tel', 'Téléphone actuel', false),

	new Field('death_cp', 'int', 'Code postal de décès', false),
	new Field('death_city', 'name', 'Commune de décès', false),
	new Field('death_country', 'name', 'Pays de décès', false),
	new Field('death_date', 'date_ymd', 'Date de décès', false),
	new Field('death_num', 'text', 'Numéro d\'acte de décès', false),

	new Field('attachment_file_1', 'file', 'Pièce d\'identité ou acte', false, ['MAX_SIZE'=>5*1024*1024, 'VALID_EXT'=>'.png, .jpg, .jpeg, .pdf']),
	new Field('attachment_file_2', 'file', 'Pièce d\'identité ou acte', false, ['MAX_SIZE'=>5*1024*1024, 'VALID_EXT'=>'.png, .jpg, .jpeg, .pdf']),
	new Field('attachment_file_3', 'file', 'Pièce d\'identité ou acte', false, ['MAX_SIZE'=>5*1024*1024, 'VALID_EXT'=>'.png, .jpg, .jpeg, .pdf']),

	new Field('other_names', 'name', 'Autres noms connus', false),
	new Field('other_firtnames', 'name', 'Autres prénoms connus', false),
	new Field('other_cities', 'text', 'Autres communes connues', false),
	new Field('other_jobs', 'text', 'Employeurs connus', false),

	new Field('moreinfos', 'text', 'Informations complémentaires', false),
	new Field('excid', 'text', 'Identifiant Excellcium', false),
], $form_method);

$errors = $form_register->has_errors() ? $form_register->get_errors() : [];
?>
	<div id="page-wrapper">

<?php view('parts.page_header'); ?>

<?php view('parts.page_banner'); ?>

		<!-- Form -->
		<a id="edit_form" name="edit_form"></a>
		<section id="editor" class="container">

			<div class="row">
				<div class="col-12">

					[FORM]

				</div>
			</div>

		</section>

		<?php view('parts.page_footer'); ?>

	</div>
