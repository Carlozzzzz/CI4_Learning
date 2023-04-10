<?= $this->extend('template/main') ?>

<?= $this->section('content')?>
    <div class="pagetitle">
        <nav class="float-end">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
            <li class="breadcrumb-item">Schedule</li>
            <li class="breadcrumb-item">Subject File</li>
            <li class="breadcrumb-item active"><?= isset($data_recordfile[0]['subjectid']) && $data_recordfile[0]['subjectid'] != "" ? "Edit" : "Add"; ?> Subject</li>
        </ol>
        </nav>
        <h1>Subject File</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= isset($data_recordfile[0]['subjectid']) && $data_recordfile[0]['subjectid'] != "" ? "Edit" : "Add"; ?> subject</h5>
                        <form name="myform" id="myform" class="row g-4 needs-validation <?= isset($data_recordfile[0]['subjectid']) && $data_recordfile[0]['subjectid'] != "" ? "update" : "save"; ?>" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate>
                            <!-- <div class="col-lg-12">
                                <div class="form-floating">
                                    <select name="txtfld[gradelevelid]" id="txtgradelevelid" class="form-control form-control-sm" placeholder="Gade Level" required onchange="changeselect(this);">
                                        <option value="">Select here...</option>
                                        <?php //foreach ($data_gradelevelfile as $key => $value): ?>
                                        <option value="<?//= $value['encryptid'];?>" <?//= isset($data_recordfile[0]['gradelevelid']) && $data_recordfile[0]['gradelevelid'] == $value['gradelevelid'] ? "selected" : "";?>><?//= $value['gradelevel'];?></option>
                                        <?php //endforeach ?>
                                    </select>
                                    <label for="txtgradelevelid"><small>Grade Level</small></label>
                                    <div class="invalid-tooltip">
                                        Please provide Grade Level.
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" name="txtfld[subject]" id="txtsubject" class="form-control form-control-sm" placeholder="Subject" value="<?= isset($data_recordfile[0]['subject']) && $data_recordfile[0]['subject'] != "" ? $data_recordfile[0]['subject'] : "";?>" required>
                                    <label for="txtcategory"><small>Subject</small></label>
                                    <div class="invalid-tooltip">
                                        Please provide a subject.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <textarea name="txtfld[description]" id="txtdescription" class="form-control form-control-sm" placeholder="Subject Description" style="height: 100px;"><?= isset($data_recordfile[0]['description']) && $data_recordfile[0]['description'] != "" ? $data_recordfile[0]['description'] : "";?></textarea>
                                    <label for="txtdescription"><small>Subject description</small></label>
                                </div>
                            </div>
                            <div class="text-center g-3">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="cancel();">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        function save(){
            Swal.fire({
                title: "Are you sure?",
                text: "You want to submit this record?",
                icon: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, submit it!",
            }).then((result) => {
                if(result.value)
                {
                    $.blockUI();
                    if(checkhassession())
                    {
                        xdata = jQuery("#myform").serialize();
                        jQuery.ajax({
                            url: "<?= base_url().$data_activepage?>/submitsave",
                            method: "POST",
                            data: xdata,
                            dataType: "JSON", 
                            success: function(xret){
                                $.unblockUI();
                                if(xret.bool)
                                {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Your work has been saved',
                                        text: xret.msg,
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        if(result.value)
                                        {
                                            $.blockUI();
                                            window.location.href = "<?= base_url().$data_activepage?>";
                                        }
                                    });
                                }
                                else if(xret.bool == false)
                                {
                                    Swal.fire({
                                    icon: 'error',
                                    title: xret.msg,
                                    allowOutsideClick: false
                                    });
                                }
                            }

                        });
                    }
                }
            });
        }

        function update(){
            Swal.fire({
                title: "Are you sure?",
                text: "You want to submit the record?",
                icon: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, submit!",
            }).then((result) => {
                if(result.value)
                {
                    $.blockUI();
                    if(checkhassession())
                    {
                        xdata = jQuery("#myform").serialize();
                        jQuery.ajax({
                            url: "<?= base_url().$data_activepage; ?>/submitupdate/<?= isset($data_recordfile[0]['encryptid']) && $data_recordfile[0]['encryptid'] != "" ? $data_recordfile[0]['encryptid'] : "" ?>",
                            method: "POST",
                            data: xdata,
                            dataType: "JSON",
                            success: function(xret){
                                $.unblockUI();
                                if(xret.bool)
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Your work has been saved!",
                                        text: xret.msg,
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        if(result.value)
                                        {
                                            window.location.href = "<?= base_url().$data_activepage?>";
                                        }
                                    });
                                }
                                else if(xret.bool == false)
                                {
                                    Swal.fire({
                                        icon: "error",
                                        title: xret.msg,
                                        allowOutsideClick: false,
                                    });
                                }
                            },
                        });
                    }
                    else
                    {
                        window.location.href = "<?= base_url(); ?>template/errorpage";
                    }
                }
            });
        }

        function cancel(){
            Swal.fire({
                title: "Are you sure?",
                text: "You want to leave this page?",
                icon: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, discard it!",
            }).then((result) => {
                if(result.value)
                {
                    $.blockUI();
                    window.location.href = "<?= base_url().$data_activepage?>";
                }
            });
        }

        
    </script>
<?= $this->endSection(); ?>