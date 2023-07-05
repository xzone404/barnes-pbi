<?php

if (!defined('ENV')) die();

$p_current = get_current_page();
$data = [];

global $DBConn;
if ($DBConn) {
	$r = $DBConn->query("SELECT * FROM my_bu;");
	if ($r) {
		foreach ($r as $row) {
			$data[] = $row;
		}
	}
}
var_dump($data);

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
					
					<?php if (!empty($data)) : ?>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>#ID</th>
							<th>BU Name</th>
							<th>Source</th>
							<th>ID source</th>
							<th>Active</th>
							<th>Created</th>
							<th>Modified</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Trident</td>
							<td>Internet Explorer 4.0</td>
							<td>Win 95+</td>
							<td> 4</td>
							<td>X</td>
							<td>X</td>
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
							<td>C</td>
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
							<td>A</td>
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
							<td>A</td>
							<td>A</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
						<th>#ID</th>
							<th>BU Name</th>
							<th>Source</th>
							<th>ID source</th>
							<th>Active</th>
							<th>Created</th>
							<th>Modified</th>
						</tr>
						</tfoot>
					</table>
					<?php else : ?>
					No data found.
					<?php endif; ?>

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
