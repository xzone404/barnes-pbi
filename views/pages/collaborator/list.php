<?php

if (!defined('ENV')) die();

$p_current = get_current_page();

global $DBConn;
if ($DBConn) :
	$stmt = sqlsrv_prepare($DBConn, "SELECT * FROM `dbo`.`my_bu`;");
	$rq = sqlsrv_execute($stmt);
endif;

/*
require_once(PATH_CLASSES . 'Form.php');

$fields = [
	new Field('human', 'bool', 'Accepter les conditions de conservation et d\'utilisation de mes données personnelles', false),

	new Field('recipient', 'text', 'Titulaire du contrat', false),
	new Field('owner_status', 'text', 'Statut du titulaire', false),
	
	//new Field('contact_gender', 'text', 'Civilité de naissance', $contact_required),
	new Field('contact_name', 'name', 'Nom de naissance', false),
	new Field('contact_firstname', 'name', 'Prénom de naissance', false),
	new Field('contact_email', 'email', 'E-mail actuel', false),
	new Field('contact_phone', 'tel', 'Téléphone actuel', false),
	new Field('contact_address', 'text', 'Adresse actuelle', false),
	new Field('contact_address2', 'text', 'Complément d\'adresse', false),
	new Field('contact_cp', 'int', 'Code postal de naissance', false),
	new Field('contact_city', 'name', 'Commune de naissance', false),
	new Field('contact_country', 'name', 'Pays de naissance', false),

	new Field('moreinfos', 'text', 'Informations complémentaires', false),
	new Field('excid', 'text', 'Identifiant Excellcium', false),
];
*/
?>
	<div id="page-wrapper">

<?php view('parts.page_header'); ?>

<?php view('parts.page_banner'); ?>

		<!-- Form -->
		<a id="inscription" name="inscription"></a>
		<section id="subscribe" class="container">

			<div class="row">
				<div class="col-12">
					[TABLE]
				</div>
			</div>

		</section>

		<?php view('parts.page_footer'); ?>

	</div>
