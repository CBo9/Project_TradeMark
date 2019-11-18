window.onscroll = function() {NavbarOnScroll()};

const navLinks = document.getElementById("navbar").innerHTML;
function NavbarOnScroll() {
  if (document.body.scrollTop > 25 || document.documentElement.scrollTop > 25) {
  	
    document.getElementById("navbar").style.padding = "10px 10px";
    document.getElementById("navbar").style.backgroundColor = "#790e0e";
    $('#navbar>a').css("opacity","0.6");
    $('#navbar>a').css("font-size","1.3em");
  } else {
    document.getElementById("navbar").style.padding = "50px 10px";
    document.getElementById("navbar").style.backgroundColor = "rgba(217,3,3,1)";
    document.getElementById("navbar").innerHTML= navLinks;
      }
} 

function formValidation(){
  let passwordC = document.getElementById("password1").value;
  let passwordConfirmation = document.getElementById("password2").value;
  console.log("password :" + passwordC);
  console.log("password 2 :"+ passwordConfirmation);

  if(passwordC != passwordConfirmation){
    document.getElementById("passwordError").innerHTML = "Les mots de passe ne sont pas identiques!"; 
  }else{
    document.getElementById("passwordError").innerHTML = ""; 
  }
document.getElementById("password1").addEventListener('change',formValidation);
}

function suubmit(){
  if(document.getElementById("password1").value == document.getElementById("password2").value){
    return true;
  }else{return false;}
}