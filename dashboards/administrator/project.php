<?php
/**************************************
 * 
 * Gallery 1 - Picture(s)
 * 
 * Gallery 2 - Document(s)
 * 
 * Gallery 3 - File(s)
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
if(isset($_GET["pipe"]) && !empty($_GET["pipe"])){
    if($int = $NameSanitizer->is_whole_int($_GET["pipe"])){
        if($UserAccountPull->advertiser_exist($_GET["pipe"])){
            $adrSeck = $int;
            $o = $AdminiAccountPull->get_mirror_account_route_o($adrSeck);
            if(!is_array($o) || empty($o) || empty($o["adr_id"]))
                header("location:err_mirror_credentials");
            else {
                $params = 'pipe='.$_GET["pipe"].'&&pjr='.$_GET["pjr"];
                $ProductPush->view($_GET["pjr"],$_SESSION["aSessn"]["aSeck"]);
            }
        }else header("location:home?err_uthread_unexist");
    }else header("location:home?err_uthread_nn");
}else header("location:home?err_uthread_unset");

$projectContainer = $ProductPull->get_project($_GET["pjr"]);
$projectGraph = $GraphSimulator->projectGraphCoordsPjctAlone($_GET["pjr"]);
$barGraph = $GraphSimulator->barGraphCoordsAlone($_GET["pjr"]);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Project Review');?>
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
                                <h5>Daily Project Progress</h5><hr>
                                <section class="project-graphs">
                                    <canvas class="graph-1" id="graph-1"></canvas>
                                    <canvas class="graph-2" id="graph-2"></canvas>
                                </section>
                            </div>
                            <hr>
                            <a href="progress?<?php echo $params;?>" class="btn btn-primary btn-sm"> Record Progress</a>
                            <a href="project_edit?<?php echo $params;?>" class="btn btn-primary btn-sm"> Edit</a>
                            <a href="project_new_files?<?php echo $params;?>" class="btn btn-primary btn-sm">Add Files</a>
                            <div>
                                <div class="form-grouped">
                                    <label for="form-section" class="form-section">Project: Pictures, Documents And Files</label>
                                    <div class="song-files">
                                        <a href="gallery?<?php echo $params.'&&gallery=1';?>" class="sub-form-group">
                                                <label for="pictures" class="cover">
                                                    <i class="fa fa-image fa-3x"></i><br>
                                                    Project Pictures
                                                </label>
                                        </a>
                                        <a href="gallery?<?php echo $params.'&&gallery=2';?>" class="sub-form-group">
                                            <label for="documents" class="artwork">
                                                <i class="fa fa-image fa-3x"></i><br>
                                                Project Docments
                                            </label>
                                        </a>
                                        <a href="gallery?<?php echo $params.'&&gallery=3';?>" class="sub-form-group">
                                            <label for="files" class="artwork">
                                                <i class="fa fa-image fa-3x"></i><br>
                                                Project Files
                                            </label>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                if(is_array($projectContainer) && !empty($projectContainer)){
                                    echo '<div class="ads-section">
                                                <div class="ads-desc" id="personal">
                                                    <h5>Project</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Status:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["mute"]!=0)
                                                                        echo "Offline";
                                                                    else echo "Online";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Name(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["name"]!=0)
                                                                        echo $projectContainer["name"];
                                                                    else 
                                                                        echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Technical(s) Name:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["tname"]!=0)
                                                                        echo $projectContainer["tname"];
                                                                    else 
                                                                        echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="contact">
                                                    <h5>Project Description</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Description:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["desc"])
                                                                        echo $projectContainer["desc"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Summary:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["summary"])
                                                                        echo $projectContainer["summary"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Conclusion:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["conclusion"])
                                                                        echo $projectContainer["conclusion"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="contact">
                                                    <h5>Project Aim(s), Objective(s), Hypothesis</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Aim(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["aims"])
                                                                        echo $projectContainer["aims"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Objective(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["objectives"])
                                                                        echo $projectContainer["objectives"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Hypothesis:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["hypothesis"])
                                                                        echo $projectContainer["hypothesis"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc">
                                                    <h5>Project Management</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Director(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["director"])
                                                                        echo $projectContainer["director"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Manager(s):</td>
                                                                <td  class="ads-prop-value">'; 
                                                                    if($projectContainer["manager"])
                                                                        echo $projectContainer["manager"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Supervisor(s):</td>
                                                                <td  class="ads-prop-value">'; 
                                                                    if($projectContainer["supervisor"])
                                                                        echo $projectContainer["supervisor"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="billing">
                                                    <h5>Project Resources</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Capital (Inputs):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["input"])
                                                                        echo $projectContainer["input"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Expected Yield:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["yield"]!=0)
                                                                        echo $projectContainer["yield"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Estimated Loss:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["losses"]!=0)
                                                                        echo $projectContainer["losses"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Profit Projection(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["proceeds"]!=0)
                                                                        echo $projectContainer["proceeds"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="billing">
                                                    <h5>Project Procedures</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Start Procedure(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["sprocedures"])
                                                                        echo $projectContainer["sprocedures"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Maintenance Procedure(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["mprocedures"]!=0)
                                                                        echo $projectContainer["mprocedures"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Yield Procedure(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["yprocedures"]!=0)
                                                                        echo $projectContainer["yprocedures"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Risk Management Procedure(s):</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["riskm"]!=0)
                                                                        echo $projectContainer["riskm"];
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="billing">
                                                    <h5>Project Timestamps</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Start Date:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["sdate"])
                                                                        echo date("F,D Y",strtotime($projectContainer['sdate']));
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Midway Date:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["mdate"]!=0)
                                                                        echo date("F,D Y",strtotime($projectContainer['mdate']));
                                                                    else echo "unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Completion Date:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["cdate"]!=0)
                                                                        echo date("F,D Y",strtotime($projectContainer['mdate']));
                                                                    else echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Time Of Creation:</td>
                                                                <td  class="ads-prop-value">'.date("H:m A",strtotime($projectContainer['p_time'])).'</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Duration:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer["duration"]!=0)
                                                                        echo $projectContainer["duration"];
                                                                    else echo "Unknown";
                                                                echo '</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="location">
                                                    <h5>Project Reports</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">First Quarter:</td>
                                                                <td  class="ads-prop-value"><a href="pdfGenerate?quarter=First">Report I</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Second Quarter:</td>
                                                                <td  class="ads-prop-value"><a href="pdfGenerate?quarter=Second">Report II</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Third Quarter:</td>
                                                                <td  class="ads-prop-value"><a href="pdfGenerate?quarter=Third">Report III</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="ads-desc" id="account">
                                                    <h5>Close Or Open Project</h5>
                                                    <hr>
                                                    <table>
                                                        <thead>
                                                            <th>
                                                                <tr></tr>
                                                                <tr></tr>
                                                            </th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td  class="ads-prop-key">Date Of Creation:</td>
                                                                <td  class="ads-prop-value">'.date("F,D Y",strtotime($projectContainer['sdate'])).'</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Time Of Creation:</td>
                                                                <td  class="ads-prop-value">'.date("H:m A",strtotime($projectContainer['p_time'])).'</td>
                                                            </tr>
                                                            <tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Close Project:</td>
                                                                <td  class="ads-prop-value">';
                                                                    if($projectContainer['mute']==1)
                                                                        echo '<a href="../../middleware/admini/handleAdvert/mw_project_close?'.$params.'&&mute=0">Open</a>';
                                                                    else 
                                                                        echo '<a href="../../middleware/admini/handleAdvert/mw_project_close?'.$params.'&&mute=1">Close</a>';
                                                                echo '</td>
                                                            </tr>
                                                            <tr>
                                                                <td  class="ads-prop-key">Delete:</td>
                                                                <td  class="ads-prop-value"><a href="../../middleware/admini/handleAdvert/mw_project_delete?'.$params.'&&operation=delete">Delete</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div>
                                            <div class="form-grouped">
                                                <div class="song-files">
                                                    <a href="invite?'.$params.'" class="sub-form-group">
                                                            <label for="pictures" class="cover">
                                                                <i class="fa fa-users fa-3x"></i><br>
                                                                INVITE TEAM
                                                            </label>
                                                    </a>
                                                    <a href="discuss?'.$params.'" class="sub-form-group">
                                                        <label for="documents" class="artwork">
                                                            <i class="fa fa-recycle fa-3x"></i><br>
                                                            Discussion Room
                                                        </label>
                                                    </a>
                                                    <a href="share?'.$params.'" class="sub-form-group">
                                                        <label for="files" class="artwork">
                                                            <i class="fa fa-share fa-3x"></i><br>
                                                            Share
                                                        </label>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><br><br>';
                                }else{
                                    echo '<h5 class="err_products">
                                                <i class="fa fa-robot"></i>
                                                <br>
                                                Sorry, Project Not Available
                                            </h5>';
                                }
                            ?>
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
    </script>
</body>
</html>

 

