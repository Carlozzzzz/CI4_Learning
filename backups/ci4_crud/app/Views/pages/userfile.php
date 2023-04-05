<?= $this->extend('template/main') ?>

<?= $this->section('content')?>

    <div class="pagetitle">
        <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url();?>dashboard" onclick="$.blockUI();">Dashboard</a></li>
            <li class="breadcrumb-item">System</li>
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active">User Account</li>
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
                            <!-- <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/insert" role="button" ><i class="bi bi-plus-lg"></i> Insert</a></li> -->
                            <!-- <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/update/5" role="button" ><i class="bi bi-plus-lg"></i> update</a></li> -->
                            <li><a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#frmmodalimportlistform"><i class="bi bi-upload"></i> Upload List</a></li>
                            <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/downloadlist" target="_blank"><i class="bi bi-download"></i> Download List</a></li>
                            <li><a class="dropdown-item" href="<?= base_url().$data_activepage;?>/generatelisttemplate" target="_blank"><i class="bi bi-file-earmark-arrow-down"></i> Generate Template</a></li>
                            </ul>
                        </div>
                        <div class="card-body mt-5">
                            <div class="table-responsive">
                                <table class="table datatable table-striped table-hover small">
                                    <thead>
                                        <tr>
                                        <th class="text-left not-sortable" scope="col">
                                            <div class="form-check form-switch small align-end m-0">
                                                <input type="checkbox" class="form-check-input" role="switch" onchange="viewactive(this);" <?= $data_isactive == 1 ? "checked" : "";?> id="txtcheckactive" data-toggle="tooltip" title="Tick to view <?= $data_isactive == 1 ? "Inactive" : "Active";?> User Account">
                                                <small>No.</small>
                                            </div>
                                        </th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  foreach($data_recordfile as $key => $value) :?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="<?= $value['encryptid']; ?>""
                                                            onchange="active(this);"
                                                            <?= $value['isactive'] == 1 ? "checked" : ""; ?> 
                                                            data-toggle="tooltip" title="<?= $value['isactive'] == 1 ? "Active" : "Inactive" ?>">
                                                    <small><?= $value['userid']?></small>
                                                </td>
                                                <td class="align-middle">
                                                    <small>
                                                        <?= "{$value['lastname']} {$value['suffix']}, {$value['firstname']} {$value['middlename']}" ?>
                                                    </small>
                                                </td>
                                                <td class="align-middle"><small><?= $value['email']?></small></td>
                                                <td class="align-middle"><small><?= $value['username']?></small></td>
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
                </div>
            </div>
        </section>

       
        <script>
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
                                            alowedOutsideClick: false,
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

                    }
                    else
                    {
                        window.location.href = "<?= base_url()?>template/errorfile";
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
                            console.log(idno);
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