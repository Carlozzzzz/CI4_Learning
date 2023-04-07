<?= $this->extend('template/main')?>

<?= $this->section('content'); ?>
<style>
    .box{
        width: 150px;
        height: 150px;
        cursor: pointer;
    }

    .box-2
    {
        height: 150px;
        cursor: pointer;
    }

    .pointer{
        cursor: pointer;
    }

    .box:hover
    {
        color: green;
        border: 2px solid green !important;
        transition: 0.2s;
    }
</style>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-between bg-success">
                        <h3 class="card-title text-white" id="test">Tik-tak Board</h3>
                        <img class="pointer" src="<?= base_url() ?>assets/img/reload_logo.png" onclick="reloadGame();" alt="mdo" width="32" height="32">
                    </div>
                    <!-- <div class="card-body d-flex flex-column align-items-center justify-content-center text-center fw-bold fs-3"> -->
                    <div class="card-body fw-bold fs-3 pt-3">
                        <div class="row ">
                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num1" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>
                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num2" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>
                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num3" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>

                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num4" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>
                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num5" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>
                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num6" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>

                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num7" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>
                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num8" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>
                            <div class="col-4 box-2 border border-success border-2 d-flex align-items-center justify-content-center" id="num9" onclick="handleBoxClick(this)">
                                <div class="d-flex align-items-center justify-content-center">
                                    ?
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

    <script type="text/javascript">
        var clicker = 0;
        var hasWinner = false;

        const defaultValues = {
            'num1' : '?',
            'num2' : '?',
            'num3' : '?',
            'num4' : '?',
            'num5' : '?',
            'num6' : '?',
            'num7' : '?',
            'num8' : '?',
            'num9' : '?',
        };

        const elementIds = [
            'num1', 'num2', 'num3', 
            'num4', 'num5', 'num6', 
            'num7', 'num8', 'num9',
        ];
      
        function handleBoxClick(obj)
        {
            // let divBox = jQuery(obj).attr("id");
            let divBox = obj.getAttribute("id");
           
            if(clicker % 2 == 0 && obj.innerHTML != "X" && obj.innerHTML != "O")
            {
                clicker += 1;
                obj.innerHTML = "X";
            }
            else if(clicker % 2 == 1 && obj.innerHTML != "X" && obj.innerHTML != "O")
            {
                clicker += 1;
                obj.innerHTML = "O";
            }
            
            // check who win
            checkWinner(elementIds);
            console.log(clicker + " winner: " + hasWinner);
        }

        function checkWinner(arr = []) 
        {
            let divText = [];

            for (var i = 0; i < arr.length; i++)
            {
                // divText[i] = jQuery('#' + arr[i]).text();
                divText[i] = document.getElementById(arr[i]).textContent;
            }

            if(rowChecker(divText[0], divText[1], divText[2], "X") 
                || rowChecker(divText[3], divText[4], divText[5], "X")
                || rowChecker(divText[6], divText[7], divText[8], "X")
                || rowChecker(divText[0], divText[3], divText[6], "X")
                || rowChecker(divText[1], divText[4], divText[7], "X")
                || rowChecker(divText[2], divText[5], divText[8], "X")
                || rowChecker(divText[0], divText[4], divText[8], "X")
                || rowChecker(divText[2], divText[4], divText[6], "X"))
            {
                jQuery(document).ready(function(){
                    Swal.fire({
                        title: 'Player X Wins!',
                        icon: 'success',
                        text: 'Congratulations! Do you want a rematch?',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor : "#d33",
                        confirmButtonText: "Yes, I will beat his/her ass!",
                        footer: '<img src="<?= base_url()?>assets/img/medal_logo.png" width="50px">',
                    }).then((result) => {
                        if(result.value)
                        {
                            resetElements();
                            clicker = 0; // reseting the value for clicking the box
                            hasWinner = false;
                        }
                        else
                        {
                            hasWinner = true;
                        }
                    });
                });
            }
            else if(rowChecker(divText[0], divText[1], divText[2], "O") 
                || rowChecker(divText[3], divText[4], divText[5], "O")
                || rowChecker(divText[6], divText[7], divText[8], "O")
                || rowChecker(divText[0], divText[3], divText[6], "O")
                || rowChecker(divText[1], divText[4], divText[7], "O")
                || rowChecker(divText[2], divText[5], divText[8], "O")
                || rowChecker(divText[0], divText[4], divText[8], "O")
                || rowChecker(divText[2], divText[4], divText[6], "O"))
            {
                jQuery(document).ready(function(){
                    Swal.fire({
                        title: 'Player O Wins!',
                        icon: 'success',
                        text: 'Congratulations! Do you want a rematch?',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor : "#d33",
                        confirmButtonText: "Yes, I will beat his/her ass!",
                        footer: '<img src="<?= base_url()?>assets/img/medal_logo.png" width="50px">',
                    }).then((result) => {
                        if(result.value)
                        {
                            resetElements(); // reseting elements to default value
                            clicker = 0; // reseting the value for clicking the box
                            hasWinner = false;
                        }
                        else
                        {
                            hasWinner = true;
                        }
                    });
                });
            }
            else if(clicker >= 9 && hasWinner == false)
            {
                jQuery(document).ready(function(){
                    Swal.fire({
                        title: 'It\'s a tie',
                        icon: 'success',
                        text: 'Congratulations! Do you want a rematch?',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor : "#d33",
                        confirmButtonText: "Yes, I will beat his/her ass!",
                        footer: '<img src="<?= base_url()?>assets/img/medal_logo.png" width="50px">',
                    }).then((result) => {
                        if(result.value)
                        {
                            resetElements(); // reseting elements to default value
                            clicker = 0; // reseting the value for clicking the box
                            hasWinner = false;
                        }
                    });
                });
            }
        }

        function rowChecker(box1, box2, box3, value)
        {
            if(box1 == value && box2 == value && box3 == value)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        function resetElements()
        {
            for (let id in defaultValues)
            {
                if (defaultValues.hasOwnProperty(id))
                {
                    // let element = $('#' + id);
                    let element = document.getElementById(id);
                    element.innerHTML = defaultValues[id];
                }
            }
        }

        function reloadGame()
        {
            jQuery(document).ready(function(){
                    Swal.fire({
                        title: 'Reload the game?',
                        icon: 'warning',
                        text: 'Are you sure you want to reload?',
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor : "#d33",
                        confirmButtonText: "Yes, reload it!",
                    }).then((result) => {
                        if(result.value)
                        {
                            resetElements();
                            clicker = 0; // reseting the value for clicking the box
                            hasWinner = false;
                        }
                    });
                });
        }

    </script>
<?= $this->endSection(); ?>