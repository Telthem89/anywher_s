var base_ul ='./webservices/';
//http://localhost/webservices/visitorpage.php 4

function bookDemo(){
let title                     = document.getElementById('title').value
let fullname                  = document.getElementById('fullname').value
let phoneNumber               = document.getElementById('phoneNumber').value
let email                     = document.getElementById('email').value
let speciality                = document.getElementById('speciality').value
let date_u_a_free             = document.getElementById('date_u_a_free').value
let time_u_a_free             = document.getElementById('time_u_a_free').value
let reason_for_booking        = document.getElementById('reason_for_booking').value


let fd = new FormData;
fd.append('title',title);
fd.append('fullname',fullname);
fd.append('phoneNumber',phoneNumber);
fd.append('email',email);
fd.append('speciality',speciality);
fd.append('date_u_a_free',date_u_a_free);
fd.append('time_u_a_free',time_u_a_free);
fd.append('reason_for_booking',reason_for_booking);
let xhr = new XMLHttpRequest();

xhr.onreadystatechange = function(){
    if(xhr.readyState ==4 && xhr.status==200){
        var resp = JSON.parse(this.responseText);
        if(resp.response == true){
            swal({
                title: "Anywhere Healthcare",
                text: "Your request has been sent please check your email",
                icon: "success",
                button: "ok",
              });
              setTimeout(function(){
                      emaildirect("https://mail.google.com/mail/u/0/")
              },2000)

          }
          else{
            swal({
                title: "Anywhere Healthcare",
                text: "Your request failed try again later",
                icon: "error",
                button: "ok",
              }); 
          }
    }
    else if (xhr.readyState !=1 && xhr.status!=200) {
        return 'Error 500';
    }

}
xhr.open('POST',base_ul+'visitorpage.php',true);
xhr.send(fd);
}

function emaildirect(address) {  
    window.location.href=address;
}