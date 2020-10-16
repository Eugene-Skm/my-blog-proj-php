var sname="";

function imgselected(){
	var elements = document.getElementsByName("imgselect");

	// 選択状態の値を取得
	for ( var a="", i=elements.length; i--; ) {
		if ( elements[i].checked ) {
			var a = elements[i].value;
			var b = elements[i].id;
			
			break ;
		}
	}
	window.opener.form.imid.value=b;
	localStorage.setItem('useimgID', a);
	window.close();
}
function newimagepage(){
	document.getElementById("modalwrap").style.display="inline-block";
	//window.open('newimagepage.php','newwindow','width=400,height=300')
	/*setTimeout(newimgcheck,2000);
	window.open('newimagepage.php', null, 'width=500,toolbar=yes,menubar=yes,scrollbars=yes')*/
	

}/*
onload=function(){
	const target = document.getElementById('newimagesel');
}*/
