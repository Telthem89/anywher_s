var base_ul ='../webservices/';
// var base_ul ='http://localhost/afya/webservices/';
var doctor = JSON.parse(localStorage.getItem('doctor'));
var docemail = JSON.parse(localStorage.getItem('docemail'));
var patient_id = JSON.parse(localStorage.getItem('patient_id'));

function loadEmail(){
    byId('email').value=docemail;    
}
function loadprofile() {

	/*==========================side profile================================*/ 
	 var  fname  = byId('fname');
	var  speciality= byId('speciality');
	var zma = byId('zma');
	var joinedga= byId('joinedga');

    fname.innerHTML=doctor.fullname;
	speciality.innerHTML=doctor.speciality;
	zma.innerHTML=doctor.MDPCZ_ID;
	joinedga.innerHTML=doctor.dob;
	/*==========================end side profile================================*/ 

/*==========================input values================================*/ 
var first_name = byId('first_name');
var last_name =byId('last_name');
var phone = byId('phone');
var email = byId('email');
var nationality = byId('nationality');
var city = byId('city');
var work_address = byId('work_address');
var zima = byId('zima');
var bio = byId('bio');
var specialty = byId('specialty');
var experience = byId('experience');
var nationality = byId('nationality');
var city = byId('city');
var bio = byId('bio');
var dob = byId('dob');
var gender = byId('gender');
var qualification = byId('qualification');



    first_name.value=doctor.firstname
    last_name.value=doctor.lastname;
	phone.value=doctor.phoneNumber;
	email.value=doctor.email;
	work_address.value=doctor.address;
	zima.value=doctor.MDPCZ_ID;
	specialty.value=doctor.speciality;
	experience.value=doctor.experience;
    nationality.value=doctor.country
    city.value=doctor.city
    bio.value=doctor.bio
    dob.value=doctor.dob
    qualification.value=doctor.qualification
    gender.value=doctor.gender
    byId('avatar').src='../webservices/uploads/'+doctor.avatar;
    byId('avatar1').src='../webservices/uploads/'+doctor.avatar;
}

function homedocdetail() {
	var flname = byId('flname');
	var speciality = byId('speciality');
	flname.innerHTML=doctor.fullname;
	speciality.innerHTML=doctor.speciality
    byId('avatar').src='../webservices/uploads/'+doctor.avatar;
}

function loadDocterdetails() {
var docnam  = byId('docnam')
var myspeciality  = byId('specialityj')
var phonnumber  = byId('phonnumber')

    docnam.innerHTML=doctor.fullname;
    myspeciality.innerHTML=doctor.speciality
    phonnumber.innerHTML=doctor.phoneNumber



}



/*========get My Appointments========*/ 
function getDoctorAppointments(){
	const myevent =   document.querySelector('#myevent');
	var xhr= new XMLHttpRequest();
    xhr.open('GET',base_ul+'doctor/get_DoctorHisBooking.php?doctor_id='+doctor.id,true);
    xhr.onreadystatechange = function () {
    	if (xhr.readyState ==4 && xhr.status==200) {
    		if (this.responseText!=null) {
    			var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){

                        var tr = document.createElement('tr');

                        var myDate= document.createElement('td');
                        var myime= document.createElement('td');
                        var evvent= document.createElement('td');
                        var patientName= document.createElement('td');
                        var payment= document.createElement('td');
                        var action= document.createElement('td');

                        myDate.setAttribute('class','agenda-date');
                        myime.setAttribute('class','agenda-time');
                        patientName.setAttribute('class','agenda-events');
                        evvent.setAttribute('class','agenda-events');
                        payment.setAttribute('class','agenda-events');


                        myDate.innerHTML=resp[i].bookdate;
                        myime.innerHTML=resp[i].booktime;
                        patientName.innerHTML=resp[i].patientName;
                        evvent.innerHTML=resp[i].description;
                        payment.innerHTML=resp[i].paymentStatus;
                        //RescheduleAppointment(${resp[i].client_id},${resp[i].email},${resp[i].phoneNumber})
                        action.innerHTML=`
                        <button class="btn btn-sm btn-info rounded-0" type="button" onclick="RescheduleAppointment(${resp[i].client_id},${resp[i].phoneNumber}),loc()" ><i class="fa fa-clipboard-list"></i> Reschedule</button>
                        <button class="btn btn-sm btn-success rounded-0" type="button" onclick="onCclient(${resp[i].client_id})" ><i class="fa fa-briefcase"></i> Prescribe</button>
                        `;

                        tr.appendChild(myDate);
                        tr.appendChild(myime);
                        tr.appendChild(patientName);
                        tr.appendChild(evvent);
                        tr.appendChild(payment);
                        tr.appendChild(action);
                        myevent.appendChild(tr);

                  
                }

    		}
    	}
    	else if (xhr.readyState !=1 &&xhr.status!=200) {
			return 'Error 500';
		}
    }
    xhr.send();
        

}
/*========/endget My Appointments========*/ 

