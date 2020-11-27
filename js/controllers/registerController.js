var base_ul ='../webservices/';
//here is the controller for client and paractioner registration
//press button when enter is pressed with mouse within the body
window.onload=function(){
  document.getElementById("body")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("docreg").click();
    }
});

  document.getElementById("body")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("clientreg").click();
    }
});

 document.getElementById("body")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("pharmactreg").click();
    }
});

};
  
        

//function to register  client
function registerClient()
{
//retrieving values from ui
var fullname=document.getElementById('fullname').value;
var email=document.getElementById('email').value;
var phoneNumber=document.getElementById('phoneNumber').value;
var pass=document.getElementById('pass').value;
// var passcom=document.getElementById('passcom').value;
// var cgender=document.getElementById('cgender').value;
// var caddesss=document.getElementById('caddesss').value;

//regex for email validation 
const re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
//regex for password validation 
const passre=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{5,}$/;

const phonevali =/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

//validation 

if (email==""||phoneNumber==""||pass==""||phonevali.test(phoneNumber)==false||re.test(email)==false){
     document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Please all fields are required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('fullname').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);
}
else if (fullname=="")
    {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Fullname is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('fname').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);
  }

   
 else if (email=="")
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Email is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('email').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 }
  else if (phoneNumber=="")
 {
        document.getElementById('alert').style.display='';
        document.getElementById('alert').innerHTML='Phone number is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('phoneNumber').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 }
 
 else if (re.test(email)==false)
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Valid email is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('email').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 }

 else if (pass=="") 
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Password is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('pass').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 }
 // else if (passcom=="") 
 // {
 //        document.getElementById('alert').style.display='block';
 //        document.getElementById('alert').innerHTML='Confirm password';
 //        document.getElementById('alert').class="btn btn-warning"
 //        document.getElementById('passcom').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert').style.display="none";
 //        }, 5000);

 // }
 else if(passre.test(pass)==false)
 {
    document.getElementById('alert').style.display='block';
    document.getElementById('alert').innerHTML='Pasword Should have At least one uppercase letter, one lowercase letter, one digit,one special symbol, more than 4 characters';
    document.getElementById('alert').class="btn btn-warning"
    document.getElementById('pass').focus();
    setTimeout(function(){
    document.getElementById('alert').style.display="none";
    }, 5000);

 }
 // else if (passcom!=pass)
 // {
 //        document.getElementById('alert').style.display='block';
 //        document.getElementById('alert').innerHTML='Passwords do not match';
 //        document.getElementById('alert').class="btn btn-warning"
 //        document.getElementById('pass').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert').style.display="none";
 //        }, 5000);

 // }
 else if (!byId('tnc').checked)
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Agree to our terms and conditions';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('tnc').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 

}
//end of validation
else
{       //create form data and append validated variables
        var fd = new FormData;
        fd.append('fullname',fullname);
        fd.append('email',email);
        fd.append('phoneNumber',phoneNumber);
        fd.append('password',pass);
        localStorage.setItem('email',JSON.stringify(email));
        sessionStorage.setItem('email',JSON.stringify(email));

        $('#logging_in').modal('show')
        // raise a post xhr request to service
        var xhr= new XMLHttpRequest();
      

        xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200)
            {
                var resp = JSON.parse(this.responseText);
            if (resp.response=="E-mail exist") {
                 $('#logging_in').modal('hide');
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='E-mail Address is already exist please try another E-mail Address';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                    return false;
            }
            else  if (resp.response=="Phone Exist") {
                 $('#logging_in').modal('hide');
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Phone number is already exist please try another Phone number ';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                    return false;
            }
           
            
            else if (resp.response==true){
                $('#logging_in').modal('hide');
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Account Successfully Created you may check your email address';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);

                    setTimeout(function(){
                      direct('email_verification');
                      }, 5000);
                    
                     
              }
              else{
                   $('#logging_in').modal('hide');
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong contact Ustawi Techinical Team';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
              }   
                
            }
        }
        //send form data
          xhr.open('POST',base_ul+'patient/patient_register.php',true);
        xhr.send(fd);

}
//end of else validate statement


}



