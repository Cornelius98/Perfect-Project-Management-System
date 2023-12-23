$(function(){

    $("#task-search").hover(function(){
        $("#pop-finder").slideDown(2000);
    }); 
    $("#remove-pop").click(function(){
        $("#pop-finder").slideUp(2000);
    }); 

    $("#search-icon").hover(function(){
        $('#nav-form').show(function(){
            $("#search-icon").hide();
        });
    });

    //social links display
    $("#follow-f").click(function(){
        $("#s-fade").show(2000);
    }); 

    $("#follow-t").click(function(){
        $("#s-fade").show(2000);
    }); 

    $("#follow-i").click(function(){
        $("#s-fade").show(2000);
    }); 

    $("#follow-w").click(function(){
        $("#s-fade").show(2000);
    }); 

    $("#footer-follow-f").click(function(){
        $("#s-fade").show(2000);
    }); 

    $("#footer-follow-i").click(function(){
        $("#s-fade").show(2000);
    }); 

    $("#footer-follow-w").click(function(){
        $("#s-fade").show(2000);
    }); 
    $("#f-cancel").click(function(){
        $("#s-fade").hide(2000);
    }); 




  

    var count = 0;
    var per = 0;
    var increase = setInterval(animate,50);
    function animate() {
        if(count >=100 && per >= 100){
            clearInterval(increase);
            $('#notice').text("Complete");
            $('#loader-wrapper').slideUp(2000);

        }else{
            count = count + 2;
            per = per + 2;
            $('#progress-bar').width(`${per}%`);
            $('#progress-counter').text(`${count}%`);
        }
    }  

});