<?= $this->extend('template/main')?>

<?= $this->section('content'); ?>
    <section >
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 mx-auto gy-5 ">
                    <div class="card shadow">
                        <?php
                        if(session()->has('success'))
                        {
                            echo '<div class="alert alert-success mb-0">'.session()->getFlashdata("success").'</div>';
                        }
                        else if(session()->has('error'))
                        {
                            echo '<div class="alert alert-danger mb-0">'.session()->getFlashdata("error").'</div>';
                        }
                        ?>
                        <div class="card-header">
                            <h4 class="card-title">TODO List</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="mb-3 w-100">
                                    <?php if(isset($data_recordfile) && count($data_recordfile) > 0): ?>
                                        <?php $xobj = ""; ?>
                                        <?php foreach($data_recordfile as $key => $value): ?>
                                            <tr>
                                                <td>
                                                    <div class="card  p-2 my-1">
                                                        <form class="d-flex">
                                                            <input class="form-check-input form-check-input-am me-2" type="checkbox" id="<?=$value['recid']?>" onclick="$.blockUI();" onchange="checkofftask(this);" data-toggle="tooltip" title="Check to Finish">
                                                            <small><?= isset($value['title']) ? $value['title'] : ""?></small>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    <?php else: ?>
                                        -- Theres no task --
                                    <?php endif; ?>
                                </table>
                            </div>
                            
                            <form action="<?= base_url().$data_activepage ?>/add" method="POST">
                                <div class="form-floating mb-2">
                                    <input type="text" name="title" id="txttitle" 
                                            class="form-control form-control-sm" placeholder="Your Last Name"
                                            required>
                                    <label for="txttitle"><small>Title</small></label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Add task</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        function checkofftask(obj)
        {
            var status = 0;
            var idno = jQuery(obj).attr("id");
            var xdata = "&txtfld[status]="+status;
            console.log(idno);
            jQuery.ajax({
                url: "<?= base_url().$data_activepage; ?>/checkofftask/" + idno,        
                method: "POST",        
                data: xdata,        
                dataType: "JSON",        
                success : function(xret){
                    $.unblockUI();
                    window.location.href = "<?= base_url().$data_activepage?>";

                    console.log(xret.msg);
                },        
            });
        }

    </script>
<?= $this->endSection(); ?>