function imgselected(){
	var elements = document.getElementsByName("imgselect");

	// 選択状態の値を取得
	for ( var a="", i=elements.length; i--; ) {
		if ( elements[i].checked ) {
			var a = elements[i].value;
			//var b = document.getElementById(a).value;
			break ;
		}
	}

	if ( a === "" ) {
		// 未選択状態
	} else {
		// aには選択状態の値が代入されている
		console.log( a ) ;
		//console.log( b ) ;
		
		localStorage.setItem('useimgID', a);
		window.close();
	}
}
function newimagepage(){
	window.open('newimagepage.php', 'width=500')
}
onload=function(){
	const target = document.getElementById('newimagesel');
}

