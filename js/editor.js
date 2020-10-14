
setInterval(function(){
	console.log(document.getElementById("editor").innerHTML);
	document.getElementById("editorh").value=document.getElementById("editor").innerHTML;

},10000)
