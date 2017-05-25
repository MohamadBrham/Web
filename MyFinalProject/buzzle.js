$(function (){
    var pic = "p1.jpg";
    $("#original").attr("src",pic);
   
    var h = 0;
    var w = 0; 
             /*this to get the height and width of the picture*/
    $("#original").load(function(){
        h = $(this).height(); 
        w = $(this).width(); 
        $("#pices  ,#or").css("width",w);    
        $("#pices ,#or  ").css("height" ,h);
        $("#buzzle ").css("width",w+6);    
        $("#buzzle ").css("height" ,h+6);        
        
        $("#solve").css("width",w/3).css("margin-left",w/3).css("font-size",Math.log(w)*Math.log(w)/1.5);
        $("table").css("font-size", Math.log(w)* Math.log(w)/1.1 );
        start(h,w,pic);
       });  
   
}) ;


function start(h,w,pic){    
    var positions =[-1,-1,-1,-1,-1,-1,-1,-1,-1];
    var firstClick = null;
    var counter = 0 ;
    function getPices() {       

        var code = "" ;
        for ( var i = 0 ; i < 9 ; i++) {
            var x = Math.floor(Math.random()* ((2*w/3)+1 ) ) ;
            var y = Math.floor(Math.random()* ((2*h/3)+1) )  ;
            
            var bgX = (i%3) * -(w/3);
            var bgY = Math.floor(i/3) * -(h/3) ;
            
            code += "<div class='pices' id='" + i + "p' " ;
            code += "style='top:" + y + "px; left:" + x + "px; width:"+(w/3)+"px; height:"+(h/3)+"px;" ;
            code += "background: url("+pic+");background-position:" + bgX + "px " + bgY + "px'></div>" ;
        }
        return code ; 
    }    
    function creteBuzzle(){
        var code = "" ;
        
        for ( var i = 0 ; i < 9 ; i++) {
            var x = (i%3)*((w/3)+2)  ;
            var y = Math.floor(i/3)*((h/3)+2)  ;
            
            code += "<div class='buzzle' id='" + i + "b' " ;
            code += "style='top:" + y + "px; left:" + x + "px; width:"+(w/3)+"px; height:"+(h/3)+"px" ;
            code += "'></div>" ;
        }
        return code ;
    }        
    $("#pices").html( getPices());    
    $("#buzzle").html(creteBuzzle());    
    $("#pices div").click( function() {   
            firstClick = $(this);
            $("#pices div").css("border", "2px solid white").css("z-index", "0");
            firstClick.css("border", "2px solid yellow").css("z-index", "1");  
    } );    
    $("#buzzle div").click(function(){
        var clicked = $(this) ;
        if(firstClick !== null && clicked.css("background-color") === "rgb(128, 128, 128)"  ){
            firstClick.fadeOut(0);            
             $(this).css("background","url("+pic+")").css("background-position-x" ,firstClick.css("background-position-x"));
             $(this).css("background-position-y" ,firstClick.css("background-position-y"));
             clicked.css("z-index","1");
             counter++;
             positions[parseInt(clicked.attr("id"))] = parseInt(firstClick.attr("id"));
             //window.alert(parseInt(clicked.attr("id")));
             firstClick = null;            
        }else  if(firstClick === null){          
            for(var i = 0; i < 9 ; i++){
                var p = $("#"+i+"p");
                if( p.css("background-position-x") === clicked.css("background-position-x") && p.css("background-position-y") === clicked.css("background-position-y")  ){
                    p.css("border", "2px solid white").css("z-index", "0");
                    counter--;
                    p.fadeIn(0);
                }                    
            }
            positions[parseInt(clicked.attr("id"))] = -1;
            $(this).css("background","gray");
        }        
        if(counter === 9){
            var flag = 0 ;
            for(var i = 0; i < 9 ; i++){             
                if( positions[i] !== i){
                    flag++;
                }                
            }
            if( flag === 0){
                $("#buzzle div").unbind("click");
                $("#pices div").unbind("click");
                $("#solve").unbind("click");  
                var ta = $("table").offset();
                $("#con").css("z-index", "2")
                      .css("top", h/3)
                      .css("left", (w/2)+ta.left)
                      .css("width", 2*w)
                      .css("lineHeight",h/3+"px")
                      .css("font-size", Math.log(Math.log(w)*w/3)* Math.log(Math.log(w)*w/3))
                      .css("height", h/3)
                        .delay(1000).animate({opacity:0.8},1000 );
            }
        } 
    });    
    $("#solve").hover(function (){
        $(this).css("background","#CCC" ).css("opacity","1");
    },function (){
         $(this).css("background","#333" ).css("opacity","0.5");
    });
    $("#solve").click(function (){ 
        $("#pices div").fadeIn(0);
        $("#buzzle div").css("background","gray");
        $("#pices div").css("border", "2px solid white");
        var ta = $("table").offset();
       // window.alert(ta.left);
        for(var i = 0 ; i < 9 ; i++){
           var x = $("#"+i+"b").offset();   
           $("#"+i+"p").css("z-index", "2").animate({top : x.top-60 , left :((x.left-w)-6-ta.left) },1000) ;
        }
        $("#buzzle div").unbind("click");
        $("#pices div").unbind("click");
        var ta = $("table").offset();
        $("#finished").css("z-index", "2")
                      .css("top", h/3)
                      .css("left", (w/2)+ta.left)
                      .css("width", 2*w)
                      .css("height", h/3) 
                      .css("font-size", Math.log(w)* Math.log(w)*2 )
                      .css("line-height",h/3+"px")
                      .delay(1000).animate({opacity:0.8},1000 );     
        
        
    });
    
    $(window).keydown(function(e){
       //console.log(e.which) ; 
       if ( e.which === 32) {
          var num = Math.floor(Math.random()*9);   
        
        $("#"+num+"p").css("z-index", "2").css("border", "3px solid red")
                .animate({ border: "3px solid red"},500 ,function (){
                         $("#"+num+"p").css("z-index", "1").css("border", "2px solid white");  
        }) ;
        
        
        $("#"+num+"b").css("z-index", "2").css("border", "3px solid red")
                .animate({ border: "3px solid red"},500 ,function (){
          $("#"+num+"b").css("z-index", "0").css("border", "none"); 
           }) ;
       }
       
    });
    
} ;