function registerDoc() {
    //regex for email validation
const re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
//regex for password validation
const passre=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{5,}$/;
const phonevaldatedoc =/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
var MDPCZ_ID=byId('MDPCZ_ID').value;
var dfullname=byId('dfullname').value;
var email=byId('emailAddress').value;
var password=byId('password').value;




if (MDPCZ_ID=="")
    {
        document.getElementById('alert1').style.display='block';
        document.getElementById('alert1').innerHTML='MDPCZ ID is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('MDPCZ_ID').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);
    }
 
  else if (dfullname=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Fullame is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('dfullname').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }


 //  else if (lastname=="")
 // {
 //        document.getElementById('alert1').style.display='block';
 //        document.getElementById('alert1').innerHTML='Last Name is required';
 //        document.getElementById('alert1').class="btn btn-warning"
 //        document.getElementById('lastname').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert1').style.display="none";
 //        }, 5000);

 // }
 

 else if (email=="")
 {
        document.getElementById('alert1').style.display='block';
        document.getElementById('alert1').innerHTML='Email address is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('email').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (re.test(email)==false)
 {
        document.getElementById('alert1').style.display='block';
        document.getElementById('alert1').innerHTML='Valid email is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('email').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }

 

 
 

 else if (password=="") 
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Password is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('password').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 // else if (passwordcon=="") 
 // {
 //        document.getElementById('alert1').style.display='';
 //        document.getElementById('alert1').innerHTML='Confirm password';
 //        document.getElementById('alert').class="btn btn-warning"
 //        document.getElementById('passwordcon').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert1').style.display="none";
 //        }, 5000);

 // }
 else if(passre.test(password)==false)
 {
    document.getElementById('alert1').style.display='';
    document.getElementById('alert1').innerHTML='Pasword Should have At least one uppercase letter, one lowercase letter, one digit,one special symbol, more than 4 characters';
    document.getElementById('alert1').class="btn btn-warning"
    document.getElementById('password').focus();
    setTimeout(function(){
    document.getElementById('alert1').style.display="none";
    }, 5000);

 }
 // else if (passwordcon!=password)
 // {
 //        document.getElementById('alert1').style.display='';
 //        document.getElementById('alert1').innerHTML='Passwords do not match';
 //        document.getElementById('alert1').class="btn btn-warning"
 //        document.getElementById('password').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert1').style.display="none";
 //        }, 5000);

 // }
   else if (!byId('tncdo').checked)
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Agree to our terms and conditions';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('tncdo').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 } 

else{
var fd = new FormData;
fd.append('MDPCZ_ID',MDPCZ_ID);
fd.append('fullname',dfullname);
fd.append('email',email);
fd.append('password',password);
   


   byId('docreg').innerHTML='Loading.....'
   $('#logging_in').modal('show')
        var xhr= new XMLHttpRequest();     
        
     xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
            { 
                var resp = JSON.parse(this.responseText);
                if(resp.response ==true)
                {
                     byId('docreg').innerHTML='Register Now'
                     $('#logging_in').modal('hide')
                         byId('success1').style.display='block';
                         byId('success1').innerHTML='Account Successfully Created';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                    setTimeout(function(){
                      direct('doc_email_verification');
                      }, 5000);

                }
                else{
                     byId('docreg').innerHTML='Register'
                     $('#logging_in').modal('hide')
                         byId('alert1').style.display='block';
                         byId('alert1').innerHTML='Email address already Exist please choose anaother email';
                    setTimeout(function(){
                         byId('alert1').style.display="none";
                    }, 5000);

                } 

            }
        }
        xhr.open('POST',base_ul+'doctor/doctor.php',true);
        //send form data
        xhr.send(fd);
}
}


/*/============================== Medical paractioner/================================*/

function registerPhamacistacc() {
    //regex for email validation
const re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
//regex for password validation
const passre=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{5,}$/;
const phonevaldatedoc =/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;


var pfullname=byId('pfullname').value;
// var plastname=byId('plastname').value;
var pphoneNumber=byId('pphone1').value;
var pemail=byId('pemailAddress').value;
var ppassword=byId('ppassword').value;
// var ppasswordcon=byId('ppasswordcon').value;
//var ptncdo=byId('ptncdo').value;

 
if (pfullname=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Phone number is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('pphoneNumber').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (pemail=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Email address is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('pemail').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (re.test(pemail)==false)
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Valid email is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('pemail').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 //  else if (phonevaldatedoc.test(pphoneNumber)==false)
 // {
 //        document.getElementById('alert1').style.display='';
 //        document.getElementById('alert1').innerHTML='Valid Phone is required pleas';
 //        document.getElementById('alert1').class="btn btn-warning"
 //        document.getElementById('pemail').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert1').style.display="none";
 //        }, 5000);

 // }
 // else if (paddress=="")
 // {
 //        document.getElementById('alert1').style.display='';
 //        document.getElementById('alert1').innerHTML='Address is required';
 //        document.getElementById('alert1').class="btn btn-warning"
 //        document.getElementById('paddress').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert1').style.display="none";
 //        }, 5000);

 // }



 
 

 else if (ppassword=="") 
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Password is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('ppassword').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 // else if (ppasswordcon=="") 
 // {
 //        document.getElementById('alert1').style.display='';
 //        document.getElementById('alert1').innerHTML='Confirm password';
 //        document.getElementById('alert').class="btn btn-warning"
 //        document.getElementById('ppasswordcon').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert1').style.display="none";
 //        }, 5000);

 // }
 else if(passre.test(ppassword)==false)
 {
    document.getElementById('alert1').style.display='';
    document.getElementById('alert1').innerHTML='Pasword Should have At least one uppercase letter, one lowercase letter, one digit,one special symbol, more than 4 characters';
    document.getElementById('alert1').class="btn btn-warning"
    document.getElementById('ppassword').focus();
    setTimeout(function(){
    document.getElementById('alert1').style.display="none";
    }, 5000);

 }
 // else if (ppasswordcon!=ppassword)
 // {
 //        document.getElementById('alert1').style.display='';
 //        document.getElementById('alert1').innerHTML='Passwords do not match';
 //        document.getElementById('alert1').class="btn btn-warning"
 //        document.getElementById('ppassword').focus();
 //        setTimeout(function(){
 //        document.getElementById('alert1').style.display="none";
 //        }, 5000);

 // }
   else if (!byId('ptncdo').checked)
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Agree to our terms and conditions';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('ptncdo').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 } 

else{
var fd = new FormData;
fd.append('fullname',pfullname);
// fd.append('lastname',plastname);
fd.append('phoneNumber',pphoneNumber);
fd.append('email',pemail);
fd.append('password',ppassword);
   $('#logging_in').modal('show')
        var xhr= new XMLHttpRequest();     
       
     xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
            { 
                var resp = JSON.parse(this.responseText);
                if(resp.response ==true)
                {
                     // byId('docreg').innerHTML='Register Now'
                     $('#logging_in').modal('hide')
                         byId('success1').style.display='block';
                         byId('success1').innerHTML='Account Successfully Created';
                    setTimeout(function(){
                    document.getElementById('success1').style.display="none";
                    }, 5000);

                    setTimeout(function(){
                      direct('pharmacist_email_verification');
                      }, 1000);

                }
                else{
                     // byId('docreg').innerHTML='Register Now'
                     $('#logging_in').modal('hide')
                         byId('alert1').style.display='block';
                         byId('alert1').innerHTML='Email address already Exist please choose anaother email';
                    setTimeout(function(){
                         byId('alert1').style.display="none";
                    }, 5000);

                } 

            }
        }
         xhr.open('POST',base_ul+'pharmacy/register.php',true);
        //send form data
        xhr.send(fd);
}
}



/*============================================================================================*/

//Facebook Login Javascript Functions  Start here
function fblogin(){
function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
      testAPI();  
    } else {                                 // Not logged into your webpage or we are unable to tell.
      document.getElementById('alert').innerHTML = 'Please log ' +
        'into this webpage.';
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '893704577787665',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v2.8',         // Use this Graph API version for this call.
      status     : true
    });


    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
      statusChangeCallback(response);        // Returns the login status.
    });
  };
 
  function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('success').innerHTML ='Thanks for logging in, ' + response.name + '!';
    });
  }
}
  //Facebook Login Javascript Functions  ends  here