/*========logout========*/

function Logout() {
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/logout.php?id='+doctor.id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText =='error') {
                    localStorage.removeItem("doctor");
                    sessionStorage.removeItem('email');
                    sessionStorage.removeItem('firstname');
                    sessionStorage.removeItem('lastname');
                    sessionStorage.removeItem('id');
                    sessionStorage.removeItem('phoneNumber');
                    sessionStorage.removeItem('speciality');
                    direct("../login/login");
                }
                
            }
        }
         xhr.send();
}
/*========logout========*/

/*========doc_ActivateAccount========*/
function doc_ActivateAccount() {
    var emailCode=byId('emailCode').value;
    if(emailCode==""){
    byId('alert').style.display='block';
    byId('alert').innerHTML='Please code is required ';
    byId('emailCode').focus();

    setTimeout(function(){
      byId('alert').style.display="none";
    }, 5000);
}
    // else if (emailCode.length < 6 || emailCode.length > 6 ) {
    //     byId('alert').style.display='block';
    //     byId('alert').innerHTML='Please code should have 6 digits only';
    //     byId('emailCode').focus();
    //     setTimeout(function(){
    //       byId('alert').style.display="none";
    //     }, 5000);
    // }
    else {

        var fd = new FormData();
        fd.append('generatedCode',emailCode);
        // fd.append('email',docemail);

        
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);

                if (resp.response == true) {
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Account has been Activated successfully...login now';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    localStorage.removeItem('docemail');
                    sessionStorage.removeItem('docemail');
                    direct('login');
                    }, 5000); 
                }

               else {
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Activation code is in correct please try again';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 

                                   
                }
                
            }
        }
        xhr.open('POST',base_ul+'doctor/activateAccount.php',true);
         xhr.send(fd);
    }
}
/*========/ doc_ActivateAccount========*/

/*========updateFProfilePic========*/

function updateFProfilePic(){
      var avatar=byId('myavatar').files[0];

      if (avatar =="") {
         document.getElementById('alert').style.display='block';
          document.getElementById('alert').innerHTML='Please upload an image';
            setTimeout(function(){
            document.getElementById('alert').style.display="none";
            }, 5000);
      }
      else{

        var fd = new FormData();
        fd.append('id',doctor.id);
        fd.append('avatar',avatar);
   
        var xhr= new XMLHttpRequest();
         $('#logging_in').modal('show')
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                
                var resp = JSON.parse(this.responseText);
                if (resp.response ==true) {
                    $('#logging_in').modal('hide')
                        document.getElementById('success').style.display='block';
                        document.getElementById('success').innerHTML='Your profile picture has been updated successfully !!';
                        doctorloadPicture(doctor.id)
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    }, 5000);
                    }
                else{
                   $('#logging_in').modal('hide')
                   document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong !!';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                }
                
            }
        }
        
        xhr.open('POST',base_ul+'doctor/updateProPic.php',true);
         xhr.send(fd);
     }
}

