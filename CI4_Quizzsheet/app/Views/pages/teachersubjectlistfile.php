<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

    <div class="pagetitle">
        
        <?php if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin") :?>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
                    <li class="breadcrumb-item">System</li>
                    <li class="breadcrumb-item">Academics</li>
                    <li class="breadcrumb-item"><a href="<?= base_url();?>assignsubjectfile" onclick="$.blockUI();">Assign Subject</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url();?>/teachersubjectlistfile/viewteachers" onclick="$.blockUI();">Teacher</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                    <?//= $data_teacherid?>
    
                </ol>
            </nav>
        <?php elseif(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "teacher") :?>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
                    <li class="breadcrumb-item">My Subjects</li>
                    <li class="breadcrumb-item active">Subjects</li>
                    <?//= $data_teacherid?>
    
                </ol>
            </nav>
        <?php endif;?>

        <?php if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin") :?>
        <?php elseif(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "teacher") :?>
        <?php endif;?>

    </div>

    <style>
        .cover
        {
            height: 150px;
        }

        .hover
        {
            cursor: pointer;
        }

    </style>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                
                <?php if(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "admin") :?>
                    <div class="card info-card sales-card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><span class="small me-1 fw-bold">Action</span><i class="bi bi-three-dots-vertical"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Action</h6>
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/addnew/<?= isset($data_teacherid) && $data_teacherid != "" ? $data_teacherid : "" ?>" role="button" onclick="$.blockUI();"><i class="bi bi-plus-lg"></i> Add new</a></li>
                                <!-- <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/viewlistpdf" target="_blank" ><i class="bi bi-file-earmark"></i> View Pdf</a></li> -->
                                <!-- <li><a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#frmmodalimportlistform"><i class="bi bi-upload"></i> Upload List</a></li> -->
                                <!-- <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/downloadlist" target="_blank"><i class="bi bi-download"></i> Download List</a></li> -->
                                <!-- <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/generatelisttemplate" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i> Generate Template</a></li> -->
                            </ul>
                        </div>
                        <div class="card-body mt-5">
                            <div class="table-responsive">
                                <table class="table datatable table-striped table-hover small">
                                    <thead>
                                        <tr>
                                            <th class="text-left not-sortable" scope="col">
                                                <div class="form-check form-switch small align-end m-0">
                                                    <input type="checkbox" class="form-check-input" role="switch" onchange="viewactive(this);" <?= $data_isactive == 1 ? "checked" : "";?> id="txtcheckactive" data-toggle="tooltip" title="Tick to view <?= $data_isactive == 1 ? "Inactive" : "Active";?> Teacher Subjects" disabled>
                                                    <small>No.</small>
                                                </div>
                                            </th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  foreach($data_recordfile as $key => $value) :?>
                                            <tr>
                                                <td><small><?= $value['teachersfid']?></small></td>
                                                <td class="align-middle"><small><?= $value['subject']?></small></td>
                                                <td>
                                                    <a href="<?= base_url().$data_activepage; ?>/edit/<?= $value['encryptid']; ?>" onclick="$.blockUI();" role="button" class="btn btn-sm btn-success text-white" data-toggle="tooltip" title="Edit"><i class="bi bi-pencil"></i></a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete" onclick="Delete(this);" id="<?= $value['encryptid']; ?>"><i class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php  endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php elseif(session()->has('ci4_usertype') && session()->get('ci4_usertype') == "teacher") :?>
                    <div class="card info-card sales-card">
                        <div class="card-header px-2 py-5">
                            <h3 class="px-1">My Courses</h3>
                        </div>
                        <div class="card-body">
                            <div class="row p-0">
                                <?php foreach($data_recordfile as $key => $value) :?>
                                    <div class="item col-xs-12 col-sm-6 col-lg-4 p-0 px-1">
                                        <div class="panel panel-default">
                                            <div class="cover overlay cover-image-full hover d-flex align-items-center justify-content-center bg-secondary text-light">
                                                <i class="bi bi-mortarboard fs-2"></i>
                                            </div>
                                            <div class="panel-body p-3">
                                                <h3 class="panel-title"><?= $value['subject'];?></h3>
                                            </div>
                                            <hr class="margin-none">
                                            <div class="panel-body p-3 ">
                                                <button class="btn btn-white btn-flat paper-shadow relative fw-bold"><span class="me-2"><i class="bi bi-pencil"></i></span>Edit Subjects</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php  endforeach;?>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </section>
    
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
                                        window.location.href = "<?= base_url().$data_activepage?>/assignsubject/<?= $data_teacherid ?>";
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