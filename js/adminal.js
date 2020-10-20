
function delconfirm(id,ti){
	document.getElementById("modalwrap").style.display='inline-block';
	document.getElementById("AD").style.display='inline-block';
	document.getElementById("VC").style.display='none';
	document.getElementById("A_id").value=id;
	document.getElementById("confirmtex").innerHTML='<p>記事ID：'+id+'</P><p>タイトル：'+ ti+'</P><p>削除しますか？この操作は元に戻せません</P>';
}
function visibilCha(id,vs){
	document.getElementById("modalwrap").style.display='inline-block';
	document.getElementById("AD").style.display='none';
	document.getElementById("VC").style.display='inline-block';
	document.getElementById("A_id").value=id;
	switch (vs){
		case 1:
			document.getElementById("vs1").selected="true"
			break;
		case 0:
			document.getElementById("vs0").selected="true"
			break;
	}
}