var userNav = "inactive";

function userNavSlide(){
	if(userNav == "inactive"){
		document.getElementById('userNav').style.display ="block";
		userNav = "active";
	}else{
		document.getElementById('userNav').style.display ="none";
		userNav = "inactive";
	}
}