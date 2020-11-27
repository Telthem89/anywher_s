var base_ul ='../webservices/';
function login(){
    //variable declation taking value of feilds
    var email=document.getElementById('email').value;
    var password=document.getElementById('password').value;
    var usertype=document.getElementById('usertype').value;
//validation
if(usertype==""||email==""||password==""){
    
    document.getElementById('alert').style.display='block';
    document.getElementById('alert').innerHTML='User type, email and password are  all required ';
    if(usertype==""){ document.getElementById('usertype').focus();}
    else if(email==""){ document.getElementById('email').focus();}
    else if(password==""){ document.getElementById('password').focus();}

    setTimeout(function(){
    document.getElementById('alert').style.display="none";
    }, 5000);
}

else{
     //else initiate xmlHttpRequest to login service different depending on the usertype
        //create form data and append validated variables
        var fd = new FormData;
        fd.append('email',email);
        fd.append('password',password);

        // request for client
    if(usertype=='client')
    {

       // $('#logging_in').modal('show')
        // raise a post xhr request to service
        var xhr= new XMLHttpRequest();

        xhr.onreadystatechange = function (){
         if (xhr.readyState ==4 && xhr.status==200)
            {
                // $('#logging_in').modal('hide')
              
                var resp=JSON.parse(this.responseText);
                // if(resp.data=='Email not Activated')
                // {
                //     // $('#logging_in').modal('hide')

                //     document.getElementById('alert').style.display='block';
                //     document.getElementById('alert').innerHTML='Your Account need to be Activated please Kindly check your email!!';
                //     setTimeout(function(){
                //     document.getElementById('alert').style.display="none";
                //     }, 5000);


                // }
                // else 
                if(resp.response==true) {
                    
                
                    // setting sessions
                    sessionStorage.setItem('firstname',resp.firstname);
                    sessionStorage.setItem('lastname',resp.lastname);
                    sessionStorage.setItem('id',resp.id);
                    sessionStorage.setItem('email',resp.email);
                    sessionStorage.setItem('phoneNumber',resp.phoneNumber);
                    var patient = resp;
                    localStorage.setItem('patient',JSON.stringify(patient));

                    window.location.href='../patient';

                }
                else{
                    // $('#logging_in').modal('hide')

                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Failed to login kindly check your credentials and try again';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);

                }
            }

        }
        //send form data
        
        xhr.open('POST',base_ul+'client_login.php',true);
        xhr.send(fd);

    }//end if

    // xml httprequest for doctor
    if(usertype=="doctor")
    {
        // $('#logging_in').modal('show')
        // raise a post xhr request to service
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                 // $('#logging_in').modal('hide')
                var resp=JSON.parse(this.responseText);
                if (resp.data == 'Email not Activated') {
                     $('#logging_in').modal('hide')
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Your Account need to be Activated please Kindly check your email!!';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                    }
                else{
                    if (resp.response == true){
                        $('#logging_in').modal('hide')
                        sessionStorage.setItem('email',resp.email);
                        sessionStorage.setItem('firstname',resp.firstname);
                        sessionStorage.setItem('lastname',resp.lastname);
                        sessionStorage.setItem('id',resp.id);
                        sessionStorage.setItem('phoneNumber',resp.phoneNumber);
                        sessionStorage.setItem('speciality',resp.speciality);
                        var doctor = resp;
                        localStorage.setItem('doctor',JSON.stringify(doctor));
                    
                        window.location.href='../doctor';
                    }
                    else{
                        // $('#logging_in').modal('hide')
                        document.getElementById('alert').style.display='block';
                        document.getElementById('alert').innerHTML='Failed to login kindly check your credentials and try again';
                        setTimeout(function(){
                        document.getElementById('alert').style.display="none";
                        }, 5000);
                    }
                    
                }
                
            }
        }
         xhr.open('POST',base_ul+'doctor_login.php',true);
         xhr.send(fd);
    }

     if (usertype=="pharmacy") {
         // $('#logging_in').modal('show')
        // raise a post xhr request to service
        var xhr= new XMLHttpRequest();

        xhr.onreadystatechange = function (){
        if (xhr.readyState ==4 && xhr.status==200)
            {
                 // $('#logging_in').modal('hide')
                var resp=JSON.parse(this.responseText);
                if(resp.data =="Email not Activated")
                {
                    $('#logging_in').modal('hide')
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Your Account need to be Activated please Kindly check your email!!';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                }
                else{
                
                if(resp.response==true)
                {
                    // $('#logging_in').modal('hide')
                    sessionStorage.setItem('id',resp.id);
                    sessionStorage.setItem('fullname',resp.fullname);
                    sessionStorage.setItem('firstname',resp.firstname);
                    sessionStorage.setItem('lastname',resp.lastname);
                    sessionStorage.setItem('email',resp.email);
                    sessionStorage.setItem('phoneNumber',resp.phoneNumber);
                    sessionStorage.setItem('qualification',resp.qualification);
                    var pharmacy = resp;
                    localStorage.setItem('pharmacy',JSON.stringify(pharmacy));
                    
                window.location.href='../pharmacy';

                }
                else{
                    // $('#logging_in').modal('hide')

                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Failed to login kindly check your credentials and try again';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);

                }
            }

            }
        }
        //send form data

        xhr.open('POST',base_ul+'pharmacy_login.php',true);
        xhr.send(fd);
     }



 }

}