<?= $this->extend('template/main') ?>

<?= $this->section('content')?>
    <div class="pagetitle">
        <nav class="float-end">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item">Accounts</li>
            <li class="breadcrumb-item">Teacher Account</li>
            <li class="breadcrumb-item active"><?= isset($data_recordfile[0]['teacherid']) && $data_recordfile[0]['teacherid'] != "" ? "Edit" : "Add"; ?> Teacher Account</li>
            </ol>
        </nav>
        <h1>Teacher Account</h1>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title "><?= isset($data_recordfile[0]['teacherid']) && $data_recordfile[0]['teacherid'] != "" ? "Edit" : "Save" ?> Teacher Account</h5>
                        <form name="myform" id="myform" 
                            class="row g-4 needs-validation <?= isset($data_recordfile[0]['teacherid']) && $data_recordfile[0]['teacherid'] != "" ? "update" : "save" ?>" 
                            method="POST"
                            autocomplete="off"
                            enctype="multipart/form-data" novalidate>

                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" name="txtfld[lastname]" id="txtlastname" 
                                            class="form-control form-control-sm" placeholder="Your Last Name"
                                            value="<?= isset($data_recordfile[0]['lastname']) && $data_recordfile[0]['lastname'] != "" ? $data_recordfile[0]['lastname'] : ""?>"
                                            required>
                                    <label for="txtlastname"><small>Last Name</small></label>
                                    <div class="invalid-tooltip">
                                        Please provide a Last Name
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" name="txtfld[firstname]" id="txtfirstname"
                                            class="form-control form-control-sm" placeholder="Your First Name"
                                            value="<?= isset($data_recordfile[0]['firstname']) && $data_recordfile[0]['firstname'] ? $data_recordfile[0]['firstname'] : ""?>"
                                            required>
                                    <label for="txtfirstname"><small>First Name</small></label>
                                    <div class="invalid-tooltip">
                                        Please provide a First name
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" name="txtfld[middlename]" id="txtmiddlename"
                                            class="form-control form-control-sm" placeholder="Your Middle Name"
                                            value="<?= isset($data_recordfile[0]['middlename']) && $data_recordfile[0]['middlename'] ? $data_recordfile[0]['middlename'] : ""?>">
                                    <label for="txtmiddlename"><small>Middle Name</small></label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="text" name="txtfld[suffix]" id="txtsuffix"
                                            class="form-control form-control-sm" placeholder="Your Suffix"
                                            value="<?= isset($data_recordfile[0]['suffix']) && $data_recordfile[0]['suffix'] ? $data_recordfile[0]['suffix'] : ""?>">
                                    <label for="txtsuffix"><small>Suffix</small></label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating">
                                    <input type="email" name="txtfld[email]" id="txtemail"
                                            class="form-control form-control-sm" placeholder="Your Email"
                                            value="<?= isset($data_recordfile[0]['email']) && $data_recordfile[0]['email'] ? $data_recordfile[0]['email'] : ""?>"
                                            required>
                                    <label for="txtemail"><small>Email</small></label>
                                    <div class="invalid-tooltip">
                                        Please provide a Email
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