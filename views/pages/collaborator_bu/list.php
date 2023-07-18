<?php

if (!defined('ENV')) die();

$p_current = get_current_page();
$data = [];

global $DBConn;
if ($DBConn) {
	$r = $DBConn->query("SELECT CONCAT(c.firstname, ' ', c.lastname) as collaborator_name, b.name as bu_name, s.label as status_name, bc.* FROM my_collaborator c, my_bu b, my_status_type s, my_bu_collaborator bc WHERE bc.collaborator = c.id AND bc.bu = b.id AND bc.status = s.id;");
	if ($r) {
		foreach ($r as $row) {
			$data[] = $row;
		}
	}
}

$uri_edit = get_site_link(preg_replace('/list$/', 'edit', get_current_uri()));

?>
	<div id="page-wrapper">

<?php view('parts.page_header'); ?>

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
							<th>BU</th>
							<th>B.id</th>
							<th>Collaborator</th>
							<th>C.id</th>
							<th>Status</th>
							<th>S.id</th>
							<th>Created</th>
							<th>Modified</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($data as $row) : ?>
						<tr>
							<td><a href="<?php echo $uri_edit.'/'.htmlentities($row['id'] ?? ''); ?>"><?php echo htmlentities($row['id'] ?? ''); ?></a></td>
							<td><?php echo htmlentities($row['bu_name'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['bu'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['collaborator_name'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['collaborator'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['status_name'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['status'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['creation_at'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['modified_at'] ?? ''); ?></td>
						</tr>
						<?php endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<th>#ID</th>
							<th>BU</th>
							<th>B.id</th>
							<th>Collaborator</th>
							<th>C.id</th>
							<th>Status</th>
							<th>S.id</th>
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
	$("#example1_filter").append($('<a href="{$uri_edit}" class="btn btn-primary ml-3" title="New"><span class="fa fa-plus"></span></a>'));
</script>
END;
?>

	</div>
