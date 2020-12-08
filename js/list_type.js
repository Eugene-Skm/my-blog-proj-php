function bol(pflg){
	
	switch (pflg){
		case 1:
			var lt = localStorage.getItem("ListType_d");
			document.getElementById(lt).checked=true;
			change_check();
			break;
		case 2:
			var lt = localStorage.getItem("ListType_w");
			document.getElementById(lt).checked=true;
			change_check_w();
			break;
	}
}

function change_check() {
	var type = document.getElementsByName("list_type_radio");
	var articles = document.getElementById("articles_list");
	var article = document.getElementsByClassName("article");
	var articlethumb = document.getElementsByClassName("article_thumb_p");
    for (var i = 0; i < type.length; i++) {
        if (type[i].checked) {
			console.log(type[i].id)
			localStorage.setItem('ListType_d', type[i].id);
            if (type[i].value == "GRID") {
                
				
				articles.style.gridTemplateColumns = "50% 50%";
				
               for (var i = 0; i < article.length; i++) {
                    article[i].style.gridTemplateColumns = "100%";
					article[i].style.height = "auto";
					articlethumb[i].style.height="150px";
					//articlethumb[i].style.width="90%";
                }
            }else if (type[i].value == "BGCOLUMN") {
				articles.style.gridTemplateColumns = "100%";
				for (var i = 0; i < article.length; i++) {
					article[i].style.gridTemplateColumns = "100%";
					
					article[i].style.height = "auto";
					articlethumb[i].style.height="250px";
				}
			}else if (type[i].value == "COLUMN") {
				articles.style.gridTemplateColumns = "100%";

				for (var i = 0; i < article.length; i++) {
                    article[i].style.gridTemplateColumns = "25% 75%";
					article[i].style.height = "auto";
					articlethumb[i].style.height="100%";
					articlethumb[i].style.width="100%";
                }

			}
        }
    }
}
function change_check_w() {
	var type = document.getElementsByName("list_type_radio");
	var works = document.getElementById("works_list");
	var work = document.getElementsByClassName("article");
	var workthumb = document.getElementsByClassName("article_thumb_p");
    for (var i = 0; i < type.length; i++) {
        if (type[i].checked) {
			console.log(type[i].id)
			localStorage.setItem('ListType_w', type[i].id);
            if (type[i].value == "GRID") {
                
				
				works.style.gridTemplateColumns = "50% 50%";
				
               for (var i = 1; i < work.length; i++) {
                    work[i].style.gridTemplateColumns = "100%";
					work[i].style.height = "auto";
					work[i].style.minheight = "300px";
					workthumb[i].style.height="150px";
					//workthumb[i].style.width="90%";
                }
            }else if (type[i].value == "BGCOLUMN") {
				works.style.gridTemplateColumns = "100%";
				for (var i = 1; i < work.length; i++) {
					work[i].style.gridTemplateColumns = "100%";
					workthumb[i].style.height="250px";
				}
			}else if (type[i].value == "COLUMN") {
				works.style.gridTemplateColumns = "100%";

				for (var i = 1; i < work.length; i++) {
                    work[i].style.gridTemplateColumns = "35% 65%";
					work[i].style.height = "auto";
					work[i].style.minheight = "120px";
					workthumb[i].style.height="100%";
					//workthumb[i].style.width="100%";
                }

			}
			
        }
    }
}