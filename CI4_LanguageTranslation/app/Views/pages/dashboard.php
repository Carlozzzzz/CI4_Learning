<?= $this->extend('template/main')?>

<?= $this->section('content') ?>

	<div class="pagetitle">
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
				<li class="breadcrumb-item">Sample</li>
				<li class="breadcrumb-item active">My Dashboard</li>
			</ol>
		</nav>
	</div>

	<section class="section dashboard">
		<div class="row">
			<div class="col-lg-12">
				<div class="card info-card sales-card">
					<div class="filter">
						<a class="icon" href="#" data-bs-toggle="dropdown"><span class="small me-1 fw-bold">Action</span><i class="bi bi-three-dots-vertical"></i></a>
						<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
							<li class="dropdown-header text-start">
								<h6>Action</h6>
							</li>

							<li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/addnew" role="button" onclick="$.blockUI();"><i class="bi bi-plus-lg"></i> Add new</a></li>
							<li><a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#frmmodalimportlistform"><i class="bi bi-upload"></i> Upload List</a></li>
							<li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/downloadlist" target="_blank"><i class="bi bi-download"></i> Download List</a></li>
							<li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/generatelisttemplate" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i> Generate Template</a></li>
						</ul>
					</div>
					<div class="card-body mb-0">
						<h5 class="card-title-nopad mt-3 mb-0">Subject List</h5>
						<div class="table-responsive">
							<table class="table datatable table-striped table-hover small">
								<thead>
									<tr>
										<th class="text-left not-sortable" scope="col">
											<div class="form-check form-switch small align-end m-0">
												<input type="checkbox" class="form-check-input" role="switch" onchange="viewactive(this);" <?= $data_isactive == 1 ? "checked" : "";?> id="txtcheckactive" data-toggle="tooltip" title="Tick to view <?= $data_isactive == 1 ? "Inactive" : "Active";?> Group">
												<small>No.</small>
											</div>
										</th>
										<th class="text-left" scope="col"><small>Grade Level</small></th>
										<th class="text-left" scope="col"><small>Strand</small></th>
										<th class="text-left" scope="col"><small>Subject</small></th>
										<th class="text-left" scope="col"><small>Description</small></th>
										<th class="text-center not-sortable" scope="col"><small>Action</small></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(isset($data_datatablefile) && count($data_datatablefile) > 0)
										{
											$xobj = "";
											foreach ($data_datatablefile as $key => $value)
											{
												$xobj .= "<tr>";
													$xobj .= "<td class=\"align-middle\"><input type=\"checkbox\" ".($value['isactive'] == 1 ? "checked" : "")." data-toggle=\"tooltip\" title=\"".($value['isactive'] == 1 ? "Active" : "Inactive")."\" id=\"{$value['encryptid']}\" onchange=\"active(this);\"> <small>{$value['subjectid']}</small></td>";
													$xobj .= "<td class=\"align-middle\"><small>{$value['gradelevel']}</small></td>";
													$xobj .= "<td class=\"align-middle\"><small>{$value['strand']}</small></td>";
													$xobj .= "<td class=\"align-middle\"><small>{$value['subject']}</small></td>";
													$xobj .= "<td class=\"align-middle\"><small>{$value['subjectdesc']}</small></td>";

													$xobj .= "<td class=\"text-center align-middle\">";
														$xobj .= "<div class=\"btn-group\" role=\"group\">";
															$xobj .= "<a href=\"".base_url()."{$data_activepage}/edit/{$value['encryptid']}\" onclick=\"$.blockUI();\" role=\"button\" class=\"btn btn-sm btn-success\" data-toggle=\"tooltip\" title=\"Edit\"><i class=\"bi bi-pencil\"></i></a>";
															$xobj .= "<button type=\"button\" class=\"btn btn-sm btn-danger\" data-toggle=\"tooltip\" title=\"Delete\" onclick=\"Delete(this);\" id=\"{$value['encryptid']}\"><i class=\"bi bi-trash\"></i></button>";
														$xobj .= "</div>";
													$xobj .= "</td>";
												$xobj .= "</tr>";
											}
											echo $xobj;
										}
									?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="modal fade" id="frmmodalimportlistform" tabindex="-1">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<form name="myimportform" id="myimportform" class="needs-validation upload" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate>
					<div class="modal-header">
						<h5 class="modal-title"><i class="bi bi-upload"></i> Upload List</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row g-3">
							<div class="col-lg-12">
								<input type="file" name="txtfileimport" id="txtfileimport" class="form-control form-control-sm" placeholder="Your File" required>
								<div class="invalid-tooltip">
									Please select a file.
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-secondary">Clear</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

	<script type="text/javascript">
        const baseUrl = "<?=base_url() ?>";

        $(document).ready(function() {

            initializeLanguageSettings();
            
            // Reinitialize the language when sorting table
            $('table.dataTable thead th').on('click', function() {
                initializeLanguageSettings();
            });

            // Onchange event for switching language
            const languageSelect = document.getElementById("languageSelect");
            $(languageSelect).on("change", function() {
                Swal.fire({
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                        Swal.getContainer().style.pointerEvents = 'none'; // Disable user input
                    }
                });

                let language = languageSelect.value;
                (async () => {
                    console.log("Initializing : " + language);
                    await updateUserLanguage(language);
                    await updatePageLanguage(language);
                    await closeSwal();
                })();

            });
        });

	</script>

<?= $this->endSection() ?>
