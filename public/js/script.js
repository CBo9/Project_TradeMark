window.onscroll = function() {NavbarOnScroll()};

const navLinks = document.getElementById("navbar").innerHTML;
function NavbarOnScroll() {
  if (document.body.scrollTop > 25 || document.documentElement.scrollTop > 25) {
  	
    document.getElementById("navbar").style.padding = "10px 10px";
    document.getElementById("navbar").style.backgroundColor = "#790e0e";
    $('#navbar>a,#userSlide>a,#navRight>a').css("opacity","0.6");
    $('#navbar>a,#userSlide>a,#navRight>a').css("font-size","1.3em");
  } else {
    document.getElementById("navbar").style.padding = "50px 10px";
    document.getElementById("navbar").style.backgroundColor = "rgba(217,3,3,1)";
    document.getElementById("navbar").innerHTML= navLinks;
  }
  userNav = "inactive";
} 

function formValidation(){
  let passwordC = document.getElementById("password1").value;
  let passwordConfirmation = document.getElementById("password2").value;

  if(passwordC != passwordConfirmation){
    document.getElementById("passwordError").innerHTML = "Les mots de passe ne sont pas identiques!"; 
  }else{
    document.getElementById("passwordError").innerHTML = ""; 
  }
document.getElementById("password1").addEventListener('input',formValidation);
}

function suubmit(){
  if(document.getElementById("password1").value == document.getElementById("password2").value){
    return true;
  }else{return false;}
}

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

    document.getElementById('emptyAvatar').innerHTML = "ANNULER";
}


function chatScroll(){
	let chatWindow = document.getElementById('AllMessages');
	let chatHeight = chatWindow.scrollHeight;
	console.log(chatHeight);
	chatWindow.scrollTo({
	  top: chatHeight,
	  left: 0,
	 
	});
}

function deleteFile(){
	document.getElementById('emptyAvatar').innerHTML = "Avatar par défaut";
	document.getElementById('avatar').value="";
	document.getElementById('preview').src="public/img/avatars/default.png";
}

function deleteAccount(userId){
	var deleteAccount = confirm('Voulez-vous vraiment supprimer votre compte? \nVos informations et vos articles seront supprimés définitivement');
	if(deleteAccount == true){
		document.location.replace('index.php?a=deleteAccount&id='+userId);
	}

}
