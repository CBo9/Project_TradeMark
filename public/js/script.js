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


function getChatWith(userId){
	document.location.replace('./index.php?a=chat&userId='+userId);
}

function footer(){
	var footer = document.getElementById('footer');
	var footerHeight = footer.style.height;
	var body = document.getElementById('body');
	var bodyHeight = body.style.height;
		if(bodyHeight == 900){
			document.getElementById('container').style.minHeight = bodyHeight - footerHeight;
		}
	}
	
document.onload = footer();


function updateFormFill(name, description, picture){
	var inputName = document.getElementById('name');
	var inputDescription = document.getElementById('description');
	var picturePreview = document.getElementById('preview');

	inputName.value = name;
	inputDescription.innerHTML = description;
	document.getElementById('addFileText').style.display="none";
	picturePreview.style.display ="block";
	picturePreview.src ="public/img/items/" + picture;
}

function itemPicturePreview(){
    var reader = new FileReader();
    reader.onload = function(){
		var picturePreview = document.getElementById('preview');
		picturePreview.src = reader.result;
		document.getElementById('addFileText').style.display="none";
    }
    reader.readAsDataURL(event.target.files[0]);
}


function itemPicturePreview(){
    var reader = new FileReader();
    reader.onload = function(){
		var picturePreview = document.getElementById('preview');
		picturePreview.src = reader.result;
		document.getElementById('addFileText').style.display="none";
    }
    reader.readAsDataURL(event.target.files[0]);
}

function avatarPreview(){
	var reader = new FileReader();
    reader.onload = function(){
		var avatarPreview = document.getElementById('preview');
		avatarPreview.src = reader.result;
		document.getElementById('addFileText').style.display="none";
    }
    reader.readAsDataURL(event.target.files[0]);
}


function chatScroll(){
	let chatWindow = document.getElementById('AllMessages');
	let chatHeight = chatWindow.scrollHeight;
	console.log(chatHeight);
	chatWindow.scrollTo({
	  top: chatHeight,
	  left: 0,
	  behavior: 'smooth'
	});
}