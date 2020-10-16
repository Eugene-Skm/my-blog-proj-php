var sname="";
localStorage.setItem('useimgID', "null");

setTimeout('x()',2000);

function x(){
	console.log("X")
	sname=localStorage.getItem("useimgID");
	if(sname!="null"){
		valueset(sname);
		sname=""
		localStorage.setItem('useimgID', "null");
	}
	titlec=document.getElementById("atitle").value.length;
	discc=document.getElementById("description").value.length;
	contc=document.getElementById("editor-input").value.length;
	if(titlec>=5&&discc>=10&&contc>=400){
		try{
			document.getElementById("submit").disabled=false;
		}catch(e){}
		try{
			document.getElementById("submit2").disabled=false;
		}catch(e){}
	
	}else{
		try{
			document.getElementById("submit").disabled=false;
		}catch(e){}
		try{
			document.getElementById("submit2").disabled=false;
		}catch(e){}
	}
	setTimeout(x,2000);
}
function valueset(sn){
	document.getElementById("imgname").innerHTML=sn;
	document.getElementById("thumbsample").src="blogimgs/"+sn;
	document.getElementById("thumsamplewrap").style.display="inline-flex";
}

function openimgchoice(){
	localStorage.setItem('useimgID', "null");
	window.open('imglistpage.php', null, 'width=500,toolbar=yes,menubar=yes,scrollbars=yes')
}