/*========updateFProfilePic========*/

/*========doctorloadPicture========*/

function doctorloadPicture(id) {

    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/getdoctorProfilePicture.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                localStorage.clear();
                for (var i = 0; i < resp.length; i++){
                 byId('avatar').src='../webservices/uploads/'+resp[i].avatar;
                 byId('avatar1').src='../webservices/uploads/'+resp[i].avatar;
                 var doctor = resp[i];
                    localStorage.setItem('doctor',JSON.stringify(doctor));

                }
            }
        }
         xhr.send();
}

/*========doctorloadPicture========*/



function onCclient(id) {
    localStorage.removeItem("patient_id");
    direct('prescribe')
    localStorage.setItem('patient_id',JSON.stringify(id));
   
}

function getclientDatainfo() {

   
    // var cid        = byId('cid');
    var fddname    = byId('fddname');
    var age        = byId('age');
    var caddress   = byId('caddress');
    var phonem     = byId('phonem');

    var xhr= new XMLHttpRequest();
        
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                
                console.log(resp[i])
                        // cid.value=doctor.id
                        fddname.innerHTML=resp[i].fullname
                        age.innerHTML=resp[i].age
                        caddress.innerHTML=resp[i].address
                        phonem.innerHTML=resp[i].phoneNumber


                }
            }
        }
        xhr.open('GET',base_ul+'patient/getClientProfile.php?id='+patient_id,true);
         xhr.send();
}

//prescription

function DoctorAddPrescription() {
    
    var mydrug=byId('mydrug').value;
    var drugusage=byId('drugusage').value;
    var prescnumber=byId('prescnumber').value;
    var doc_ment=byId('doc_ment').files[0];



        var fd = new FormData();
        fd.append('prescnumber',prescnumber);
        fd.append('doctor_id',doctor.id);
        fd.append('client_id',patient_id);
        fd.append('drugs',mydrug);
        fd.append('dusage',drugusage);
        fd.append('doc',doc_ment);
   
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){

                var resp = JSON.parse(this.responseText);
                if (resp.response == true) {
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Prescription added successfully';
                    form.reset()
                   setTimeout(function(){
                        getDoctorClientPrescriptions
                    }, 300);
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    }, 5000);
                    }
                else{
                   
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong !!';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                }
                
            }
        }
        xhr.open('POST',base_ul+'doctor/docprescribe.php',true);
         xhr.send(fd);
}

function getDoctorClientPrescriptions(){
    // var cid=byId('cid').value;
    var medication = byId('medication')
    var dosage = byId('dosage')
    // var prescription=byId('prescription');
    var prescnumbern=byId('prescnumbern');
    var xhr= new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200) {
            if (this.responseText!=null) {
                var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    medication.innerHTML = resp[i].drugs
                    dosage.innerHTML = resp[i].dusage
                    prescnumbern.innerHTML = resp[i].prescnumber 
                }

            }
        }
        else if (xhr.readyState !=1 &&xhr.status!=200) {
            return 'Error 500';
        }
    }
    xhr.open('GET',base_ul+'doctor/get_DoctorPrescription.php?client_id='+patient_id,true);
    xhr.send();
        

}

function getTotalPrescript() {
    var countprescriptions =byId('countprescriptions')
    var attendedPatient =byId('attendedPatient')
    var attendedAppoint =byId('attendedAppoint')
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/getTotalPrescript.php?doctor_id='+doctor.id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    countprescriptions.innerHTML=resp[i].total;
                    attendedPatient.innerHTML=resp[i].total;
                    attendedAppoint.innerHTML=resp[i].total;
                }

//DoctorCountBookings
                }

                
            }
        }
         xhr.send();
}

function DoctorCountBookings() {
    var countAppointments =byId('countAppointments')
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/DoctorCountBookings.php?doctor_id='+doctor.id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    countAppointments.innerHTML=resp[i].total;
                }

//DoctorCountBookings
                }

                
            }
        }
         xhr.send();
}


