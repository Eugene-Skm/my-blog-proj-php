var sname="";
localStorage.setItem('useimgID', "null");


setInterval(function(){
	document.getElementById("editorh").value=document.getElementById("editor").innerHTML;
	sname=localStorage.getItem("useimgID");
	if(sname!="null"){
		document.getElementById("imgname").innerHTML=sname;
		document.getElementById("thumbsample").src="blogimgs/"+sname;
		document.getElementById("thumsamplewrap").style.display="inline-flex";
	}
	titlec=document.getElementById("atitle").value.length;
	discc=document.getElementById("description").value.length;
	contc=document.getElementById("editorh").value.length;
	if(titlec>=5&&discc>=10&&contc>=400){
		document.getElementById("submit").disabled=false;
	}else{
		document.getElementById("submit").disabled=true;
	}
},2000)

function openimgchoice(){
	localStorage.setItem('useimgID', "null");
	window.open('imglistpage.php', null, 'width=500,toolbar=yes,menubar=yes,scrollbars=yes')
}
