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
                    <div class="card-header d-flex align-items-center justify-content-between bg-info">
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

            <div class="col-lg-6">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary ">
                            <h3 class="card-title text-white">Moves</h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="players d-flex align-items-end mb-2 py-2" id="player1">
                                <h4 class="mb-0">Player (X) :</h4>
                                <p class="ms-3 mb-0"><span id="playerx"><?= isset($data_recordfile1[0]['total_moves']) && $data_recordfile1[0]['total_moves'] != "" ? $data_recordfile1[0]['total_moves'] : "0"?></span> moves</p>
                            </div>
                            <div class="players d-flex align-items-end py-2" id="player2">
                                <h4 class="mb-0">Player (O) : </h4>
                                <p class="ms-3 mb-0"><span id="playero"><?= isset($data_recordfile1[1]['total_moves']) && $data_recordfile1[1]['total_moves'] != "" ? $data_recordfile1[1]['total_moves'] : "0"?></span> moves</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success ">
                            <h3 class="card-title text-white">Battle Results</h3>
                        </div>
                        <div class="card-body py-3">
                            <div class="players d-flex align-items-end mb-2 py-2" id="player1">
                                <h4 class="mb-0 fw-bold"><span class="text-success" id="winner"><?= isset($data_recordfile2['playername']) && $data_recordfile2['playername'] != "" ? $data_recordfile2['playername'] : "No player"?></span>, Won the last match! </h4>
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
        var playerName = "";
        var a = 0;
        var arrPlayer = [
            {
                'card' : 'X',
                'name' : 'Player (X)',
                'move' : 0,
                'isWinner' : '',
            },
            {
                'card' : 'O',
                'name' : 'Player (O)',
                'move' : 0,
                'isWinner' : '',
            }
        ];

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
      
        function handleBoxClick(objParam)
        {
            // let divBox = jQuery(obj).attr("id");
            let divBox = objParam.getAttribute("id");
           
            if(clicker % 2 == 0 && objParam.innerHTML != "X" && objParam.innerHTML != "O")
            {
                clicker += 1;
                objParam.innerHTML = "X";
            }
            else if(clicker % 2 == 1 && objParam.innerHTML != "X" && objParam.innerHTML != "O")
            {
                clicker += 1;
                objParam.innerHTML = "O";
            }

            // setting move's count on player, based on card value
            objIndex = arrPlayer.findIndex((x) => x.card == objParam.innerHTML);
            arrPlayer[objIndex].move += 1;
            console.log(arrPlayer[objIndex].name + "\'s move :  " + arrPlayer[objIndex].move);
            
            // check who win
            checkWinner(elementIds);

        }

        function checkWinner(arrElementIds = []) 
        {
            let divText = [];

            for (var i = 0; i < arrElementIds.length; i++)
            {
                divText[i] = document.getElementById(arrElementIds[i]).textContent;
            }

            if(boxRowChecker(divText[0], divText[1], divText[2], "X") 
                || boxRowChecker(divText[3], divText[4], divText[5], "X")
                || boxRowChecker(divText[6], divText[7], divText[8], "X")
                || boxRowChecker(divText[0], divText[3], divText[6], "X")
                || boxRowChecker(divText[1], divText[4], divText[7], "X")
                || boxRowChecker(divText[2], divText[5], divText[8], "X")
                || boxRowChecker(divText[0], divText[4], divText[8], "X")
                || boxRowChecker(divText[2], divText[4], divText[6], "X"))
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
                        }

                        clicker = 0; // reseting the value for clicking the box
                        playerName = "Player (X)";
                        let objIndex = arrPlayer.findIndex((obj) => obj.name == playerName);
                        
                        // console.log(arrPlayer[objIndex]);
                        setGameResultsV2(arrPlayer, arrPlayer[objIndex]);
                    });
                });
            }
            else if(boxRowChecker(divText[0], divText[1], divText[2], "O") 
                || boxRowChecker(divText[3], divText[4], divText[5], "O")
                || boxRowChecker(divText[6], divText[7], divText[8], "O")
                || boxRowChecker(divText[0], divText[3], divText[6], "O")
                || boxRowChecker(divText[1], divText[4], divText[7], "O")
                || boxRowChecker(divText[2], divText[5], divText[8], "O")
                || boxRowChecker(divText[0], divText[4], divText[8], "O")
                || boxRowChecker(divText[2], divText[4], divText[6], "O"))
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
                            playerName = "Player (O)";
                            let objIndex = arrPlayer.findIndex((obj) => obj.name == playerName);
                           
                            setGameResultsV2(arrPlayer, arrPlayer[objIndex]);
                            
                        }
                        else
                        {
                        }
                    });
                });
            }
            else if(clicker >= 9)
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
                        }
                    });
                });
            }
        }

        function setGameResultsV2(arrPlayerParam, playerParam) {
            return new Promise(function(resolve) {
                arrPlayerParam.forEach(function(player) {
                    let objIndex;
                    if (player == playerParam) {
                        player.isWinner = "Yes";
                        objIndex = arrPlayer.findIndex((obj) => obj.isWinner == "Yes");
                    } else {
                        player.isWinner = "No";
                        objIndex = arrPlayer.findIndex((obj) => obj.isWinner == "No");
                    }
                    save(objIndex);
                    $.blockUI();
                    // console.log(player);
                });
                resolve(arrPlayerParam);
            }).then(function(updatedArr) {
                $.unblockUI();
                updatedArr.forEach(function(player) {
                    player.isWinner = "";
                    player.move = 0;
                });

                setGameResults(); // setting the results
            });
        }

        function boxRowChecker(box1, box2, box3, value)
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
                        }
                    });
                });
        }

        function save(objParam)
        {
            var xdata = "&txtfld[playername]=" + arrPlayer[objParam].name;
                xdata+= "&txtfld[move]=" + arrPlayer[objParam].move;
                xdata+= "&txtfld[iswinner]=" + arrPlayer[objParam].isWinner;

            $.blockUI();
            jQuery.ajax({
                url: "<?= base_url().$data_activepage ?>/submitsave",
                method: "POST",
                data: xdata,
                dataType: "JSON",
                success : function(xret) {
                    $.unblockUI();
                    console.log(xret);
                },
            });
        }

        function setGameResults()
        {
            let playerXResult = document.getElementById("playerx");
            let playerOResult = document.getElementById("playero");
            let winnerResult = document.getElementById("winner");


            $.blockUI();
            jQuery.ajax({
                url: "<?= base_url().$data_activepage ?>/getdata",
                method: "POST",
                dataType: "JSON",
                success: function (xret){
                    $.unblockUI();
                    if(xret)
                    {
                        playerXResult.innerHTML = xret.data_recordfile1[0].total_moves;
                        playerOResult.innerHTML = xret.data_recordfile1[1].total_moves;
                        winnerResult.innerHTML = xret.data_recordfile2.playername;
                    }
                    else
                    {

                    }
                }

            });

        }


        /**
         * Older version of my functions
         */
        function setGameResultsV1(arrPlayerParam, playerParam)
        {
            arrPlayerParam.forEach(function(player){
                let objIndex;
                if(player == playerParam)
                {
                    player.isWinner = "Yes";
                    objIndex = arrPlayer.findIndex((obj) => obj.isWinner == "Yes");
                }
                else
                {
                    player.isWinner = "No";
                    objIndex = arrPlayer.findIndex((obj) => obj.isWinner == "No");
                }

                save(objIndex);
                console.log(player);

            });

            arrPlayerParam.forEach(function(player){
                player.move = 0;
                player.isWinner = "";
            });
        }
        //*==================================================+
    </script>
<?= $this->endSection(); ?>