function DoctorCountRevenues() {
    var countRevenues =byId('countRevenues')
      var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                    
                        for (var i = 0; i < resp.length; i++){
                            if (resp[i].total ==null) {
                             countRevenues.innerHTML="ZWL$0.00"   
                            }
                        else {
                            countRevenues.innerHTML="ZWL$"+resp[i].total;
                        }
                    
                        }

//DoctorCountBookings
                }

                
            }
        }

        xhr.open('GET',base_ul+'doctor/DoctorCountRevenue.php?doctor_id='+doctor.id,true);
         xhr.send();
}


function ActivateMyAccountPhoneDoctor(){
    //scO9PIH_0J_vbbNSmO-D0pG9stgdQRrGUw5xcUmd fail safe
}


function updateProfileDoctor() {

    var zima=byId('zima').value;
    var first_name=byId('first_name').value;
    var last_name=byId('last_name').value;
    var work_address=byId('work_address').value;
    var specialty=byId('specialty').value;
    var phone=byId('phone').value;
    var email=byId('email').value;
    var nationality=byId('nationality').value;
    var city=byId('city').value;
    var bio=byId('bio').value;
    var work_address=byId('work_address').value;
    var experience=byId('experience').value;
    var dob=byId('dob').value;
    var gender=byId('gender').value;
    var qualification=byId('qualification').value;




        var fd = new FormData();
        fd.append('id',doctor.id);
        fd.append('MDPCZ_ID',zima);
        fd.append('firstname',first_name);
        fd.append('lastname',last_name);
        fd.append('address',work_address);
        fd.append('speciality',specialty);
        fd.append('phoneNumber',phone);
        fd.append('email',email);
        fd.append('country',nationality);
        fd.append('city',city);
        fd.append('bio',bio);
        fd.append('dob',dob);
        fd.append('gender',gender);``
        fd.append('qualification',qualification);
        fd.append('experience',experience);
        
        var xhr= new XMLHttpRequest();
        // $('#logging_in').modal('show')
        var btnUpdate= byId('btnUpdate');
        btnUpdate.innerHTML = "Please Wait...."

        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                // $('#logging_in').modal('hide')
                var resp=JSON.parse(this.responseText);
                btnUpdate.innerHTML = "Update Profile"
                if (resp.response ==true) {
                    

                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Account has been updated successfully';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    getProfileDetails(doctor.id);
                    }, 5000); 
                   
                }
                else{
                    $('#logging_in').modal('hide')
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Error while trying to update your profile try again';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                }
                
            }
        }
        xhr.open('POST',base_ul+'doctor/updateDoctor.php',true);
         xhr.send(fd);
}

function loadSocialMeadia() {
     
byId('appointPrice').value=doctor.priceperappoinrmnt
byId('facebook').value =doctor.facebook
byId('youtube').value =doctor.youtube  
byId('skype').value =doctor. skype 
byId('twitter').value=doctor.twitter
byId('instagram').value=doctor.instagram
byId('viber').value=doctor. viber
byId('dateAvaiblabl').value=doctor. dateAvaiblabl
byId('timeavailabe').value=doctor. timeavailabe
}

function getProfileDetails(id) {
    var first_name=byId('first_name');
    var last_name=byId('last_name');
    var phone=byId('phone');
    var email=byId('email').value;
    var nationality=byId('nationality');
    var city=byId('city');
    var work_address=byId('work_address');
    var zima=byId('zima');
    var bio=byId('bio');
    var specialty=byId('specialty');

    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/getProfileDetails.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                localStorage.clear();
                for (var i = 0; i < resp.length; i++){
                     var doctor = resp[i];
                    localStorage.setItem('doctor',JSON.stringify(doctor));

                    first_name.value=resp[i].firstname
                    last_name.value=resp[i].lastname
                    phone.value=resp[i].phoneNumber
                    email.value=resp[i].email
                    nationality.value=resp[i].country
                    city.value=resp[i].city
                    work_address.value=resp[i].address
                    zima.value=resp[i].MDPCZ_ID
                    bio.value=resp[i].bio
                    specialty.value=resp[i].speciality

                }
            }
        }
         xhr.send();
}

