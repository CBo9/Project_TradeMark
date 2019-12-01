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
function signOutConfirm(){
	var signOut = confirm("Voulez-vous vraiment vous déconnecter?");
	if (signOut == true){
		document.location.replace('./index.php?a=signOut');
	}
}