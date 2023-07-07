<?php

if (!defined('ENV')) die();

$p_current = get_current_page();
$data = [];

global $DBConn;
if ($DBConn) {
	$r = $DBConn->query("SELECT c.name as cluster_name, b.name as bu_name, bc.* FROM my_cluster c, my_bu b, my_cluster_bu bc WHERE bc.cluster = c.id AND bc.bu = b.id;");
	if ($r) {
		foreach ($r as $row) {
			$data[] = $row;
		}
	}
}

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
							<th>Cluster</th>
							<th>C.id</th>
							<th>BU</th>
							<th>B.id</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($data as $row) : ?>
						<tr>
							<td><?php echo htmlentities($row['id'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['cluster_name'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['cluster'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['bu_name'] ?? ''); ?></td>
							<td><?php echo htmlentities($row['bu'] ?? ''); ?></td>
						</tr>
						<?php endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<th>#ID</th>
							<th>Cluster</th>
							<th>C.id</th>
							<th>BU</th>
							<th>B.id</th>
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
