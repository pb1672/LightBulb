
$("#psubmit").click( function(e) {
	
	e.preventDefault();
    	e.stopImmediatePropagation();
	//var data = $("#myform :input").serializeArray();
	
	$.ajax({
      url: 'php/putuser.php',
      type: 'post',
      data: $('#pform').serialize(),
      success: function(info) {
		$("#profilepage").empty();
		session_user = info;	
		getuser(session_user);
		$("#profilepage").html(session_user);
		
	  }});
		
		
	$("#pform").submit(function() {
		return false;
		});
	
 
});

$("#btnLogin").click( function(e) {
	e.preventDefault();
    	e.stopImmediatePropagation();
    //alert("hi");
    
		
	//var data = $("#myform :input").serializeArray();
	
	$.ajax({
      url: 'php/login.php',
      type: 'post',
      data: $('#frmLogin').serialize(),
      success: function(info) {
		if (info > 0)

		getuser(info);
	  }});
		
		
	$("#frmLogin").submit(function() {
		return false;
		});
	
 
});


function getuser(UID) {
	
	$.ajax({
      url: 'php/getuser.php',
      type: 'post',
      data: {'id': UID},
      success: function(info) {
	
		$("#profilepage").empty();
		userData = info.split("$$");
		var str =  "<h1>Your Profile</h1>";
 		str = str + "<h5>";
 		str = str + "<br>First Name : " + userData[1];  
 		str = str + "<br>Last Name : " + userData[3];
 		str = str + "<br>Email : " + userData[2];
 		str = str + "<br>Education : " + userData[4];
 		str = str + "</h5>"; 	
		//getuser(session_user);
		$("#pdata").html(str);
		getIdeas(UID);
		location.href = "#homepage";

		
	  }});
	
	
	}
	
	function getIdeas(UID){

		$.ajax({
      url: 'php/getidea.php',
      type: 'post',
      data: {'id': UID},
      success: function(info) {
	
		//$("#profilepage").empty();
		var test = info.trim();
	    if(test == "err" )
			info = "No ideas have been added by you.";

		//getuser(session_user);
		$("#ideaContainer").html(info);
		//location.href = "#homepage";
		
	  }});

	}

$("#isubmit").click( function() {
	
	//alert("triggered");
	//var data = $("#myform :input").serializeArray();
	
	$.ajax({
      url: 'php/putidea.php',
      type: 'post',
      data: $('#iform').serialize(),
      success: function(info) {
      //	alert(info);
		//$("#ideapage").empty();
		//$("#ideapage").html(info);
		getIdeas(info);
		location.href = "#homepage";
	  }});
		
		
	$("#iform").submit(function() {
		return false;
		});
	
 
});



// JavaScript Document

function ajaxObj( meth, url ) {
	var x = new XMLHttpRequest();
	x.open( meth, url, true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.readyState == 4 && x.status == 200){
	    return true;	
	}
}

function _(x){

	return document.getElementById(x);
}


$("#btnExplore").click( function() {

	//alert("loading");
	getFeeds(1);
});

function getFeeds(UID){
	

	/*$.ajax({
      url: 'swipe/swipe.php',
      type: 'get',
      data: {'q': UID},
      success: function(info) {
	
		//$("#profilepage").empty();
		
		$("#container").html(info);
		location.href = "#swipe";
		
	  }});*/
	//var q = user ;
	
	//alert("feeds");
	
		//_("loginbtn").style.display = "none";
		_("container").innerHTML = 'loading feeds ...';
		
		var ajax = ajaxObj("POST", "swipe/feeds.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	        	var test = (ajax.responseText).trim();
	            if(test == "err" ){
					_("container").innerHTML = "No feeds to show.";
					alert("No more ideas to view...");
					location.href = "#homepage";
				} else {
					_("container").innerHTML = ajax.responseText;
					//alert("setRequestHeader");
					addSwipe();
					location.href = "#swipe";
				}
	        }
        }
       // ajax.send("q="+q+"&m=all");
		ajax.send();	
}

function unlike(postid)
{
	//var my_delay = 100000;
		
	//alert("unlike"  + postid);
	$.ajax({
      url: 'swipe/unlike.php',
      type: 'post',
      data: {'id': postid},
      success: function(info) {
	
		var delay=800; //1 seconds

setTimeout(function(){
  var divname = "div" + postid;
	            
					_(divname).innerHTML = "";
					_(divname).className = "";
					var x = document.getElementsByClassName("buddy").length;
					if (x == 0)
					{
						alert("No more ideas...");
						location.href = "#homepage";
					}

}, delay); 
		//getFeeds(1);//alert(info);
	  }});
}

function like(postid)
{
	
	//var my_delay = 100000;
	//alert("like "  + postid);
	$.ajax({
      url: 'swipe/like.php',
      type: 'post',
      data: {'id': postid},
      success: function(info) {
	//alert(info);
			
	var delay=800; //1 seconds

setTimeout(function(){
  var divname = "div" + postid;
	            
					_(divname).innerHTML = "";
					_(divname).className = "";
					var x = document.getElementsByClassName("buddy").length;
					if (x == 0)
					{
						alert("No more ideas...");
						location.href = "#homepage";
					}

}, delay); 

			//getFeeds(1);
		
	  }});
	
}





 
 function addSwipe()
 {
 	$(".buddy").on("swiperight",function(){
      $(this).addClass('rotate-left').delay(700).fadeOut(1);
      $('.buddy').find('.status').remove();
      like($(this).attr("title"));
      $(this).append('<div class="status like">Like!</div>');      
      if ( $(this).is(':last-child') ) {
        $('.buddy:nth-child(1)').removeClass ('rotate-left rotate-right').fadeIn(300);
       //  $(this).innerHTML = "No more ideas";
         // alert("End");
       } else {
          $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
       }
    });  

   $(".buddy").on("swipeleft",function(){
    $(this).addClass('rotate-right').delay(700).fadeOut(1);
    $('.buddy').find('.status').remove();
    unlike($(this).attr("title"));
    $(this).append('<div class="status dislike">Dislike!</div>');

    if ( $(this).is(':last-child') ) {
     $('.buddy:nth-child(1)').removeClass ('rotate-left rotate-right').fadeIn(300);
      //$(this).innerHTML = "No more ideas";
      //alert("End");
     } else {
        $(this).next().removeClass('rotate-left rotate-right').fadeIn(400);
    } 
  });
 }