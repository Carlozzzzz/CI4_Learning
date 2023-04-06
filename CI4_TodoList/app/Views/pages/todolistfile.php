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

        <div class="container">
            <div class="item" draggable="true">Item 1</div>
            <div class="item" draggable="true">Item 2</div>
            <div class="item" draggable="true">Item 3</div>
            <div class="item" draggable="true">Item 4</div>
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

        jQuery(document).ready({
            const items = document.querySelectorAll('.item');
            let draggedItem = null;

            // Add event listeners for each item
            items.forEach(item => {
            item.addEventListener('dragstart', function() {
                draggedItem = this;
                setTimeout(() => {
                this.style.display = 'none';
                }, 0);
            });

            item.addEventListener('dragend', function() {
                setTimeout(() => {
                draggedItem.style.display = 'block';
                draggedItem = null;
                }, 0);
            });
            });

            // Add event listeners for container
            const container = document.querySelector('.container');

            container.addEventListener('dragover', function(e) {
            e.preventDefault();
            const afterElement = getDragAfterElement(container, e.clientY);
            const draggable = document.querySelector('.dragging');
            if (afterElement == null) {
                container.appendChild(draggable);
            } else {
                container.insertBefore(draggable, afterElement);
            }
            });

            // Function to get element being dragged after the element it is dropped on
            function getDragAfterElement(container, y) {
            const draggableElements = [...container.querySelectorAll('.item:not(.dragging)')];
            return draggableElements.reduce((closest, child) => {
                const box = child.getBoundingClientRect();
                const offset = y - box.top - box.height / 2;
                if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
                } else {
                return closest;
                }
            }, { offset: Number.NEGATIVE_INFINITY }).element;
            }

        });
    </script>
<?= $this->endSection(); ?>