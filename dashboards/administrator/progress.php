<?php
/**************************************
 * 
 * USAGE: This file updates the project
 *        daily progress
 *        
 * 
 * DATE: Tuesday July 18,2023
 * 
 *************************************/
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$adrSeck = null;
$params = null;
$o = null;
$pjr_id = null;
$projectContainer = null;

if(isset($_GET["pipe"]) && !empty($_GET["pipe"])){
    if($int = $NameSanitizer->is_whole_int($_GET["pipe"])){
        if($UserAccountPull->advertiser_exist($_GET["pipe"])){
            $adrSeck = $int;
            $o = $AdminiAccountPull->get_mirror_account_route_o($adrSeck);
            if(!is_array($o) || empty($o) || empty($o["adr_id"]))
                header("location:err_mirror_credentials");
            else {
                $params = 'pipe='.$_GET["pipe"].'&&pjr='.$_GET["pjr"];
            }

            if(isset($_GET["pjr"]) && !empty($_GET["pjr"])){
                $pjr_id = $_GET["pjr"];
                $projectContainer = $ProductPull->get_project($pjr_id);
                if(is_array($projectContainer) && !empty($projectContainer)){
                    $pjr_id =  $_GET["pjr"];
                }else header("location:home?err_pjr_empty");
            }else header("location:home?err_pjr");
        }else header("location:home?err_uthread_unexist");
    }else header("location:home?err_uthread_nn");
}else header("location:home?err_pipe");
$projectGraph = $GraphSimulator->projectGraphCoordsPjctAlone($_GET["pjr"]);
$barGraph = $GraphSimulator->barGraphCoordsAlone($_GET["pjr"]);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Project Progress');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side();?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <div>
                                <h5>Monitor Project Progress</h5><hr>
                                <section class="project-graphs">
                                    <canvas class="graph-1" id="graph-1"></canvas>
                                    <canvas class="graph-2" id="graph-2"></canvas>
                                </section>
                            </div>
                            <hr>
                            <a href="invite?<?php echo $params;?>" class="btn btn-primary btn-sm">Invite</a>
                            <a href="share?<?php echo $params;?>" class="btn btn-primary btn-sm">Share</a>
                            <a href="discuss?<?php echo $params;?>" class="btn btn-primary btn-sm">Discussion Room</a>

                            
                            <div class="form-wrap">
                                <br>
                                <div class="error-display"></div>
                                <br>
                                <form>

                                    <div class="form-grouped">
                                        <h5>RECORD DAILY PROGRESS</h5><hr>
                                        <label for="form-section" class="form-section">Name, Description, Results</label>
                                        <div class="form-group-even">
                                            <input type="text" name="name" id="name" placeholder="Task Name" />
                                            <input type="text" name="tname" id="tname" placeholder="Task Technical Name" />
                                            <input type="text" name="desc" id="desc" placeholder="Task Description"/>
                                            <input type="text" name="summary" id="summary" placeholder="Task Result"/>
                                            <input type="hidden" id="pjr" name="pjr" value="<?php echo $projectContainer["pj_id"];?>">
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Project: Pictures, Documents And Files</label>
                                        <div class="song-files">
                                            <div class="sub-form-group">
                                                    <label for="pictures" class="cover">
                                                        <i class="fa fa-image fa-3x"></i><br>
                                                        Project Pictures
                                                    </label>
                                                    <input type="file" 
                                                            id="pictures" 
                                                            class="form-control" 
                                                            name="pictures"
                                                            accept="image/png, image/jpeg, image/jpg, image/jfif, image/gif"
                                                            multiple/>
                                            </div>
                                            <div class="sub-form-group">
                                                <label for="documents" class="artwork">
                                                    <i class="fa fa-image fa-3x"></i><br>
                                                    Project Docments
                                                </label>
                                                <input type="file" 
                                                        id="documents" 
                                                        class="form-control" 
                                                        name="documents"
                                                        accept=".pdf,.docx,.doc,.txt"
                                                        multiple
                                                        />
                                            </div>
                                            <div class="sub-form-group">
                                                <label for="files" class="artwork">
                                                    <i class="fa fa-image fa-3x"></i><br>
                                                    Project Files
                                                </label>
                                                <input type="file" 
                                                        id="files" 
                                                        class="form-control" 
                                                        name="files"
                                                        accept=".mp3,.mp4,.wav,.ogg,.mpeg,.3gp"
                                                        multiple
                                                        />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <div>
                                            <button type="button" 
                                                    class="btn btn-primary 
                                                            btn-sm 
                                                            submit-btn 
                                                            form-control"
                                                    id="migrateAdd">
                                                    <strong>RECORD PROGRESS</strong> 
                                            </button>
                                        </div>
                                    </div>     
                                </form>
                            </div>
                            
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        var barTaggs = ["Pictures", "Docs", "Files"];
        var barValues = [<?php echo json_encode($barGraph["barPictures"]);?>,
                        <?php echo json_encode($barGraph["barDocuments"]);?>,
                        <?php echo json_encode($barGraph["barFiles"]);?>
                    ];
        var barColors = ["skyblue", "lightblue","darkblue"];
        new Chart("graph-2", {
            type: "bar",
            data: {
                labels: barTaggs,
                datasets: [{
                backgroundColor: barColors,
                data: barValues
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                title: {
                    display: true, text: 'File Statistics'
                }
            }
        });

        const xLabels = <?php echo json_encode($projectGraph["xPlaneCoords"]); ?>;
        new Chart("graph-1", {
        type: "line",
        data: {
            labels: xLabels,
            scaleFontColor: "#FFFFFF",
            datasets: [{
                data: <?php echo json_encode($projectGraph["viewsCoords"]); ?>,
                borderColor: "red",
                label: "Views",
                fill: false
            },{
                data: <?php echo json_encode($projectGraph["invitationCoords"]); ?>,
                borderColor: "green",
                label: "Invites",
                fill: false
            },{
                data: <?php echo json_encode($projectGraph["discussionCoords"]); ?>,
                borderColor: "blue",
                label: "Discussion",
                fill: false
            }]
        },
        options: {
            legend: {
                display: true,
                color: "white"
            },
            scales: {
                    xAxes: [{
                            display: true,
                            ticks: {
                                
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Time'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 30,
                                stepSize: 1
                            }
                        }]
                }
        }
        });
        $("#migrateAdd").click(function(evt){
            evt.preventDefault();
            let formData = new FormData(),
                name = ($("#name").val()!="")?$("#name").val():$(".error-display").html('<div class="e-notice">Enter Project Name</div>'),
                tname = ($("#tname").val()!="")?$("#tname").val():$(".error-display").html('<div class="e-notice">Enter Project Technical Name</div>'),
                desc = ($("#desc").val()!="")?$("#desc").val():0,
                summary = ($("#summary").val()!="")?$("#summary").val():0;
                hashPjr = ($("#pjr").val()!="")?$("#pjr").val():0;
            
                formData.append("name",name);
                formData.append("tname",tname);
                formData.append("desc",desc);
                formData.append("summary",summary);
                formData.append("hashPjr",hashPjr);
               
                let pictures = document.getElementById("pictures"),
                picturesFileList = pictures.files,
                picturesListLength = picturesFileList.length,
                j = 0;
                if(picturesListLength > 0){
                    while(j<=picturesListLength){
                        formData.append("pictures[]",picturesFileList[j]);
                        j++;
                    }
                }

                let documents = document.getElementById("documents"),
                documentsFileList = documents.files,
                documentsListLength = documentsFileList.length,
                i = 0;
                if(documentsListLength > 0){
                    while(i<=documentsListLength){
                        formData.append("documents[]",documentsFileList[i]);
                        i++;
                    }
                }

                let filesa = document.getElementById("files"),
                filesaFileList = filesa.files,
                filesaListLength = filesaFileList.length,
                q = 0;
                if(filesaListLength > 0){
                    while(q<=filesaListLength){
                        formData.append("filesa[]",filesaFileList[q]);
                        q++;
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: '../../middleware/admini/handleAdvert/mw_project_push_progress',
                    processData: false,
                    contentType: false,
                    async: true,
                    data:formData,
                    beforeSend:function(){
                        $(".spin-wrap").css("display","flex");
                        $(".dash-full-wrapper").css("animation","waterWaveFade 2s infinite");
                    },
                    success:function(s,status,settings){
                        let q = JSON.parse(s);
                        console.log(q);
                        scrollTo(0,0);
                        $(".spin-wrap").css("display","none");
                        $(".dash-full-wrapper").css("animation","none");
                        if(q["status"]==200){
                            $(".error-display").html('<div class="e-success">Progress Successfully Published</div>');
                        }else $(".error-display").html('<div class="e-notice">Operation Failed, Try Again</div>');
                    }
                });
        });
    </script>
</body>
</html>

 

