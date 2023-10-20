<?= $this->extend('layouts/frontend.php')?>

<?= $this->section('content')?>


<!-- Add Student Data -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <input type="text" id="input_name" class="form-control name" placeholder="Enter your Full Name">
                        <span id="error_name" class="text-danger ms-3"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" id="input_email" class="form-control email" placeholder="Enter your Email">
                        <span id="error_email" class="text-danger ms-3"></span>

                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" id="input_phone" class="form-control phone" placeholder="Enter your Phone">
                        <span id="error_phone" class="text-danger ms-3"></span>

                    </div>
                    <div class="form-group  mb-3">
                        <label for="">Course</label>
                        <input type="text" id="input_course" class="form-control course" placeholder="Enter your Course">
                        <span id="error_course" class="text-danger ms-3"></span>

                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ajaxstudent-save">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- View Single Student Data -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="studentViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student View Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <h4>ID : <span class="id_view"></span></h4>
                <h4>Name : <span class="name_view"></span></h4>
                <h4>Email : <span class="email_view"></span></h4>
                <h4>Phone : <span class="phone_view"></span></h4>
                <h4>Course : <span class="course_view"></span></h4>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Data -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="studentEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="" method="POST">
                    <input type="text" id="edit_id">
                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <input type="text" id="edit_name" class="form-control name" placeholder="Enter your Full Name">
                        <span id="error_name" class="text-danger ms-3"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" id="edit_email" class="form-control email" placeholder="Enter your Email">
                        <span id="error_email" class="text-danger ms-3"></span>

                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" id="edit_phone" class="form-control phone" placeholder="Enter your Phone">
                        <span id="error_phone" class="text-danger ms-3"></span>

                    </div>
                    <div class="form-group  mb-3">
                        <label for="">Course</label>
                        <input type="text" id="edit_course" class="form-control course" placeholder="Enter your Course">
                        <span id="error_course" class="text-danger ms-3"></span>

                    </div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ajaxstudent-update">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Single Student Data -->
<div class="modal fade" id="studentDeleteModal" tabindex="-1" aria-labelledby="studentDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Student Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="stud_delete_id">
                <h4>Do you want to delete this data?</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger ajaxstudent-delete">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 my-4">
        <h1 class="text-center">
            jQuery Ajax crud application - Codeigniter
            <a href="<?= base_url('/home/test') ?>">link</a>
        </h1>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="float-start">jQuery Ajax CRUD - Student Data</h4>
                <a href="#" data-bs-toggle="modal" data-bs-target="#studentModal" class="btn btn-primary float-end">Add</a>
            </div>
            
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="student-list">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection()?>

<?= $this->section('scripts') ?>

