<?php

if (!defined('ENV')) die();

?>
	<div id="page-wrapper">

<?php view('parts.page_header'); ?>

<?php view('parts.page_banner'); ?>

		<!-- Main -->
		<section id="main" class="container">

			<div class="box special">
				<header class="major">
					<h2>Conservation et utilisation de vos données personnelles</h2>
				</header>
			</div>

			<div class="row">
				<div class="col-12">
					<section class="box">
						<p>
							Nous vous informons que les données à caractère personnel vous concernant collectées via le formulaire
							accessible à l'adresse www.conexium.fr ainsi que vos données à caractère
							personnel relatives à vos données d'identification, à la vie personnelle, à la vie professionnelle, sont
							susceptibles de faire l'objet d'un traitement par CONEXIUM dont le siège est situé 83 rue Michel Ange
							75016 Paris.
						</p>
						<p>
							Les données collectées sont destinées à être utilisées par notre établissement. Elles seront également
							rendues accessibles à nos prestataires techniques, pour les stricts besoins de leur
							mission.
						</p>
						<p>
							Vos données seront utilisées pour le traitement de votre demande de mise à jour de coordonnées au titre de
							la loi n°2014-617 du 13 juin 2014 relative aux comptes bancaires inactifs et aux contrats d’assurance vie
							en déshérence, c'est-à-dire à des fins de gestion des fonds en déshérence, par la loi précitée (article
							6.1 c) du RGPD).
						</p>
						<p>
							Nous vous informons que vos données seront également utilisées :
						</p>
						<ul>
							<li>A des fins de prévention et de lutte contre la fraude dans le cadre de nos missions d’intérêt public
								(article 6.1 e) du RGPD) et de nos obligations légales et réglementaires (article 6.1 c) du RGPD),</li>
							<li>Pour répondre à nos obligations de vigilance, de déclaration et d’information au titre de la
								règlementation sur la lutte contre le blanchiment des capitaux et le financement du terrorisme (article
								6.1 c) du RGPD), dans les limites de vos intérêts et droits. Conformément aux dispositions de l’article
								L.561-45 du code monétaire et financier, les personnes physiques disposent d’un droit d’accès indirect
								sur les données les concernant qu’elles peuvent exercer en s’adressant directement auprès de la CNIL, 3
								Place de Fontenoy - TSA 80715 - 75334 Paris Cedex 07.</li>
						</ul>
						<p>
							Les données traitées sont toutes indispensables d'un point de vue règlementaire.
						</p>
						<p>
							Nous vous rappelons que vous disposez d’un droit d’accès, de rectification des données erronées vous
							concernant, et, dans les cas prévus par la règlementation, d’opposition, de suppression de certaines de
							vos données, d’en faire limiter l’usage ou de solliciter leur portabilité en vue de leur transmission à un
							tiers mais également de définir le sort de vos données après votre décès.
						</p>
						<p>
							Pour exercer vos droits, il vous suffit d’adresser un email à l’adresse
							suivante mesdonneespersonnelles@excellcium.fr, ou d’envoyer un courrier à l’adresse Excellcium 83 rue
							Michel Ange 75016 Paris, et d’y joindre, le cas échéant, toute pièce permettant de justifier votre
							identité et votre demande. Si votre demande ne concerne pas le traitement de vos données personnelles,
							votre email ne sera pas traité. Pour toute autre demande veuillez envoyer un email à
							contact@excellcium.fr.
						</p>
						<p>
							Toutefois, afin de respecter les dispositions de la loi Eckert ainsi que du code monétaire et financier,
							vos données personnelles sont susceptibles d'être conservées pendant une durée de 10 ans à compter de la
							création de votre dossier, sous réserve d'une absence d'interruption ou de suspension d'instance. Dans ce
							cas, en application de l'article 17 paragraphe 3-b du RGPD, votre droit à la suppression de vos données
							personnelles est limité et les demandes de suppression de données ne seront pas recevables.
						</p>
						<p>
							Pour toute information complémentaire ou difficulté relative à l’utilisation de vos données, vous pouvez
							contacter notre délégué à la protection des données (DPO) à l’adresse suivante :dpo@excellcium.fr. En cas
							de difficulté non résolue, vous pouvez saisir la CNIL. Si votre demande ne concerne pas le traitement de
							vos données personnelles, votre email ne sera pas traité. Pour toute autre demande, veuillez envoyer un
							email à contact@excellcium.fr.
						</p>
						<p>
							Dans le cadre du présent formulaire, vous pourrez être amené(e) à transmettre des informations sur des
							personnes physiques. Vous vous engagez à porter la présente mention d’information à la connaissance de
							chaque personne physique concernée.
						</p>
					</section>
				</div>
      </div>

      <div class="row">
        <div class="col-12">
          <ul class="actions pt-6" style="justify-content: center;">
            <li><a class="button accent6" href="<?php echo esc_attr(get_site_link()); ?>">Retour à l'accueil</a></li>
            <li><a class="button accent6" href="<?php echo esc_attr(get_page_link('inscription')); ?>">S'inscrire au registre</a></li>
          </ul>
        </div>
      </div>

		</section>

<?php view('parts.page_footer'); ?>

  </div>