function updateSocilMedia() {
var appointPrice =byId('appointPrice').value
var facebook =byId('facebook').value
var youtube =byId('youtube').value
var skype =byId('skype').value
var twitter =byId('twitter').value
var instagram =byId('instagram').value
var viber =byId('viber').value
var dateAvailable =byId('dateAvaiblabl').value
var timeAvailable =byId('timeavailabe').value


        var fd = new FormData();
        fd.append('id',doctor.id);
        fd.append('priceperappoinrmnt',appointPrice);
        fd.append('facebook',facebook);
        fd.append('youtube',youtube);
        fd.append('skype',skype);
        fd.append('twitter',twitter);
        fd.append('instagram',instagram);
        fd.append('viber',viber);
        fd.append('dateAvaiblabl',dateAvailable);
        fd.append('timeavailabe',timeAvailable);

 
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'doctor/socialMediaUpdate.php',true);
        $('#logging_in').modal('show')
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response ==true) {
                    $('#logging_in').modal('hide')

                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Social has been updated successfully';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    getProfileDetailsocial(doctor.id);
                    }, 5000); 
                   
                }
                else{
                    $('#logging_in').modal('hide')
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Error while trying to update your profile try again';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                }
                
            }
        }
         xhr.send(fd);
}


function getProfileDetailsocial(id) {
    var first_name=byId('first_name');
    var last_name=byId('last_name');
    var phone=byId('phone');
    var email=byId('email').value;
    var nationality=byId('nationality');
    var city=byId('city');
    var work_address=byId('work_address');
    var zima=byId('zima');
    var bio=byId('bio');
    var specialty=byId('specialty');

    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/getProfileDetails.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                localStorage.clear();
                for (var i = 0; i < resp.length; i++){
                     var doctor = resp[i];
                    localStorage.setItem('doctor',JSON.stringify(doctor));

                }
            }
        }
         xhr.send();
}

function RescheduleAppointment(id) {
    let cid             = byId('cid');
    // let myemaill         = byId('email');
    // let myphoneNumberl   = byId('phoneNumber');
    cid.value           = id
    // myemail.value       = eemail
    // myphoneNumber.value = ephoneNumber

    // ().modal

}
function canURescheduleAppointment() {
    let dateAvailable  = byId('dateAvailable').value;
    let rmessage       = byId('rmessage').value;
    let cid            = byId('cid').value;
    let myemaill          = byId('email').value;
    let myphoneNumberl    = byId('phoneNumber').value;


    if (dateAvailable=='') {
        byId('alert').style.display='block';
        byId('alert').innerHTML='Please Schedule your date';
       
        setTimeout(function(){
        byId('alert').style.display="none";
        }, 5000); 
    }
    else if (rmessage=='') {
        byId('alert').style.display='block';
        byId('alert').innerHTML='Please enter Message here!';
       
        setTimeout(function(){
        byId('alert').style.display="none";
        }, 5000); 
    }
    else{
        let fd =  new FormData();

        fd.append('book_time',dateAvailable)
        fd.append('reschedule',rmessage)
        fd.append('client_id',cid)
        fd.append('email',myemail)
        fd.append('phoneNumber',myphoneNumber)

        let xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response ==true) {
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Appointment has been rescheduled';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    }, 5000);
                }
                else{
                    document.getElementById('alert').style.display='block';
                    document.getElementById('success').innerHTML='Error occured';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                }
                
            }
        }
        xhr.open('POST',base_ul+'doctor/rescheduleAppoint.php',true);
        xhr.send(fd);
     }
}


































































function direct(address) {
    
    var windowlocation = window.location.href;
    var directory = windowlocation.substring(0,windowlocation.lastIndexOf("/") +1);
    window.location.href=directory+address+".php";
}

function byId(id) {
    return document.getElementById(id);
}