// telthemlibs
function direct(address) {
    
    var windowlocation = window.location.href;
    var directory = windowlocation.substring(0,windowlocation.lastIndexOf("/") +1);
    window.location.href=directory+address+".php";
}

    function phonenumber(inputtxt)
    {
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(phoneno))
         {

            var corrects = byId('corrects')
            corrects.style.display="block";
            corrects.innerHTML="Valid Phone Number"

            setTimeout(function(){
               corrects.style.display="none";
            }, 500);
           return true;
         }
       else
         {
            var erro = byId('errorPhone')
            erro.style.display="block";
            erro.innerHTML="Phone Number is not a valid  please enter valid Phone Number "
           inputtxt.style.backgrountColor="#000";
             setTimeout(function(){
               erro.style.display="none";
            }, 5000);
           return false;
         }
    }

    
    function clientphonenumber(inputtxt)
    {
      var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      if(inputtxt.value.match(phoneno))
         {

            var clcorrects = byId('clcorrects')
            clcorrects.style.display="block";
            clcorrects.innerHTML="Valid Phone Number"

            setTimeout(function(){
               clcorrects.style.display="none";
            }, 5000);
           return true;
         }
       else
         {
            var clerrorPhone = byId('clerrorPhone')
            clerrorPhone.style.display="block";
            clerrorPhone.innerHTML="Phone Number is not please enter valid Phone Number"
         setTimeout(function(){
               clerrorPhone.style.display="none";
            }, 5000);
           return false;
         }
    }
function byId(id) {
    return document.getElementById(id);
}