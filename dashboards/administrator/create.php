<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../../EXTERNAL_HEADER_FILES.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Create Project');?>
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
                        <section class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <h4>CREATE AND MANAGE YOUR PROJECT</h4>
                            <hr>
                            <div class="form-wrap">
                                <div class="error-display"></div>
                                <form>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Name, Description, Summary</label>
                                        <div class="form-group-even">
                                            <input type="text" name="name" id="name" placeholder="Project Name" />
                                            <input type="text" name="tname" id="tname" placeholder="Project Technical Name" />
                                            <input type="text" name="desc" id="desc" placeholder="Project Description"/>
                                            <input type="text" name="summary" id="summary" placeholder="Project Summary"/>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Aims, Objectives, Hypothesis</label>
                                        <div class="form-group-even">
                                           <textarea name="aims" id="aims" cols="30" rows="5" placeholder="Project Aims"></textarea>
                                           <textarea name="objectives" id="objectives" cols="30" rows="5" placeholder="Project Objectives"></textarea>
                                           <textarea name="hypothesis" id="hypothesis" cols="30" rows="5" placeholder="Project Hypothesis"></textarea>
                                           <textarea name="conclusion" id="conclusion" cols="30" rows="5" placeholder="Project Conclusion"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Dates: Start, Midway, Completion</label>
                                        <div class="form-group-even">
                                        <input type="date" name="sdate" id="sdate" />
                                        <input type="date" name="mdate" id="mdate" />
                                        <input type="date" name="cdate" id="cdate" />
                                        <input type="text" name="duration" id="duration" placeholder="Duration" />
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Project Management</label>
                                        <div class="form-group-even">
                                            <input type="text" name="director" id="director" placeholder="Project Director" />
                                            <input type="text"name="manager" id="manager" placeholder="Project Manager"/>
                                            <input type="text" name="supervisor" id="supervisor" placeholder="Project Supervisor"/>
                                            <input type="text" name="wforce" id="wforce" placeholder="Project Work Force"/>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Resource Management</label>
                                        <div class="form-group-even">
                                            <input type="text" name="input" id="input" placeholder="Input" />
                                            <input type="text"name="yield" id="yield" placeholder="Expected Yield"/>
                                            <input type="text" name="loss" id="loss" placeholder="Possible Loss"/>
                                            <input type="text" name="profit" id="profit" placeholder="Estimated Profit"/>
                                        </div>
                                    </div>
                                    <div class="form-grouped">
                                        <label for="form-section" class="form-section">Project Procedures</label>
                                        <div class="form-group-even">
                                           <textarea name="sprocedure" id="sprocedure" cols="30" rows="5" placeholder="Project Start Procedures"></textarea>
                                           <textarea name="mprocedure" id="mprocedure" cols="30" rows="5" placeholder="Project Maintenance Procedures"></textarea>
                                           <textarea name="yprocedure" id="yprocedure" cols="30" rows="5" placeholder="Project Yield Procedures"></textarea>
                                           <textarea name="rprocedure" id="rprocedure" cols="30" rows="5" placeholder="Project Risk Management Procedures"></textarea>
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
                                                    <strong>CREATE PROJECT</strong> 
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
   
    <?php $AdminiUXTemplate->spinAnime();?>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
        function processFilesFromForms(formData,input,fileSave,err){
            let artwork = document.getElementById(input),
                    artworkFileList = artwork.files,
                    artworkListLength = artworkFileList.length
                    i = 0;
                    if(artworkListLength > 0){
                        while(i<=artworkListLength){
                            formData.append(fileSave,artworkFileList[i]);
                            i++;
                        }
                    }else $(".error-display").html('<div class="e-notice">'+err+'</div>');
        }
        function errorDisplayAssistant(errCode,errFlaggs){
            if((errCode==404)||(errCode==505)){
                (".error-display").html('<div class="e-notice">'+errFlaggs+'</div>');
            }
        }
        $("#migrateAdd").click(function(evt){
            evt.preventDefault();
            let formData = new FormData(),
                name = ($("#name").val()!="")?$("#name").val():$(".error-display").html('<div class="e-notice">Enter Project Name</div>'),
                tname = ($("#tname").val()!="")?$("#tname").val():$(".error-display").html('<div class="e-notice">Enter Project Technical Name</div>'),
                desc = ($("#desc").val()!="")?$("#desc").val():0,
                summary = ($("#summary").val()!="")?$("#summary").val():0,

                aims = ($("#aims").val()!="")?$("#aims").val():0,
                objectives = ($("#objectives").val()!="")?$("#objectives").val():0,
                hypothesis = ($("#hypothesis").val()!="")?$("#hypothesis").val():0,
                conclusion = ($("#conclusion").val()!="")?$("#conclusion").val():0,

                sdate = ($("#sdate").val()!="")?$("#sdate").val():0,
                mdate = ($("#mdate").val()!="")?$("#mdate").val():0,
                cdate = ($("#cdate").val()!="")?$("#cdate").val():0,
                duration = ($("#duration").val()!="")?$("#duration").val():0,

                director = ($("#director").val()!="")?$("#director").val():0,
                manager = ($("#manager").val()!="")?$("#manager").val():0,
                supervisor = ($("#supervisor").val()!="")?$("#supervisor").val():0,
                wforce = ($("#wforce").val()!="")?$("#wforce").val():0,

                input = ($("#input").val()!="")?$("#input").val():0,
                pyield = ($("#yield").val()!="")?$("#yield").val():0,
                loss = ($("#loss").val()!="")?$("#loss").val():0,
                profit = ($("#profit").val()!="")?$("#profit").val():0,

                sprocedure = ($("#sprocedure").val()!="")?$("#sprocedure").val():0,
                mprocedure = ($("#mprocedure").val()!="")?$("#mprocedure").val():0,
                yprocedure = ($("#yprocedure").val()!="")?$("#yprocedure").val():0,
                rprocedure = ($("#rprocedure").val()!="")?$("#rprocedure").val():0;

                formData.append("name",name);
                formData.append("tname",tname);
                formData.append("desc",desc);
                formData.append("summary",summary);
                formData.append("aims",aims);
                formData.append("objectives",objectives);
                formData.append("hypothesis",hypothesis);
                formData.append("conclusion",conclusion);
                formData.append("sdate",sdate);
                formData.append("mdate",mdate);
                formData.append("cdate",cdate);
                formData.append("duration",duration);
                formData.append("director",director);
                formData.append("manager",manager);
                formData.append("supervisor",supervisor);
                formData.append("wforce",wforce);
                formData.append("input",input);
                formData.append("pyield",pyield);
                formData.append("loss",loss);
                formData.append("profit",profit);
                formData.append("sprocedure",sprocedure);
                formData.append("mprocedure",mprocedure);
                formData.append("yprocedure",yprocedure);
                formData.append("rprocedure",rprocedure);

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
                    url: '../../middleware/admini/handleAdvert/mw_project_push',
                    processData: false,
                    contentType: false,
                    async: true,
                    data:formData,
                    beforeSend:function(){
                        $(".spin-wrap").css("display","flex");
                        $(".dash-full-wrapper").css("animation","waterWaveFade 2s infinite");
                    },
                    success:function(q,status,settings){
                        let s = JSON.parse(q);
                        scrollTo(0,0);
                        $(".spin-wrap").css("display","none");
                        $(".dash-full-wrapper").css("animation","none");
                        if(s["status"]==200){
                            $(".error-display").html('<div class="e-success">Project Successfully Published</div>');
                        }else $(".error-display").html('<div class="e-notice">Operation Failed, Try Again</div>');
                    }
                });
        });
    </script>
</body>
</html>
 