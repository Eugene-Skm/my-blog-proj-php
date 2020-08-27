
function img_change(img_id){
	var simg_list =document.getElementsByClassName("s_img");
	for(var x=0; x<simg_list.length; x++){
		document.getElementById(simg_list[x].id).style.display="none";
	}
	document.getElementById(img_id).style.display="inline-block";
}