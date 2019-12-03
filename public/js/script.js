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

async function deleteItem(itemId){
	var deleteBtn = document.getElementById('deleteItem'+itemId);
	deleteBtn.innerHTML = "Confirmer la suppression";
	await sleep('100');
	deleteBtn.href = "index.php?a=deleteItem&itemId="+itemId;
}



function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
