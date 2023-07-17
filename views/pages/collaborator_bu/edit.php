<?php

if (!defined('ENV')) die();

require_once(PATH_CLASSES . 'Form.php');

global $DBConn;
$_sqldata = [];
if (EDIT_ID > 0) {
	$s = $DBConn->prepare('SELECT * FROM my_bu_collaborator WHERE id = :id ;');
	$s->execute(['id' => EDIT_ID]);
	$r = $s->fetchAll();
	if ($r) {
		foreach ($r as $row) {
			$_sqldata = $row;
			break;
		}
	}
}

$form_register = new Form('my_bu_collaborator', [
	new Field('id', 'int', '#ID', true),

	new Field('collaborator', 'int', 'Collaborator', true),
	new Field('bu', 'int', 'BU', true),
	new Field('status', 'int', 'Status', true),
], ['SQLDATA', 'POST'], $_sqldata);

$collaborators = $DBConn->query('SELECT [id], CONCAT(UPPER([lastname]), \' \', [firstname]) as name FROM [my_collaborator] ORDER BY [lastname] ASC;');
$bus = $DBConn->query('SELECT [id], [name] FROM [my_bu] ORDER BY [name] ASC;');
$status = $DBConn->query('SELECT [id], [label] as name FROM [my_status_type] ORDER BY [id] ASC;');

$errors = $form_register->has_errors() ? $form_register->get_errors() : [];
?>
	<div id="page-wrapper">

<?php view('parts.page_header'); ?>

<?php view('parts.page_banner'); ?>

		<!-- Form -->
		<section id="page-update" class="container">

			<div class="row">

<?php
if ($form_register->is_valid()) :
?>
			</div>
			<div class="row">
				<div class="col-12">
					<p class="success text-center">
						<?php __e('This object has been saved successfully in the datable.'); ?><br/>
						<a href="<?php echo get_site_link(preg_replace('/edit.*$/', 'list', get_current_uri())); ?>" class="btn btn-primary mt-3">
							<span class="fa fa-arrow-left"></span> <?php __e('Back to list'); ?>
						</a>
					</p>
				</div>
			</div>
<?php
else :
?>

				<div class="col-12">
					<p class="text-center">
						<span class="fas fa-triangle-exclamation"></span>
						<?php __e('All fields are required'); ?>
						<span class="fas fa-triangle-exclamation"></span>
					</p>
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

			<form method="POST" action="<?php echo esc_attr(get_page_link(get_current_uri())); ?>" enctype="multipart/form-data">
				<div class="row">
					<input type="hidden" name="_formid_" value="<?php echo $form_register->get_name(); ?>" />
					<input type="hidden" name="_frmctrl_" value="<?php echo $form_register->get_nonce(); ?>" />

					<input type="hidden" name="id" id="id" value="<?php echo EDIT_ID; ?>">


					<div class="col-12">

						<section class="card card-primary shadow-none">
							<div class="card-header">
								<h3><?php if ($form_register->get_field_value('id') != '') { ?>Edit relationship<?php } else { ?>New relationship<?php } ?></h3>
							</div>
							<div class="card-body container">
								<div class="row">
									<div class="col-12">
										<div class="mb-3">
											<label for="collaborator" class="form-label">Collaborator :</label>
											<select class="form-control" name="collaborator" id="collaborator" required>
												<option value="">-</value>
											<?php foreach ($collaborators as $c) : ?>
												<option value="<?php echo htmlentities($c['id']); ?>"<?php if ($form_register->get_field_value_esc('collaborator') == $c['id']) echo ' selected'; ?>><?php echo htmlentities($c['name']); ?></option>
											<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-12">
										<div class="mb-3">
											<label for="bu" class="form-label">BU :</label>
											<select class="form-control" name="bu" id="bu" required>
												<option value="">-</value>
											<?php foreach ($bus as $b) : ?>
												<option value="<?php echo htmlentities($b['id']); ?>"<?php if ($form_register->get_field_value_esc('bu') == $b['id']) echo ' selected'; ?>><?php echo htmlentities($b['name']); ?></option>
											<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-12">
										<div class="mb-3">
											<label for="status" class="form-label">Status :</label>
											<select class="form-control" name="status" id="status" required>
												<option value="">-</value>
											<?php foreach ($status as $s) : ?>
												<option value="<?php echo htmlentities($s['id']); ?>"<?php if ($form_register->get_field_value_esc('status') == $s['id']) echo ' selected'; ?>><?php echo htmlentities($s['name']); ?></option>
											<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</section>

					</div>

				</div>
				<div class="row">

					<div class="col-6 text-left">
						<a href="<?php echo get_site_link(preg_replace('/edit.*$/', 'list', get_current_uri())); ?>" class="d-none d-md-inline-block btn btn-outline-secondary">
							<span class="fa fa-arrow-left"></span> <?php __e('Back to list'); ?>
						</a>
						<?php if (EDIT_ID > 0) { ?>
						<input type="submit" class="btn btn-outline-primary" name="delete" id="delete" value="Delete" onclick="if (!confirm('Are you sure you want to delete this element ?')) return false;" />
						<?php } ?>
					</div>
					<div class="col-6 text-right">
						<input type="submit" class="btn btn-primary" name="send" id="send" value="Submit" />
					</div>

				</div>
			</form>
<?php
endif;
?>

		</section>

		<?php view('parts.page_footer'); ?>

	</div>
