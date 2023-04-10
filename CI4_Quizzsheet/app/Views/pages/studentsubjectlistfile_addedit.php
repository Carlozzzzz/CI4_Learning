<?= $this->extend('template/main') ?>

<?= $this->section('content')?>
    <div class="pagetitle">
        <nav class="float-end">
            <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li> -->
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item">Academics</li>
            <li class="breadcrumb-item"><a href="<?= base_url();?>assignsubjectfile" onclick="$.blockUI();">Assign Subject</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url();?>/teachersubjectlistfile/viewteachers" onclick="$.blockUI();">Student</a></li>
            <li class="breadcrumb-item active"><?= isset($data_recordfile[0]['studentid']) && $data_recordfile[0]['studentid'] != "" ? "Edit" : "Add"; ?> Student Subject</li>
            </ol>
        </nav>
        <h1>Student Account</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title "><?= isset($data_recordfile[0]['studentid']) && $data_recordfile[0]['studentid'] != "" ? "Edit" : "Save" ?> Student Subject</h5>
                        <form name="myform" id="myform" 
                            class="row g-4 needs-validation <?= isset($data_recordfile[0]['studentid']) && $data_recordfile[0]['studentid'] != "" ? "update" : "save" ?>" 
                            method="POST"
                            autocomplete="off"
                            enctype="multipart/form-data" novalidate>
                            
                            <!-- Student Id -->
                            <input type="hidden" name="txtfld[studentid]" value="<?= isset($data_studentid) && $data_studentid != "" ? $data_studentid : "";?>">
                            
                            <!-- Teachers -->
                            <div class="col-lg-6" id="div_teacher">
                                <div class="form-floating">
                                    <select name="txtfld[teacherid]" id="txtteacherid" class="form-control form-control-sm teacher" placeholder="Teacher" required onchange="changeselect(this);">
                                        <option value="">Select here...</option>
                                        <?php foreach ($data_teacherfile as $key => $value): ?>
                                            <option value="<?= $value['encryptid'];?>" <?= isset($data_recordfile[0]['teacherid']) && $data_recordfile[0]['teacherid'] == $value['teacherid'] ? "selected" : "";?>><?= $value['lastname'];?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="txtstrandid"><small>Teacher</small></label>
                                    <div class="invalid-tooltip">
                                        Please provide Subject.
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="col-lg-6" id="div_subject">
                                <div class="form-floating">
                                    <select name="txtfld[subjectid]" id="txtsubjectid" class="form-control form-control-sm subject" placeholder="Subject" required onchange="changeselect(this);">
                                        <option value="">Select here...</option>
                                        <?php foreach ($data_subjectfile as $key => $value): ?>
                                            <option value="<?= $value['subjectid'];?>" <?= isset($data_recordfile[0]['subjectid']) && $data_recordfile[0]['subjectid'] == $value['subjectid'] ? "selected" : "";?>><?= $value['subject'];?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="txtstrandid"><small>Subject</small></label>
                                    <div class="invalid-tooltip">
                                        Please provide Subject.
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
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
                                            window.location.href = "<?= base_url().$data_activepage?>/assignsubject/<?= $data_studentid ?>";
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
                                            window.location.href = "<?= base_url().$data_activepage?>/assignsubject/<?= $data_studentid ?>";
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
                    window.location.href = "<?= base_url().$data_activepage?>/assignsubject/<?= $data_studentid ?>";
                }
            });
        }

        
    </script>
<?= $this->endSection(); ?>