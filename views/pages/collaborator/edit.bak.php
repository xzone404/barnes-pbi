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
		<a id="inscription" name="inscription"></a>
		<section id="subscribe" class="container">

			<div class="row">

<?php
if ($form_register->is_valid()) :
?>
			</div>
			<div class="row">
				<div class="col-12">
					<section class="box align-center">
						<p class="success">
							Votre inscription a bien été prise en compte. Si une recherche en cours correspond à vos données de contact,
							nous prendrons alors contact avec le titulaire du contrat, par voie postale. Pensez donc à vous réinscrire
							en cas de changement d'adresse ou pour toute modification ou informations nouvelle quant aux données
							personnelles commmuniquées.<br /><br />

							Merci pour votre confiance,<br />
							L'équipe Conexium.
						</p>
					</section>
				</div>
			</div>
<?php
else :
?>

				<div class="col-12">
					<section class="box">
						<p class="accent6 p-3">
							Attention, toutes les informations demandées concernent le titulaire du compte (nom auquel le compte a été
							ouvert)
							ou le souscripteur du contrat d'assurance-vie (nom auquel le contrat a été souscrit). Pour des questions de
							sécurité,
							de renforcement des dispositifs de contrôle et de confidentialité, il vous est demandé de saisir des
							informations
							précises dans l'outil de recherche. A défaut, celle-ci ne peut aboutir.
						</p>
						<p class="align-center">
							Les champs marqués d'un astérisque (*) sont obligatoires.
						</p>
					</section>
				</div>
			</div>

			<?php if(!empty($errors)): ?>
			<div class="row">
				<div class="col-12">
					<section class="box">
						<ul class="errors">
							<?php foreach ($errors as $error) : ?>
							<li class="error"><?php echo $error; ?></li>
							<?php endforeach; ?>
						</ul>
					</section>
				</div>
			</div>
			<?php endif; ?>

			<form method="<?php echo esc_attr($form_method); ?>" action="<?php echo esc_attr(get_page_link('inscription')); ?>" enctype="multipart/form-data" class="row">
				<input type="hidden" name="_formid_" value="register" />
				<input type="hidden" name="_frmctrl_" value="<?php echo $form_register->get_nonce(); ?>" />

				<?php /*
				<div class="col-12">
					<section class="box">
						<h3>Titulaire du contrat</h3>
						<hr />
					</section>
				</div>
				*/ ?>

				<div class="col-12">
					<section class="box">

						<div class="row gtr-uniform gtr-50">
							<div class="col-6 col-12-narrower">
								<input type="radio" id="recipient-owner" name="recipient" value="owner"
									<?php if (in_array($form_register->get_field_value_esc('recipient'), ['', 'owner'])) echo 'checked'; ?>>
								<label for="recipient-owner">Je suis titulaire</label>
							</div>
							<div class="col-6 col-12-narrower">
								<input type="radio" id="recipient-helper" name="recipient" value="helper"
									<?php if ($form_register->get_field_value_esc('recipient') == 'helper') echo 'checked'; ?>>
								<label for="recipient-helper">J'interviens pour le compte d'un souscripteur</label>
							</div>

							<div class="col-12" data-helper="2" id="recipient-helper-options"<?php if ($form_register->get_field_value_esc('recipient') != 'helper') echo ' style="display: none;"'; ?>>
								<div class="row">
									<div class="col-6 col-12-narrower">
										<input type="radio" id="owner-alive" name="owner_status" value="alive"<?php if (in_array($form_register->get_field_value_esc('owner_status'), ['', 'alive'])) echo ' checked'; ?>>
										<label for="owner-alive">Le titulaire est encore en vie</label>
									</div>
									<div class="col-6 col-12-narrower">
										<input type="radio" id="owner-dead" name="owner_status" value="dead"<?php if ($form_register->get_field_value_esc('owner_status') == 'dead') echo ' checked'; ?>>
										<label for="owner-dead">Le titulaire est décédé</label>
									</div>
								</div>
							</div>
						</div>

					</section>
				</div>


				<div class="col-12" data-helper="2"<?php if ($form_register->get_field_value_esc('recipient') != 'helper') echo ' style="display: none;"'; ?>>

					<section class="box special">
						<div class="align-left">
							<h3>Coordonnées du demandeur :</h3>
							<hr />
						</div>
						<div class="row gtr-uniform gtr-50 align-left">
							<div class="col-6 col-12-narrower">
								<label>Données de contact :</label>
								<div class="row gtr-uniform gtr-50 align-left">
									<div class="col-12">
										<input type="text" name="contact_name" id="contact_name" value="<?php echo $form_register->get_field_value_esc('contact_name'); ?>" placeholder="Nom*" />
									</div>
									<div class="col-12">
										<input type="text" name="contact_firstname" id="contact_firstname" value="<?php echo $form_register->get_field_value_esc('contact_firstname'); ?>" placeholder="Prénom*" />
									</div>
									<div class="col-12">
										<input type="text" name="contact_phone" id="contact_phone" value="<?php echo $form_register->get_field_value_esc('contact_phone'); ?>" placeholder="Téléphone fixe/mobile" />
									</div>
									<div class="col-12">
										<input type="text" name="contact_email" id="contact_email" value="<?php echo $form_register->get_field_value_esc('contact_email'); ?>" placeholder="E-mail*" />
									</div>
								</div>
							</div>
							<div class="col-6 col-12-narrower">
								<label>Adresse postale :</label>
								<div class="row gtr-uniform gtr-50 align-left">
									<div class="col-12">
										<input type="text" name="contact_address" id="contact_address" value="<?php echo $form_register->get_field_value_esc('contact_address'); ?>" placeholder="N° et nom de la voie*" />
									</div>
									<div class="col-12">
										<input type="text" name="contact_address2" id="contact_address2" value="<?php echo $form_register->get_field_value_esc('contact_address2'); ?>" placeholder="Complément d'adresse" />
									</div>
									<div class="col-4 col-12-mobilep">
										<input type="number" name="contact_cp" id="contact_cp" value="<?php echo $form_register->get_field_value_esc('contact_cp'); ?>" placeholder="CP*" />
									</div>
									<div class="col-8 col-12-mobilep">
										<input type="text" name="contact_city" id="contact_city" value="<?php echo $form_register->get_field_value_esc('contact_city'); ?>" placeholder="Nom de la commune*" />
									</div>
									<div class="col-12">
										<input type="text" name="contact_country" id="contact_country" value="<?php echo $form_register->get_field_value_esc('contact_country'); ?>" placeholder="Pays*" />
									</div>
								</div>
							</div>
						</div>
					</section>

				</div>

				<div class="col-12">
					
					<section class="box special">
						<div class="row gtr-uniform gtr-50">
							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="excid">Je possède déjà un identifiant Excellcium :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="text" name="excid" id="excid" value="<?php echo $form_register->get_field_value_esc('excid'); ?>"
									placeholder="EXC000000-000000" />
							</div>
						</div>
					</section>

				</div>


				<div class="col-12">
					<section class="box">
						<h3>Informations personnelles du titulaire</h3>
						<hr />
					</section>
				</div>


				<div class="col-6 col-12-narrower">

					<section class="box special">
						<h4>Données d'état civil</h4>
					</section>

					<p class="px-3 mobilep-py-3 mobilep-mb-0">
						Renseignez ici les données d'identité du titulaire telles que déclarées à l'état civil :
					</p>

					<section class="box special">
						<div class="row gtr-uniform gtr-50 align-left">

							<div>
								<input type="radio" id="birth_gender-m" name="birth_gender" value="male"<?php if ($form_register->get_field_value_esc('birth_gender') == 'male') echo ' checked'; ?>>
								<label for="birth_gender-m">M.</label>
							</div>

							<div>
								<input type="radio" id="birth_gender-f" name="birth_gender" value="female"<?php if ($form_register->get_field_value_esc('birth_gender') == 'female') echo ' checked'; ?>>
								<label for="birth_gender-f">Mme</label>
							</div>

							<div class="col-12">
								<input type="text" name="birth_name" id="birth_name" value="<?php echo $form_register->get_field_value_esc('birth_name'); ?>" placeholder="Nom de naissance*"
									required />
							</div>
							<div class="col-12">
								<input type="text" name="curr_name" id="curr_name" value="<?php echo $form_register->get_field_value_esc('curr_name'); ?>" placeholder="Nom d'usage" />
							</div>
							<div class="col-12">
								<input type="text" name="birth_firstname" id="birth_firstname" value="<?php echo $form_register->get_field_value_esc('birth_firstname'); ?>"
									placeholder="Prénom de naissance*" required />
							</div>
							<div class="col-12">
								<input type="text" name="birth_firstname_others" id="birth_firstname_others" value="<?php echo $form_register->get_field_value_esc('birth_firstname_others'); ?>"
									placeholder="Autres prénoms" />
							</div>

							<div class="col-12">
								<label for="birth_date">Date de naissance* :</label>
								<input type="date" name="birth_date" id="birth_date" value="<?php echo $form_register->get_field_value_esc('birth_date'); ?>" placeholder="Date de naissance*"
									required />
							</div>

							<div class="col-12">
								<label>Commune de naissance :</label>
								<div class="row">
									<div class="col-4 col-12-mobilep">
										<input type="number" name="birth_cp" id="birth_cp" value="<?php echo $form_register->get_field_value_esc('birth_cp'); ?>" placeholder="CP*" required />
									</div>
									<div class="col-8 col-12-mobilep">
										<input type="text" name="birth_city" id="birth_city" value="<?php echo $form_register->get_field_value_esc('birth_city'); ?>" placeholder="Nom de la commune*"
											required />
									</div>
								</div>
							</div>

							<div class="col-12">
								<input type="text" name="birth_country" id="birth_country" value="<?php echo $form_register->get_field_value_esc('birth_country'); ?>" placeholder="Pays*" required />
							</div>

						</div>
					</section>

				</div>

				<div class="col-6 col-12-narrower">

					<section class="box special">
						<h4>Autres informations</h4>
					</section>

					<p class="px-3 mobilep-py-3 mobilep-mb-0">
						Renseignez ici les informations du titulaire correspondant à sa situation actuelle.
					</p>

					<section class="box special">
						<div class="row gtr-uniform gtr-50 align-left">

							<div class="col-12" data-helper="0">
								<label>Adresse de résidence :</label>
								<div class="row gtr-uniform gtr-50 align-left">
									<div class="col-12">
										<input type="text" name="curr_address" id="curr_address" value="<?php echo $form_register->get_field_value_esc('curr_address'); ?>" placeholder="N° et nom de la voie*" />
									</div>
									<div class="col-12">
										<input type="text" name="curr_address2" id="curr_address2" value="<?php echo $form_register->get_field_value_esc('curr_address2'); ?>" placeholder="Complément d'adresse" />
									</div>
									<div class="col-4 col-12-mobilep">
										<input type="number" name="curr_cp" id="curr_cp" value="<?php echo $form_register->get_field_value_esc('curr_cp'); ?>" placeholder="CP*" />
									</div>
									<div class="col-8 col-12-mobilep">
										<input type="text" name="curr_city" id="curr_city" value="<?php echo $form_register->get_field_value_esc('curr_city'); ?>" placeholder="Nom de la commune*" />
									</div>
									<div class="col-12">
										<input type="text" name="curr_country" id="curr_country" value="<?php echo $form_register->get_field_value_esc('curr_country'); ?>" placeholder="Pays*" />
									</div>
								</div>
							</div>

							<div class="col-12" data-helper="1">
								<label>Commune de décès :</label>
								<div class="row gtr-uniform gtr-50 align-left">
									<div class="col-4 col-12-mobilep">
										<input type="number" name="death_cp" id="death_cp" value="<?php echo $form_register->get_field_value_esc('death_cp'); ?>" placeholder="CP" />
									</div>
									<div class="col-8 col-12-mobilep">
										<input type="text" name="death_city" id="death_city" value="<?php echo $form_register->get_field_value_esc('death_city'); ?>" placeholder="Nom de la commune" />
									</div>
									<div class="col-12">
										<input type="text" name="death_country" id="death_country" value="<?php echo $form_register->get_field_value_esc('death_country'); ?>" placeholder="Pays" />
									</div>
								</div>
							</div>

							<div class="col-12" data-helper="1">
								<label>Autres données de décès :</label>
								<div class="row gtr-uniform gtr-50 align-left">
									<div class="col-12" data-xzdisplay="deces">
										<input type="date" name="death_date" id="death_date" value="<?php echo $form_register->get_field_value_esc('death_date'); ?>" placeholder="Date de décès" />
									</div>
									<div class="col-12" data-xzdisplay="deces">
										<input type="text" name="death_num" id="death_num" value="<?php echo $form_register->get_field_value_esc('death_num'); ?>" placeholder="N° acte de décès" />
									</div>
								</div>
							</div>

						</div>
					</section>

				</div>

				<div class="col-12" data-helper="0">

					<section class="box special">
						<div class="row gtr-uniform gtr-50 align-left">

							<div class="col-12">
								<label>Données de contact :</label>
								<div class="row gtr-uniform gtr-50 align-left">
									<div class="col-12">
										<input type="text" name="curr_email" id="curr_email" value="<?php echo $form_register->get_field_value_esc('curr_email'); ?>" placeholder="E-mail*" />
									</div>
									<div class="col-12">
										<input type="text" name="curr_phone" id="curr_phone" value="<?php echo $form_register->get_field_value_esc('curr_phone'); ?>" placeholder="Téléphone fixe/mobile" />
									</div>
								</div>
							</div>

						</div>
					</section>

				</div>

				<div class="col-12">
					<hr />
				</div>

				<div class="col-12">

					<section class="box special">
						<h4>Autres données des contrats</h4>
					</section>

					<p class="px-3 mobilep-py-3 mobilep-mb-0 align-center">
						Vous pouvez préciser ici toutes les autres valeurs qui pourraient être trouvées dans les contrats et
						correspondant au même titulaire.
					</p>

					<section class="box special">

						<div class="row gtr-uniform gtr-50 align-left">
							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="other_names">Autres noms connus :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="text" name="other_names" id="other_names" value="<?php echo $form_register->get_field_value_esc('other_names'); ?>"
									placeholder="Autres noms (séparés par des virgules)" />
							</div>

							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="other_firtnames">Autres prénoms connus :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="text" name="other_firtnames" id="other_firtnames" value="<?php echo $form_register->get_field_value_esc('other_firtnames'); ?>"
									placeholder="Prénoms (séparés par des virgules)" />
							</div>

							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="other_cities">Autres communes connues :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="text" name="other_cities" id="other_cities" value="<?php echo $form_register->get_field_value_esc('other_cities'); ?>"
									placeholder="Communes (CP + Communes, séparés par des virgules)" />
							</div>

							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="other_cities">Employeurs connus :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="text" name="other_jobs" id="other_jobs" value="<?php echo $form_register->get_field_value_esc('other_jobs'); ?>"
									placeholder="Société (Nom + CP + Commune, séparés par des virgules)" />
							</div>
						</div>

					</section>

				</div>


				<div class="col-12">
					<hr />
				</div>

				<div class="col-12">

					<section class="box special">
						<h4>Documents à joindre</h4>
					</section>

					<p class="px-3 mobilep-py-3 mobilep-mb-0 align-center">
						Merci de nous transmettre votre Carte Nationale d'Identité (CNI) ou celle de votre souscripteur. Si la personne est décédée, merci de nous
						transmettre l'acte de décès.
					</p>

					<section class="box special">

						<div class="row gtr-uniform gtr-50 align-left">
							<div class="col-12 mb-2">
								<p class="align-center"><em>Taille maximale pour chaque fichier : 5 Mo. Formats acceptés : PDF, JPEG et PNG.</em></p>
							</div>

							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="attachment_file_1">Pièce d'identité ou acte (1) :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="file" name="attachment_file_1" id="attachment_file_1" value="<?php echo $form_register->get_field_value_esc('attachment_file_1'); ?>"
									accept="<?php echo $form_register->get_field('attachment_file_1')->options['VALID_EXT']; ?>"
									data-maxsize = "<?php echo $form_register->get_field('attachment_file_1')->options['MAX_SIZE']; ?>" />
							</div>

							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="attachment_file_2">Pièce d'identité ou acte (2) :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="file" name="attachment_file_2" id="attachment_file_2" value="<?php echo $form_register->get_field_value_esc('attachment_file_2'); ?>"
								accept="<?php echo $form_register->get_field('attachment_file_2')->options['VALID_EXT']; ?>"
									data-maxsize = "<?php echo $form_register->get_field('attachment_file_2')->options['MAX_SIZE']; ?>" />
							</div>

							<div class="col-4 col-12-mobilep align-right mobilep-align-left">
								<label for="attachment_file_3">Pièce d'identité ou acte (1) :</label>
							</div>
							<div class="col-8 col-12-mobilep">
								<input type="file" name="attachment_file_3" id="attachment_file_3" value="<?php echo $form_register->get_field_value_esc('attachment_file_3'); ?>"
								accept="<?php echo $form_register->get_field('attachment_file_3')->options['VALID_EXT']; ?>"
									data-maxsize = "<?php echo $form_register->get_field('attachment_file_3')->options['MAX_SIZE']; ?>" />
							</div>
						</div>

					</section>

				</div>

				<div class="col-12">
					<hr />
				</div>

				<div class="col-12">

					<section class="box special">
						<h4>Informations complémentaires</h4>
					</section>

					<p class="px-3 mobilep-py-3 mobilep-mb-0">
						Si vous pensez que d'autres informations pourraient nous aider à relier le titulaire à des contrats en
						déshérence, nous vous invitons à nous les indiquer dans le champ libre suivant.
					</p>

					<section class="box special">
						<div class="row gtr-uniform gtr-50">
							<div class="col-12">
								<textarea name="moreinfos" id="moreinfos" placeholder="Informations complémentaires..." rows="6"><?php echo $form_register->get_field_value_esc('moreinfos'); ?></textarea>
							</div>
						</div>
					</section>

				</div>

				<div class="col-12">
					<hr />
				</div>

				<div class="col-12">
					<div class="px-3">
						<div class="row gtr-uniform gtr-50">
							<div class="col-12">
								<p>
									L'email renseigné nous permettra de vous contacter dans le cas où nous aurions besoin d'informations complémentaires pour valider votre dossier.
									Un e-email de confirmation vous sera également envoyé lorsque vos données seront utilisées dans le cadre d'une enquête et remontées à une compagnie d'assurance.
									Aucune communication commerciale ne vous sera adressée.
								</p>
							</div>
							<div class="col-8 col-12-narrower align-left">
								<input type="checkbox" id="human" name="human" required>
								<label for="human">J'accepte les conditions de conservation et d'utilisation de mes données personnelles,
									telles qu'indiquées dans <a href="<?php echo esc_attr(get_page_link('mentions')); ?>">les mentions générales</a>.</label>
							</div>
							<div class="col-4 col-12-narrower">
								<ul class="actions" style="justify-content: center; margin-top: 1em;">
									<li><input type="submit" class="accent6" value="Envoyer" /></li>
									<!-- li><input type="reset" value="Reset" class="alt" /></li -->
								</ul>
							</div>
						</div>
					</div>
				</div>

			</form>
<?php
endif;
?>

		</section>

		<?php view('parts.page_footer'); ?>

	</div>
