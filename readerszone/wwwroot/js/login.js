function ShowPassword(cb){
    if(cb.checked == true){
        document.getElementsByName("Passwordl")[0].type="text";
    }
    else{
        document.getElementsByName("Passwordl")[0].type="password";
    }

}
function Insert(){
    if(tac.checked != true){
        alert("You Must Agree The Terms and Conditions");
        return;
    }
    UserName = document.getElementsByName("UserName")[0].value;
    Password = document.getElementsByName("Password")[0].value;
    Email = document.getElementsByName("Email")[0].value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200){
            if(this.responseText == "Please fill all Fields")
            {
                alert(this.responseText);
                return;
            }
            alert(this.responseText);
            window.location.reload(true);
        }
    }
    xmlhttp.open("GET","dal/signUp.php?UserName="+UserName+"&Password="+Password+"&Email="+Email,true);
    xmlhttp.send();
}
function CheckLogin(){
    UserName = document.getElementsByName("UserNamel")[0].value;
    Password = document.getElementsByName("Passwordl")[0].value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if( this.readyState == 4 && this.status == 200){
            if(this.responseText == "true")
            {
                //alert('Welcome');
                location.href = "home/home.php";
            }
            else
                alert(this.responseText);
        }
    }
    xmlhttp.open("GET","dal/login.php?UserName="+UserName+"&Password="+Password,true);
    
    xmlhttp.send();
}

var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("btn");

function register(){
    x.style.left = "-450px";
    y.style.left = "0px";
    z.style.left = "110px";
}

function login(){
    x.style.left = "5px";
    y.style.left = "450px";
    z.style.left = "0px";
}