<?php

if (!defined('ENV')) die();

$p_current = get_current_page();

/*
global $DBConn;
if ($DBConn) :
	$stmt = sqlsrv_prepare($DBConn, "SELECT * FROM `dbo`.`my_bu`;");
	$rq = sqlsrv_execute($stmt);
endif;


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
					
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Rendering engine</th>
							<th>Browser</th>
							<th>Platform(s)</th>
							<th>Engine version</th>
							<th>CSS grade</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Trident</td>
							<td>Internet
								Explorer 4.0
							</td>
							<td>Win 95+</td>
							<td> 4</td>
							<td>X</td>
						</tr>
						<tr>
							<td>Trident</td>
							<td>Internet
								Explorer 5.0
							</td>
							<td>Win 95+</td>
							<td>5</td>
							<td>C</td>
						</tr>
						<tr>
							<td>Trident</td>
							<td>Internet
								Explorer 5.5
							</td>
							<td>Win 95+</td>
							<td>5.5</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Trident</td>
							<td>Internet
								Explorer 6
							</td>
							<td>Win 98+</td>
							<td>6</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Trident</td>
							<td>Internet Explorer 7</td>
							<td>Win XP SP2+</td>
							<td>7</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Trident</td>
							<td>AOL browser (AOL desktop)</td>
							<td>Win XP</td>
							<td>6</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Firefox 1.0</td>
							<td>Win 98+ / OSX.2+</td>
							<td>1.7</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Firefox 1.5</td>
							<td>Win 98+ / OSX.2+</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Firefox 2.0</td>
							<td>Win 98+ / OSX.2+</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Firefox 3.0</td>
							<td>Win 2k+ / OSX.3+</td>
							<td>1.9</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Camino 1.0</td>
							<td>OSX.2+</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Camino 1.5</td>
							<td>OSX.3+</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Netscape 7.2</td>
							<td>Win 95+ / Mac OS 8.6-9.2</td>
							<td>1.7</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Netscape Browser 8</td>
							<td>Win 98SE+</td>
							<td>1.7</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Netscape Navigator 9</td>
							<td>Win 98+ / OSX.2+</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.0</td>
							<td>Win 95+ / OSX.1+</td>
							<td>1</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.1</td>
							<td>Win 95+ / OSX.1+</td>
							<td>1.1</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.2</td>
							<td>Win 95+ / OSX.1+</td>
							<td>1.2</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.3</td>
							<td>Win 95+ / OSX.1+</td>
							<td>1.3</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.4</td>
							<td>Win 95+ / OSX.1+</td>
							<td>1.4</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.5</td>
							<td>Win 95+ / OSX.1+</td>
							<td>1.5</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.6</td>
							<td>Win 95+ / OSX.1+</td>
							<td>1.6</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.7</td>
							<td>Win 98+ / OSX.1+</td>
							<td>1.7</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Mozilla 1.8</td>
							<td>Win 98+ / OSX.1+</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Seamonkey 1.1</td>
							<td>Win 98+ / OSX.2+</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Gecko</td>
							<td>Epiphany 2.20</td>
							<td>Gnome</td>
							<td>1.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Webkit</td>
							<td>Safari 1.2</td>
							<td>OSX.3</td>
							<td>125.5</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Webkit</td>
							<td>Safari 1.3</td>
							<td>OSX.3</td>
							<td>312.8</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Webkit</td>
							<td>Safari 2.0</td>
							<td>OSX.4+</td>
							<td>419.3</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Webkit</td>
							<td>Safari 3.0</td>
							<td>OSX.4+</td>
							<td>522.1</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Webkit</td>
							<td>OmniWeb 5.5</td>
							<td>OSX.4+</td>
							<td>420</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Webkit</td>
							<td>iPod Touch / iPhone</td>
							<td>iPod</td>
							<td>420.1</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Webkit</td>
							<td>S60</td>
							<td>S60</td>
							<td>413</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera 7.0</td>
							<td>Win 95+ / OSX.1+</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera 7.5</td>
							<td>Win 95+ / OSX.2+</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera 8.0</td>
							<td>Win 95+ / OSX.2+</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera 8.5</td>
							<td>Win 95+ / OSX.2+</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera 9.0</td>
							<td>Win 95+ / OSX.3+</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera 9.2</td>
							<td>Win 88+ / OSX.3+</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera 9.5</td>
							<td>Win 88+ / OSX.3+</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Opera for Wii</td>
							<td>Wii</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Nokia N800</td>
							<td>N800</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Presto</td>
							<td>Nintendo DS browser</td>
							<td>Nintendo DS</td>
							<td>8.5</td>
							<td>C/A<sup>1</sup></td>
						</tr>
						<tr>
							<td>KHTML</td>
							<td>Konqureror 3.1</td>
							<td>KDE 3.1</td>
							<td>3.1</td>
							<td>C</td>
						</tr>
						<tr>
							<td>KHTML</td>
							<td>Konqureror 3.3</td>
							<td>KDE 3.3</td>
							<td>3.3</td>
							<td>A</td>
						</tr>
						<tr>
							<td>KHTML</td>
							<td>Konqureror 3.5</td>
							<td>KDE 3.5</td>
							<td>3.5</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Tasman</td>
							<td>Internet Explorer 4.5</td>
							<td>Mac OS 8-9</td>
							<td>-</td>
							<td>X</td>
						</tr>
						<tr>
							<td>Tasman</td>
							<td>Internet Explorer 5.1</td>
							<td>Mac OS 7.6-9</td>
							<td>1</td>
							<td>C</td>
						</tr>
						<tr>
							<td>Tasman</td>
							<td>Internet Explorer 5.2</td>
							<td>Mac OS 8-X</td>
							<td>1</td>
							<td>C</td>
						</tr>
						<tr>
							<td>Misc</td>
							<td>NetFront 3.1</td>
							<td>Embedded devices</td>
							<td>-</td>
							<td>C</td>
						</tr>
						<tr>
							<td>Misc</td>
							<td>NetFront 3.4</td>
							<td>Embedded devices</td>
							<td>-</td>
							<td>A</td>
						</tr>
						<tr>
							<td>Misc</td>
							<td>Dillo 0.8</td>
							<td>Embedded devices</td>
							<td>-</td>
							<td>X</td>
						</tr>
						<tr>
							<td>Misc</td>
							<td>Links</td>
							<td>Text only</td>
							<td>-</td>
							<td>X</td>
						</tr>
						<tr>
							<td>Misc</td>
							<td>Lynx</td>
							<td>Text only</td>
							<td>-</td>
							<td>X</td>
						</tr>
						<tr>
							<td>Misc</td>
							<td>IE Mobile</td>
							<td>Windows Mobile 6</td>
							<td>-</td>
							<td>C</td>
						</tr>
						<tr>
							<td>Misc</td>
							<td>PSP browser</td>
							<td>PSP</td>
							<td>-</td>
							<td>C</td>
						</tr>
						<tr>
							<td>Other browsers</td>
							<td>All others</td>
							<td>-</td>
							<td>-</td>
							<td>U</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<th>Rendering engine</th>
							<th>Browser</th>
							<th>Platform(s)</th>
							<th>Engine version</th>
							<th>CSS grade</th>
						</tr>
						</tfoot>
					</table>

				</div>
			</div>

		</section>

		<?php view('parts.page_footer'); ?>
<?php
global $inline_scripts;
$site_path = get_site_link('');
$inline_scripts .= <<<END
<!-- DataTables  & Plugins -->
<script src="{$site_path}assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{$site_path}assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{$site_path}assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{$site_path}assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{$site_path}assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{$site_path}assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{$site_path}assets/plugins/jszip/jszip.min.js"></script>
<script src="{$site_path}assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{$site_path}assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{$site_path}assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{$site_path}assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{$site_path}assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Init -->
<script>
	$("#example1").DataTable({
		"responsive": true,
		"lengthChange": false,
		"autoWidth": false,
		"buttons": {
			"class": "btn btn-secondary",
			"name": "secondary",
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}
	}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
END;
?>

	</div>
