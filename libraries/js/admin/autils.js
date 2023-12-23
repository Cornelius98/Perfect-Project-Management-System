
function streamMedia(streamURL){
    let streamAPI = document.createElement("audio");
        streamAPI.src = streamURL;
        streamAPI.play();
}
function timer(streamAPI){
    setInterval(function(){
        let time = streamAPI.currentTime;
        console.log(time);
    },2000);
}

$("#change-price-btn").click(function(){
    $(function(){
        let price = ($("#price").val()!="")?$("#price").val():$(".error-response").html("<div class='e-notice'>Price Cannot Be Empty</div>");
        let price_hash = ($("#price_hash").val()!="")?$("#price_hash").val():$(".error-response").html("<div class='e-notice'>Price Encryption Not Found, Refresh</div>");
        if((price!="") && (price_hash!="")){
            $.ajax({
                type: "POST",
                url: "./middleware/user/handleAdvert/mw_price_change",
                async: true,
                cache:false,
                data:{
                    "price":price,
                    "price_hash":price_hash
                },
                beforeSend:function(){
                    $("#spin-anime-account").show();
                },
                success: function(data){
                    
                }
            });
        }
    });
});

function deleteAccount(){
    $(function(){
        $.ajax({
            type: "POST",
            url: "./middleware/user/handleAccounts/mw_delete_account",
            async: true,
            cache:false,
            data:{
                "price":price,
                "price_hash":price_hash
            },
            beforeSend:function(){
                $("#spin-anime-account").show();
            },
            success: function(data){
                
            }
        });
    });
}
