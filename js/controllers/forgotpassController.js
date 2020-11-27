var base_ul ='../webservices/';
function forgot(){
    let role  =byId('role').value;
    let email =byId('femail').value;


    let fd  = new FormData

    fd.append('role',role)
    fd.append('email',email)

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if (xhr.readyState ==4 && xhr.status==200){
            var resp=JSON.parse(this.responseText);
            if(resp.response == true){
                swal({
                    title: "Anywhere Healthcare",
                    text: "We have sent a message to check your email",
                    icon: "success",
                    button: "ok",
                  });

                  setTimeout(function(){
                    emaildirect("https://mail.google.com/mail/u/0/")
                  },200)
                  
    
              }
        }
    }
    xhr.open('POST',base_ul+'forgot.php',true);
    xhr.send(fd);
    
}



function validate(){

    if(!byId("password").value==byId("cpassword").value)alert("Passwords do no match");
    return byId("password").value==byId("cpassword").value;
   return false; 
}


function byId(id) {
    return document.getElementById(id);
}

function direct(address) {
    
    var windowlocation = window.location.href;
    var directory = windowlocation.substring(0,windowlocation.lastIndexOf("/") +1);
    window.location.href=directory+address+".php";
}

function emaildirect(address) {  
    window.location.href=address;
}