<script>
    /**
     * Initial call form students
     */
    $(document).ready(function () {
        load_studentdata();
    });


    /**
     * Form validation
     */
    function validate_fields(inputFeild, errorField, errorMessage){
        if($.trim(inputFeild).length == 0)
        {
            errorField.text(errorMessage);
        }
        else
        {
            errorField.text('');
        }
    }

    /**
     * Load student data to table
     */
    function load_studentdata()
    {
        $.ajax({
            method: "GET",
            url: "/ajax-students/getdata",
            success: function(response){
                $.each(response.students, function(key, value){
                    // console.log(value['name']);
                    $('.student-list').append(
                        '<tr>\
                            <td class="stud_id">'+value['id']+'</td>\
                            <td>'+value['name']+'</td>\
                            <td>'+value['email']+'</td>\
                            <td>'+value['phone']+'</td>\
                            <td>'+value['course']+'</td>\
                            <td>'+value['created_at']+'</td>\
                            <td>\
                                <a href="#" class="btn btn-info view-btn" >View<\a>\
                                <a href="#" class="btn btn-primary edit-btn" >Edit<\a>\
                                <a href="#" class="btn btn-danger delete-btn" >Delete<\a>\
                            </td>\
                        </tr>'
                        );
                });
            }
        });
    }

    /**
     * Save student data
     */
    $(document).ready( function(){
        $(document).on('click', '.ajaxstudent-save', function(){
            // get input class
            var name = $('.name').val();
            var email = $('.email').val();
            var phone = $('.phone').val();
            var course = $('.course').val();

            // get error fields
            var error_name = $('#error_name');
            var error_email = $('#error_email');
            var error_phone = $('#error_phone');
            var error_course = $('#error_course');

            validate_fields(name, error_name, 'Please enter your full name');
            validate_fields(email, error_email, 'Please enter your email');
            validate_fields(phone, error_phone, 'Please enter your phone');
            validate_fields(course, error_course, 'Please enter course');

            if( error_name.text() != '' || 
                error_email.text() != '' || 
                error_phone.text() != '' || 
                error_course.text() != '')
            {
                return false;
            }
            else
            {

                // pass the details of your input value
                var data = {
                    'name' : name,
                    'email' : email,
                    'phone' : phone,
                    'course' : course
                };
                // console.log(data);

                $.ajax({
                    method: "POST",
                    url: "/ajax-student/store",
                    data: data,
                    success: function (response) {
                        $('#studentModal').modal('hide');
                        $('#studentModal').find('input').val('');
                        $('.student-list').html("");
                        load_studentdata();
                        
                        alert(response.status);
                        // alertify.set('notifier', 'positon', 'top-right');
                        // alertify.success(response.status);
                    }
                });
            }
        });
    });

    /**
     * View || Update student || Deletedata when selected
     */
    $(document).ready(function(){

        // display student data for view
        $(document).on('click', '.view-btn', function(){
            var stud_id = $(this).closest('tr').find('.stud_id').text();

            // console.log(stud_id);
            $.ajax({
                method: "POST",
                url: "ajax-student/viewstudent",
                data: {
                    'stud_id': stud_id,
                },
                success: function(response){
                    
                    $.each(response, function(key, studview) {
                        $('.id_view').text(studview['id']);
                        $('.name_view').text(studview['name']);
                        $('.email_view').text(studview['email']);
                        $('.phone_view').text(studview['phone']);
                        $('.course_view').text(studview['course']);
                        $('#studentViewModal').modal('show');
                    });
                    
                }
            });
        });

        // display student data for update
        $(document).on('click', '.edit-btn', function(){

            var stud_id = $(this).closest('tr').find('.stud_id').text();

            $.ajax({
                method: "POST",
                url: "ajax-student/editstudent",
                data:{
                    'stud_id' : stud_id
                },
                success: function(response) {
                    // console.log(response);
                    $.each(response, function(key, studvalue) {

                        $('#edit_id').val(studvalue['id']);
                        $('#edit_name').val(studvalue['name']);
                        $('#edit_email').val(studvalue['email']);
                        $('#edit_phone').val(studvalue['phone']);
                        $('#edit_course').val(studvalue['course']);
                        $('#studentEditModal').modal('show');
                    });
                }
            });
        });

        // update student data
        $(document).on('click', '.ajaxstudent-update', function(){
            var data = {
                'stud_id' : $('#edit_id').val(),
                'name' : $('#edit_name').val(),
                'email' : $('#edit_email').val(),
                'phone' : $('#edit_phone').val(),
                'course' : $('#edit_course').val(),
            }

            // console.log(data);
            $.ajax({
                method: "POST",
                url: "ajax-student/updatestudent",
                data: data,
                success: function(response){
                    $('#studentEditModal').modal('hide');
                    $('#studentEditModal').find('input').val('');
                    $('.student-list').html("");
                    load_studentdata();

                    alert(response.status);
                }
            });
        });

        // display modal for delete student
        $(document).on('click', '.delete-btn', function(){
            var stud_id = $(this).closest('tr').find('.stud_id').text();

            $('#stud_delete_id').val(stud_id);
            $('#studentDeleteModal').modal('show');
        });

        // deletion of data using ajax
        $(document).on('click', '.ajaxstudent-delete', function(){
            var stud_id = $('#stud_delete_id').val();
            // alert(stud_id);

            $.ajax({
                method: "POST",
                url: 'ajax-student/deletestudent',
                data:{
                    'stud_id' : stud_id
                },
                success: function(response) {
                    $('#studentDeleteModal').modal('hide');
                    $('#studentDeleteModal').find('input').val("");
                    $('.student-list').html("");
                    load_studentdata();
                    console.log(response);
                }
            });

        });


    });

 
    
</script>

<?= $this->endSection() ?>

