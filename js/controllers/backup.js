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

};
  
        

//function to register  client
function registerClient()
{
//retrieving values from ui
var fname=document.getElementById('fname').value;
var lname=document.getElementById('lname').value;
var email=document.getElementById('email').value;
var phoneNumber=document.getElementById('phoneNumber').value;
var pass=document.getElementById('pass').value;
var passcom=document.getElementById('passcom').value;
var cgender=document.getElementById('cgender').value;
var caddesss=document.getElementById('caddesss').value;
var tnc=document.getElementById('tnc').value;

//regex for email validation 
const re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
//regex for password validation 
const passre=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{5,}$/;

const phonevali =/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

//validation 

if(fname==""||lname==""||email==""||phoneNumber==""||pass==""||passcom==""||cgender==""||caddesss==""||tnc==""||pass!==passcom||passre.test(pass)==false||phonevali.test(phoneNumber)==false||re.test(email)==false||tnc.checked=false){
    if (fname=="")
    {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='First Name is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('fname').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);
  }
 else if (lname=="")
  {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Last Name is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('lname').focus();
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
  else if (cgender=="")
  {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Please choose gender is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('cgender').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);
 }
  else if (caddesss=="")
  {

        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Addess is required';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('caddesss').focus();
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

 else if (phonevali.test(phoneNumber)==false)
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Not a valid Phone Number please enter valid phone';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('phoneNumber').focus();
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
 else if (passcom=="") 
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Confirm password';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('passcom').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 }
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
 else if (passcom!=pass)
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Passwords do not match';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('pass').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 }
 else if (tnc.checked ='off')
 {
        document.getElementById('alert').style.display='block';
        document.getElementById('alert').innerHTML='Agree to our terms and conditions';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('tnc').focus();
        setTimeout(function(){
        document.getElementById('alert').style.display="none";
        }, 5000);

 }

}
//end of validation
else
{       //create form data and append validated variables
        var fd = new FormData;
        fd.append('firstname',fname);
        fd.append('lastname',lname);
        fd.append('email',email);
        fd.append('phoneNumber',phoneNumber);
        fd.append('password',pass);
        fd.append('gender',cgender);
        fd.append('address',caddesss);
        localStorage.setItem('email',JSON.stringify(email));
        sessionStorage.setItem('email',JSON.stringify(email));


        // raise a post xhr request to service
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'patient/patient_register.php',true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200)
            {
                var resp = JSON.parse(this.responseText);
            if (resp.response=="E-mail Address is already exist please try another E-mail Address") {
                 $('#logging_in').modal('hide');
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='E-mail Address is already exist please try another E-mail Address';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                    return false;
            }
            else if (resp.response=="Phone is already exist please try another phone Number") {
                $('#logging_in').modal('hide');
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Phone is already exist please try another phone Number';
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
        xhr.send(fd);

}
//end of else validate statement


}
//Doctor login function end

function registerDoc()
{
  
//retrieving values from ui
var MDPCZ_ID=document.getElementById('MDPCZ_ID').value;
var firstname=document.getElementById('firstname').value;
var lastname=document.getElementById('lastname').value;
var dob=document.getElementById('dob').value;
var gender=document.getElementById('gender').value;
var phoneNumber=document.getElementById('phone1').value;
var email=document.getElementById('emailAddress').value;
var address=document.getElementById('address').value;
var qualification=document.getElementById('qualification').value;
var specialty=document.getElementById('specialty').value;
var experience=document.getElementById('experience').value;
var password=document.getElementById('password').value;
var passwordcon=document.getElementById('passwordcon').value;
var tncdo=document.getElementById('tncdo').value;
//regex for email validation
const re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
//regex for password validation
const passre=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(\W|_)).{5,}$/;
const phonevaldatedoc =/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

//validation

if(MDPCZ_ID==""||firstname==""||lastname==""||dob==""||gender==""||phoneNumber==""||email==""||address==""||qualification==""
||specialty==""||tncdo==""||experience==""||password!==passwordcon||passre.test(password)==false||phonevaldatedoc.test(phoneNumber)==false|re.test(email)==false||tncdo.checked=false){
  if (MDPCZ_ID=="")
    {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='MDPCZ ID is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('MDPCZ_ID').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);
    }
    else if (firstname=="")
    {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='First Name is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('firstname').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);
   }
 else if (lastname=="")
  {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Last Name is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('lastname').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);
 }
 else if (dob=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='dob is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('dob').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (gender=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='gender is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('gender').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 
 else if (phoneNumber=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Phone number is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('phoneNumber').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (email=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Email address is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('email').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (re.test(email)==false)
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Valid email is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('email').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (address=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Address is required';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('aAddress').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (qualification=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Qualification is required';
        document.getElementById('qualification').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (specialty=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='specialty required';
        document.getElementById('specialty').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
 else if (experience=="")
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='experience required';
        document.getElementById('experience').focus();
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
 else if (passwordcon=="") 
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Confirm password';
        document.getElementById('alert').class="btn btn-warning"
        document.getElementById('passwordcon').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
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
 else if (passwordcon!=password)
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Passwords do not match';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('password').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 }
  else if (tncdo.checked=false)
 {
        document.getElementById('alert1').style.display='';
        document.getElementById('alert1').innerHTML='Agree to our terms and conditions';
        document.getElementById('alert1').class="btn btn-warning"
        document.getElementById('tncdo').focus();
        setTimeout(function(){
        document.getElementById('alert1').style.display="none";
        }, 5000);

 } 


//end of validation
else
{       //create form data and append validated variables

        var fd = new FormData;
        fd.append('MDPCZ_ID',MDPCZ_ID);
        fd.append('firstname',firstname);
        fd.append('lastname',lastname);
        fd.append('dob',dob);
        fd.append('gender',gender);
        fd.append('email',email);
        fd.append('phoneNumber',phoneNumber);
        fd.append('address',address);
        fd.append('qualification',qualification);
        fd.append('specialty',specialty);
        fd.append('experience',experience);
        fd.append('password',password);
        localStorage.setItem('docemail',JSON.stringify(email));
        sessionStorage.setItem('docemail',JSON.stringify(email));


        // raise a post xhr request to service
        var xhr= new XMLHttpRequest();     
        xhr.open('POST',base_ul+'doctor/doctor.php',true);

        xhr.onload=function(){
            if(this.status == 200)
            { 
               var resp=JSON.parse(this.responseText);
                if(resp.reponse =='E-mail Address is already exist please try another E-mail Address')
                {

                     $('#logging_in').modal('hide');
                    document.getElementById('alert1').style.display='block';
                    document.getElementById('alert1').innerHTML='E-mail Address is already exist please try another E-mail Address';
                    setTimeout(function(){
                    document.getElementById('alert1').style.display="none";
                    }, 5000);  

                }
            else if (resp.reponse =='Phone is already exist please try another phone Number')
                {
                    $('#logging_in').modal('hide');
                    document.getElementById('alert1').style.display='block';
                    document.getElementById('alert1').innerHTML='E-mail Address is already exist please try another E-mail Address';
                    setTimeout(function(){
                    document.getElementById('alert1').style.display="none";
                    }, 5000); 
                }
                else {
                    if (resp.reponse ==true){
                     
                     $('#logging_in').modal('hide');
                    document.getElementById('success1').style.display='block';
                    document.getElementById('success1').innerHTML='Account Successfully Created';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);

                  

                    setTimeout(function(){
                      direct('doc_email_verification');
                      }, 5000);
                    
                } 
                else {
                        $('#logging_in').modal('hide');
                    document.getElementById('alert1').style.display='block';
                    document.getElementById('alert1').innerHTML='Failed to create Account please try again';
                    setTimeout(function(){
                    document.getElementById('alert1').style.display="none";
                    }, 5000); 
                    }

            }
        }
        }
        //send form data
        xhr.send(fd);

}
//end of else validate statement


}
//client login function end 



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