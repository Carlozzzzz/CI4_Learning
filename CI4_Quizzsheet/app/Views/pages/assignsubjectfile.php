<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

    <div class="pagetitle">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item">Academics</li>
            <li class="breadcrumb-item active">Assign Subject</li>
        </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card ">
                    <div class="card-body">
                        <h5 class="card-title ">Assign Subject</h5>
                        <div class="d-flex">
                            <a class="text-light" href="<?= base_url()?>teachersubjectlistfile/viewteachers">
                                <div class="d-flex p-4 m-2 color-2 rounded fw-bold">
                                Teacher's Subjects
                                </div>
                            </a>
                            <a class="text-light" href="<?= base_url() ?>studentsubjectlistfile/viewstudents">
                                <div class="d-flex p-4 m-2 color-1 rounded fw-bold">
                                    Student's Subjects
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    
    <!-- <button class="btn btn-success upload" onclick="test();">test</button> -->


<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
       
    <script type="text/javascript">
        
        function upload(){
            Swal.fire({
                title: "Are you sure",
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
                        var xdata = new FormData($("#myimportform")[0]);
                        jQuery.ajax({
                            url : "<?= base_url() . $data_activepage; ?>/uploadlist",
                            method : "POST",
                            data : xdata,
                            dataType : "JSON",
                            contentType: false,
                            processData: false,
                            success : function(xret){
                            $.unblockUI();
                            if(xret.bool)
                            {
                                jQuery("#frmmodalimportlistform").modal('toggle');
                                Swal.fire({
                                    width: 1000,
                                    icon: 'success',
                                    title: 'Success',
                                    allowOutsideClick: false,
                                    showCancelButton: false,
                                    confirmButtonText: "Okay",
                                    showConfirmButton: true,
                                    showLoaderOnConfirm: true,
                                    preConfirm: function() {
                                        return new Promise(function(resolve) {
                                            $.blockUI();
                                            window.location.href = "<?= base_url().$data_activepage;?>";
                                        });
                                    },
                                    html: xret.msg
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
                            },
                        });
                    }
                    else
                    {
                        window.location.href = "<?= base_url(); ?>index.php/errorpage";
                    }
                }
            });

        }

        function Delete(obj){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't undo this!",
                icon: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if(result.value)
                {
                    $.blockUI();
                    if(checkhassession())
                    {
                        var idno = jQuery(obj).attr("id");
                        var xdata = "&idno="+encodeURI(idno);
                        jQuery.ajax({
                            url: "<?= base_url().$data_activepage?>/submitdelete",
                            method: "POST",
                            data: xdata,
                            dataType: "JSON",
                            success : function(xret){
                                console.log(xret);
                                $.unblockUI();
                                if(xret.bool)
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: 'Your work has been saved',
                                        text: xret.msg,
                                        allowOutsideClick: false,
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
                                        icon: "error",
                                        title: xret.msg,
                                        allowedOutsideClick: false
                                    });
                                }
                            },
                        });
                    }
                    else
                    {
                        window.location.href = "<?= base_url(); ?>index.php/errorpage";
                    }

                }
            });
        }

        function active(obj)
        {
            var xisactive = 1;
            var xlabel = "";
            if(jQuery(obj).is(":checked") == true)
            {
                isactive = 1;
                xlabel = "Active";
            }
            else
            {
                isactive = 0;
                xlabel = "Inactive";
            }

            Swal.fire({
                title: "Are you sure?",
                text: "You want to set this section to "+xlabel+" status?",
                icon: "warning",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, set it!",
            }).then((result) => {
                if(result.value)
                {
                    $.blockUI();
                    if(checkhassession())
                    {
                        var idno = jQuery(obj).attr("id");
                        // console.log(idno);
                        var xdata = "&txtfld[isactive]="+isactive;
                        jQuery.ajax({
                            url: "<?= base_url().$data_activepage;?>/submitupdate/"+idno,
                            method: "POST",
                            data: xdata,
                            dataType: "JSON",
                            success : function(xret){
                                $.unblockUI();
                                if(xret.bool)
                                {
                                    Swal.fire({
                                        title: "Your work has been saved!",
                                        icon: "success",
                                        text: xret.msg,
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        if(result.value)
                                        {
                                            $.blockUI();
                                            window.location.href = "<?= base_url().$data_activepage;?><?= $data_isactive == 1 ? "": "/index/0"?>";
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
                        window.location.href = "<?= base_url();?>template/errorpage";
                    }
                }
                else
                {
                    if(jQuery(obj).is(":checked") == true)
                    {
                        jQuery(obj).prop("checked", false);
                    }
                    else
                    {
                        jQuery.prop("checked", true);
                    }
                }
            });
        }
    </script>
        
<?= $this->endSection(); ?>