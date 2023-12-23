
function downloadUnicast(seck){
    if((seck!="")){
        $.ajax({
            type: "POST",
            url: "./middleware/user/handleInterractions/mw_download",
            async: true,
            cache:false,
            data:{"seck":seck}
        });
    }
}
function viewUnicast(seck){
    if((seck!="")){
        $.ajax({
            type: "POST",
            url: "./middleware/user/handleInterractions/mw_view",
            async: true,
            cache:false,
            data:{"seck":seck}
        });
    }
}
function shareUnicast(seck,platform){
    if((seck!="") && (platform!="")){
        $.ajax({
            type: "POST",
            url: "./middleware/user/handleInterractions/mw_share",
            async: true,
            cache:false,
            data:{"seck":seck,"platform":platform}
        });
    }
}
function cartUnicast(seck){
    if((seck!="")){
        $.ajax({
            type: "POST",
            url: "./middleware/user/handleInterractions/mw_cart",
            async: true,
            cache:false,
            data:{"seck":seck}
        });
    }
}