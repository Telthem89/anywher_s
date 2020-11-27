var base_ul ='../webservices/';
var patient = JSON.parse(localStorage.getItem('patient'));
var email = JSON.parse(localStorage.getItem('email'));
var doctid = JSON.parse(localStorage.getItem('doctorid'));

function loadEmail(){
    //byId('email').value=email;    
}
function loadprofile() {

byId('flname').innerHTML=patient.fullname;
byId('fname').innerHTML=patient.fullname;;

byId('first_name').value=patient.firstname;
byId('last_name').value=patient.lastname;
byId('phone').value=patient.phoneNumber;
byId('email').value=patient.email;
byId('dob').value=patient.dob;
byId('gender').value=patient.gender;
byId('datejoined').innerHTML=patient.gender;
byId('address').value=patient.address;
byId('avatar').src='../webservices/uploads/'+patient.avatar;
byId('avatar1').src='../webservices/uploads/'+patient.avatar;
loadPicture(patient.id)

}

function homedocdetail() {
    byId('flname').innerHTML=patient.fullname;
    byId('fname').innerHTML=patient.fullname;
    byId('avatar1').src='../webservices/uploads/'+patient.avatar;
}
function car() {
    byId('avatar1').src='../webservices/uploads/'+patient.avatar;
    byId('flname').innerHTML=patient.fullname;
}



/*==========================List of doctors================================*/ 

function listAllDoctors() {
    const rowContainer = document.querySelector('#rowContainer');
    var xhtttp =new XMLHttpRequest();
    
    xhtttp.onreadystatechange = function () 
    {
        if (xhtttp.readyState ==4 && xhtttp.status==200)
        {
            if (this.responseText !=null)
            {
                var resp = JSON.parse(this.responseText);
                 for (var i = 0; i < resp.length; i++)
                 {
                    var myObject = resp[i];
                    for (myObjects in myObject) 
                    {
                         

                        html = `
                            <a class="image-link" href="#"><img class="image rounded-circle" src="../webservices/uploads/${myObject.avatar}">
                            </a>
                            <div class="search-result-item-body">
                                <div class="row" >
                                    <div class="col-sm-9">
                                        <h4 class="search-result-item-heading"><a href="#">Doctor ${myObject.fullname} </a></h4>
                                        <p class="info">${myObject.address}</p>
                                        <p class="info">Next Available (Today)</p>
                                        <p class="description">
                                           ${myObject.bio}
                                        </p>
                                         <p class="kk">
                                           Booking Days <b>[${myObject.dateAvaiblabl}]</b>
                                        </p>
                                        <p class="kk">
                                           Booking Hours <b>[${myObject.timeavailabe}]</b>
                                        </p>
                                        
                                    </div>
                                    <div class="col-sm-3 text-align-center">
                                        <p class="value3 mt-sm" id="pricelog">$ ${myObject.priceperappoinrmnt} <b id="curr_sym">USD</b></p>
                                        <p class="value3 mt-sm" id="pricelogcon" style="display:none;">rtgs</p>
                                        <p class="fs-mini text-muted">PER SESSION</p>
                                        <a class="btn btn-primary btn-info btn-sm rounded-0 text-white mb-2"   onclick="$('#booknow').modal('show'),doctor(${myObject.id})">Book</a>
                                        <p>
                                            <a href="https://zoom.us/"><i class="fa fa-video fa-2x"></i></a>
                                            <a href="https://web.skype.com/"><i class="fab fa-skype fa-2x"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                                
                        `;
                       
                    }

                    var section = document.createElement("section");


                    section.setAttribute("class", "search-result-item");
                    section.innerHTML =html;
                    rowContainer.appendChild(section);
                 }
            }
        }
    }
    xhtttp.open("GET",base_ul+'patient/getAllDoctors.php',true);
    xhtttp.send();
}

/*==========================List of doctors================================*/ 

/*==========================Medical History================================*/ 
function addMedicalHistory() {
var patient_id=patient.id;
var drugs=byId('drugs').value;
var allegicMedication=byId('allegicMedication').value;
var otherdeases=byId('otherdeases').value;
var med_doc =byId('med_doc').files[0];



        //create form data and append validated variables
        var fd = new FormData();
        fd.append('patient_id',patient_id);
        fd.append('drugs',drugs);
        fd.append('allegicMedication',allegicMedication);
        fd.append('otherdeases',otherdeases);
        fd.append('med_doc',med_doc);

        // raise a post xhr request to service
        var xhr= new XMLHttpRequest();
        
        xhr.onreadystatechange = function () 
        {
            if (xhr.readyState ==4 && xhr.status==200)
            {
                
                var resp=JSON.parse(this.responseText);
                if (resp.response==true) 
                {
                    $('#logging_in').modal('hide');
                     direct("user-profile")
                        document.getElementById('success').style.display='block';
                        document.getElementById('success').innerHTML='Your information has been updated successfully !!';
                        setTimeout(function(){
                        document.getElementById('success').style.display="none";
                        }, 5000);
                }else {
                        document.getElementById('alert').style.display='block';
                        document.getElementById('alert').innerHTML='Error occured while trying to update';
                        setTimeout(function(){
                        document.getElementById('alert').style.display="none";
                        }, 5000);
                }
            
           
        }
         else if (xhr.readyState !=1 && xhr.status!=200) {
             direct("user-profile")
            return 'Error 500';
        }
        }
        xhr.open('POST',base_ul+'patient/updateClient.php',true);
        xhr.send(fd);
}
/*==========================end Medical History================================*/ 

/*========================get doctor information================================*/ 
function doctor(id) {
    const doctorInfor =   document.querySelector('#doctorInfor');
    byId('client_id').value=patient.id;
    var doctor_id = byId('doctor_id');
    var doc_name = byId('doc_name');
    var speciality = byId('speciality');
    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'patient/getDoctorProfile.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    var doctor = resp[i];
                    for (doctors in doctor){
                        doctor_id.value=doctor.id
                        doc_name.value=doctor.firstname+" "+doctor.lastname
                        speciality.value=doctor.speciality;

                    }

                }
            }
        }
         xhr.send();
}
/*========================/end get doctor information================================*/ 


/*========Make booking now after submit booking you will be redirected to payment========*/ 

function MakeAppointmentWithDoctor() {
    var client_id = byId('client_id').value;
    var doctor_id = byId('doctor_id').value;
    var description = byId('description').value;
    var book_time = byId('book_time').value;

    var fd = new FormData();
    fd.append('description',description);
    fd.append('client_id',client_id);
    fd.append('doctor_id',doctor_id);
    fd.append('book_time',book_time);

        localStorage.setItem('doctorid',JSON.stringify(doctor_id));
       // sessionStorage.setItem('doctorid',JSON.stringify(doctor_id));



    // raise a post xhr request to service
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'patient/bookDoctor.php',true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200)
            {
                if (this.responseText!=null) {
                    var resp=JSON.parse(this.responseText);
                    if (resp.response==true) {

                        $('#logging_in').modal('hide');
                        document.getElementById('success').style.display='block';
                        document.getElementById('success').innerHTML='Your appointment has been saved successfully, please make payment !!';
                        setTimeout(function(){
                        document.getElementById('success').style.display="none";
                        }, 5000);

                         setTimeout(function(){
                           direct("pay")
                        }, 100);
                        
                    }
                    else{
                        $('#logging_in').modal('hide');
                        document.getElementById('alert').style.display='block';
                        document.getElementById('alert').innerHTML='Error occured while we saving your data';
                        setTimeout(function(){
                        document.getElementById('alert').style.display="none";
                        }, 5000);
                    }
                }
                
            }
            
            else if (xhr.readyState !=1 &&xhr.status!=200) {
            return 'Error 500';
        }
        }
        
        xhr.send(fd);
}

/*========/end Make booking now after submit booking you will be redirected to payment========*/ 

/*========get My Appointments========*/ 
function getMyAppointment(){
    const myevent =   document.querySelector('#myevent');
    var xhr= new XMLHttpRequest();
    xhr.open('GET',base_ul+'patient/getMyBooking.php?client_id='+patient.id,true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200) {
            if (this.responseText!=null) {
                var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){

                        var tr = document.createElement('tr');

                        var myDate= document.createElement('td');
                        var myime= document.createElement('td');
                        var evvent= document.createElement('td');
                        var doctorName= document.createElement('td');
                        var payment= document.createElement('td');
                        var prescriptions= document.createElement('td');

                        myDate.setAttribute('class','agenda-date');
                        myime.setAttribute('class','agenda-time');
                        evvent.setAttribute('class','agenda-date active');
                        doctorName.setAttribute('class','agenda-events');
                        payment.setAttribute('class','agenda-events');

                        myDate.innerHTML=`
                       <div class="dayofmonth">${resp[i].mydayofMonths}</div>
                      <div class="dayofweek">${resp[i].dataName}</div>
                      <div class="shortdate text-muted">${resp[i].myMonthName}, ${resp[i].yearname}</div>
              `;
                        myime.innerHTML=resp[i].booktime;
                        evvent.innerHTML=resp[i].description;
                        doctorName.innerHTML=resp[i].doctorName;
                        payment.innerHTML=resp[i].paymentStatus;
                        prescriptions.innerHTML=`
                        <a href="view_prescription.php" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View Prescription</a>
                        <button class="btn btn-sm btn-info " type="button" onclick="loadPay(),doctor(${resp[i].id})"><i class="fa fa-cart-plus"></i> Pay</button>
                        `;


                        tr.appendChild(myDate);
                        tr.appendChild(myime);
                        tr.appendChild(evvent);
                        tr.appendChild(doctorName);
                        tr.appendChild(payment);
                        tr.appendChild(prescriptions);
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

/*==========================get Medical History================================*/ 
function getMedicalHistoryById() {
    const medicalhistoryContainer =   document.querySelector('#medicalhistoryContainer');
    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'patient/getMedicalhistory.php?patient_id='+patient.id,true);
        xhr.onreadystatechange = function () 
        {
            if (xhr.readyState ==4 && xhr.status==200)
            {
                var resp=JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++)
                 {
                    var medical = resp[i];
                    console.log(medical)

                    for (medicals in medical)
                    {
                            html = `
                            
                              
                              <div class="col-md-4">
                                <h5>Allegic</h5>
                                <p>${medical.allegicMedication}</p>
                              </div>
                              <div class="col-md-4">
                                <h5>Other Deases</h5>
                                <p>${medical.otherdeases}</p>
                              </div>
                              <div class="col-md-4">
                                <h5>Drugs</h5>
                                <p>${medical.drugs}</p><br>
                                <div class="">
                                <b class="badge badge-danger mb-4">Medical Document</b><br>
                                 <a class="ml-4 p-2 mt-2" href="../webservices/uploads/${medical.med_doc}"><i class="fa fa-file fa-3x"></i></a>
                                </div>
                              </div>

                        `;
                    } 
                    var section = document.createElement("div");
                    section.setAttribute("class", "row");
                    section.innerHTML =html;
                    medicalhistoryContainer.appendChild(section);
                 }
        }
    }
     xhr.open('GET',base_ul+'patient/getMedicalhistory.php?patient_id='+patient.id,true);
     xhr.send();

    

}
/*==========================end Medical History================================*/ 

function ActivateMyAccount() {
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

else{
        var fd = new FormData();
        fd.append('generatedCode',emailCode);
        fd.append('email',email);
  
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'patient/activateAccountForClient.php',true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response==true) {
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Account has been Activated successfully...login now';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    localStorage.removeItem('email',JSON.stringify(email));
                    sessionStorage.removeItem('email',JSON.stringify(email));
                    direct('login');
                    }, 5000);      
                }
                else{
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Activation code is in correct please try again';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                    
                }
                
            }
        }
         xhr.send(fd);
    }
}

 function loadPay(){
    direct("pay")
  }

//logout
function Logout() {
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'patient/logout.php?id='+patient.id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText =='error') {
                    localStorage.removeItem("patient");
                    sessionStorage.removeItem('firstname');
                    sessionStorage.removeItem('lastname');
                    sessionStorage.removeItem('id');
                    sessionStorage.removeItem('email');
                    sessionStorage.removeItem('phoneNumber');
                    direct("../login/login")
                }
                
            }
        }
         xhr.send();
}


// get doctors payment detail eg phone banking details
function getdoctorPaymentDetails() {
    var doctorName = byId('doctorName');
    var phoneNumber = byId('phoneNumber');
    var priceperappoinrmnt = byId('priceperappoinrmnt');
    var amount = byId('amount');
    var doctorAmount = byId('doctorAmount');
    var doctorNameid = byId('doctorNameid');

   byId('myphoneNumber').value = patient.phoneNumber;
    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'patient/doctorpaymentDetail.php?id='+doctid,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    var doctor = resp[i];
                    for (doctors in doctor){
                        phoneNumber.value=doctor.phoneNumber
                        doctorName.innerHTML=doctor.doctorName
                        amount.value=doctor.priceperappoinrmnt
                        priceperappoinrmnt.innerHTML= "$"+ doctor.priceperappoinrmnt
                        doctorAmount.innerHTML= "$"+ doctor.priceperappoinrmnt
                        doctorNameid.innerHTML=  "Dr "+doctor.doctorName

                    }

                }
            }
        }
         xhr.send();
}


function payDoctor() {
        var phoneNumber    = byId('phoneNumber').value;
        var myphoneNumber  = byId('myphoneNumber').value;
        var amount         = byId('amount').value;
        var currency       = "ZWL"
        var amount         = amount;
        var description    = "Appointment with Doctor";


        var fd = new FormData();
        fd.append('description',description);
        fd.append('amount',amount);
        fd.append('currency',currency);
        fd.append('receiver',phoneNumber);
        fd.append('senderNumber',myphoneNumber);
        fd.append('doctor_id',doctid);
        fd.append('client_id',patient.id);
     $('#logging_in').modal('show')
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){

                var resp = JSON.parse(this.responseText);

                if (resp.response == true) {
                    $('#logging_in').modal('hide');
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Payment is being proccessed please wait!!';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    window.location.href=resp.data;
                    }, 5000);
                }

                else{
                    $('#logging_in').modal('hide');
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Your payment has been canceled';

                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                   
                }
                
                
            }
        }
        xhr.open('POST',base_ul+'patient/makepayemt.php',true);
         xhr.send(fd);
}

function updateProfilePic(){
      var useravatar=byId('useravatar').files[0];

        var fd = new FormData();
        fd.append('id',patient.id);
        fd.append('avatar',useravatar);
   
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp = JSON.parse(this.responseText);
                if (resp.response ==true) {
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Profile has been uploaded successfully !!';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    loadPicture(patient.id);
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
        xhr.open('POST',base_ul+'patient/updateProPicClient.php',true);
         xhr.send(fd);
}

function updateMyProfile() {

    var btnUpdateMyProfile     = byId('btnUpdateMyProfile');
    var first_name             = byId('first_name').value;
    var last_name              = byId('last_name').value;
    var email                  = byId('email').value;
    var phone                  = byId('phone').value;
    var password               = byId('password').value;
    var gender                 = byId('gender').value;
    var dob                    = byId('dob').value;
    var address                = byId('address').value;


    var fd = new FormData();
    fd.append('id',patient.id);
    fd.append('firstname',first_name);
    fd.append('lastname',last_name);
    fd.append('email',email);
    fd.append('phoneNumber',phone);
    fd.append('password',password);
    fd.append('gender',gender);
    fd.append('dob',dob);
    fd.append('address',address);


    btnUpdateMyProfile.innerHTML = "Please wait.......";
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response == true) {
                    btnUpdateMyProfile.innerHTML = "Update";
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Profile has been uploaded successfully !!';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    getPatientProfileDetails(patient.id);
                    }, 5000);
                    }
                else{

                    btnUpdateMyProfile.innerHTML = "Update";
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong !!';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                }
                
            }
        }
        xhr.open('POST',base_ul+'patient/updateClientInform.php',true);
         xhr.send(fd);
}

function getPatientProfileDetails(id) {
    var first_name=byId('first_name');
    var last_name=byId('last_name');
    var phone=byId('phone');
    var email=byId('email').value;
    var dob=byId('dob');
    var gender=byId('gender');
    var address=byId('address');







    var xhr= new XMLHttpRequest();
        
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                localStorage.clear();
                for (var i = 0; i < resp.length; i++){
                     var patient = resp[i];
                    localStorage.setItem('patient',JSON.stringify(patient));

                    first_name.value=resp[i].firstname
                    last_name.value=resp[i].lastname
                    phone.value=resp[i].phoneNumber
                    email.value=resp[i].email
                    gender.value=resp[i].gender
                    dob.value=resp[i].dob
                    address.value=resp[i].address
                    

                }
            }
        }
         xhr.open('GET',base_ul+'patient/getClientProfile.php?id='+id,true);
         xhr.send();
}

function loadPicture(id) {

    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'patient/getProfilePicture.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                 byId('avatar').src='../webservices/uploads/'+resp[i].avatar;
                 byId('avatar1').src='../webservices/uploads/'+resp[i].avatar;
                }
            }
        }
         xhr.send();
}





/*==========================Library handler===============================*/ 
function getBase64(id) {
    var img =byId(id).files[0];
        var reader = new FileReader();

        reader.onload= function (fileLoadedEvent) {
        
            docfile=fileLoadedEvent.target.result;
            
            
            byId('mybtn').disabled=false;
             
        }
        reader.readAsDataURL(img);
}

function getClientPrescriptions(){

    var mainContainerdiv = byId('mainContainerdiv');

    var xhr= new XMLHttpRequest();  
    xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200) {
            if (this.responseText!=null) {
                var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                  html =
                  `
                    <h4 class="heading1 text-center">PATIENT PRESCRIPTION</h4>
                    <section class="prescription-top">
                        <div class="row">
                            <div class="col-md-8 prescTopText">
                                <h1>Anywhere Healthcare</h1>
                                <p>Stay healthy on the go, anywhere anytime.</p>
                                <p>remotehealth.sagehillhost.com</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <img class="prescription-logo" src="../img/afya_logo.png" class="img-fluid" width="120px">
                            </div>
                        </div>
                    </section>

                     <section>
                        <div class="row">
                            <hr id="section-divider"><br>
                            <div class="col-md-6 text-left">
                                <p class="text-blue">Dr. ${resp[i].doctname}</p>
                                <p>[${resp[i].speciality}]</p>
                                <p>[+263 ${resp[i].phoneNumber}]</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <p>Prescription #: [${resp[i].prescnumber}]</p>
                                <p>Date: ${resp[i].dateprescribe}</p>
                            </div>
                            <br><hr id="section-divider">
                        </div>
                    </section>

                   <section>
                    <div class="row"> 
                      <div class="col-md-12 breather">
                          <h3 class="text-center">Prescribed Medication</h3> <hr><br>
                          <div class="row"> 
                          <div class="col-md-6 ">
                          <h6> Medication Name</h6>
                           <p>${resp[i].drugs}</p>
                           </div>
                           <div class="col-md-6 ">
                           <h6>Prescribed Medication:</h6>
                           <p>${resp[i].dusage}</p>
                           </div>
                           </div?
                            
                      </div>
                    </div>
                </section><br><hr id="section-divider">

                    <section>
                        <div class="row">
                            <div class="col-md-12 text-left">
                                <table>
                                    <thead>
                                        <h6 class="heading1">Patient Details:</h6>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>Mr/Mrs/Ms:</p>
                                            </td>
                                            <td>
                                                <p> [${resp[i].fullname}]</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>Age:</p>
                                            </td>
                                            <td>
                                                <p> [${resp[i].age}]</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>Address:</p>
                                            </td>
                                            <td>
                                                <p> [${resp[i].c_address}]</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>Contact Num:</p>
                                            </td>
                                            <td>
                                                <p> [+${resp[i].c_phone}]</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section class="prescription-bottom mb-3">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <p>Call or Send whatsapp message to: +263 ${resp[i].phoneNumber}</p>
                            </div>
                            <div class="col-md-6 text-center prescrFooter mb-4">
                                <a href="shop.php" class="btn btn-info">Visit Pharmacy</a>&emsp;
                                <a href="../webservices/uploads/${resp[i].doc}" class="btn btn-info">Download as PDF</a>
                            </div>
                            <div class="col-md-3 text-center">
                                <p> E-mail to: ${resp[i].email}</p>

                                <b id="fname" class="d-none"></b>
                            </div>
                        </div>
                    </section>
                      `;

                    var section = document.createElement("section");
                    section.innerHTML +=html;
                    mainContainerdiv.appendChild(section);
                }

            }
            else{
                      html =
                  `
                    <h4 class="heading1 text-center">PATIENT PRESCRIPTION</h4>
                    <section class="prescription-top">
                        <div class="row">
                            <div class="col-md-8 prescTopText">
                                <h1>Anywhere Healthcare</h1>
                                <p>Stay healthy on the go, anywhere anytime.</p>
                                <p>remotehealth.sagehillhost.com</p>
                            </div>
                            <div class="col-md-4 text-center">
                                <img class="prescription-logo" src="../img/afya_logo.png" class="img-fluid" width="120px">
                            </div>
                        </div>
                    </section>

                     

                   <section>
                    <div class="row"> 
                      <div class="col-md-12 breather py-5">
                          <h3 class="text-center text-danger">No Prescription Yet......</h3> <hr><br>
                          
                            
                      </div>
                    </div>
                </section><br><hr id="section-divider">

                   

                  
                      `;

                    var section = document.createElement("section");
                    section.innerHTML +=html;
                    mainContainerdiv.appendChild(section);
            }
           

               
           
        }
        else if (xhr.readyState !=1 &&xhr.status!=200) {
            return 'Error 500';
        }
    }
    xhr.open('GET',base_ul+'patient/get_ClientPrescription.php?client_id='+patient.id,true);
    xhr.send();
}

function getMyTotalPrescription() {
    var countprescriptions =byId('countprescriptions')
    var attendedPatient =byId('attendedPatient')
    var attendedAppoint =byId('attendedAppoint')
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'patient/getMyTotalPrescription.php?client_id='+patient.id,true);
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

function ActivateMyAccountPhone(){
    
}


function listAlldrugsBelongsToPharmacy(pid) {
    alert("drugs "+pid)
}

function addToCart() {
    var btnAddTocart     = byId('btnAddTocart');
    var quantity         = byId('quantity').value;
    var drug_id          = byId('drug_id').value;
    var client_id        = byId('client_id').value;
    var pid              = byId('pid').value;
    var price            = byId('price').value;
    var medQuantity      = byId('medQuantity').value;


    var fd = new FormData();
    fd.append('quantity',quantity);
    fd.append('drug_id',drug_id);
    fd.append('client_id',client_id);
    fd.append('pid',pid);
    fd.append('price',price);
    fd.append('medQuantity',medQuantity);


    btnAddTocart.innerHTML = "Please wait.......";
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response == true) {
                    btnAddTocart.innerHTML = "+ Cart";
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Medication added to cart successfully !!';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    }, 5000);
                    }
                else{

                    btnAddTocart.innerHTML = "+ Cart";
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong !!';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                }
                
            }
        }
        xhr.open('POST',base_ul+'patient/addToCart.php',true);
         xhr.send(fd);
}

function RemoveCart(cartid,cartQnty,medqnty,drug_id) {
   
    var fd = new FormData();
    fd.append('cartid',cartid);
    fd.append('cartQnty',cartQnty);
    fd.append('medqnty',medqnty);
    fd.append('drug_id',drug_id);

        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response == true) {
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Cart Removed successfully';
                   
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    }, 5000);
                    }
                else{

                    btnAddTocart.innerHTML = "+ Cart";
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong !!';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                }
                
            }
        }
        xhr.open('POST',base_ul+'patient/removeCart.php',true);
         xhr.send(fd);
}


function checkOut() {
    // var client_id    = byId('client_id').value;
    var ppid          = byId('ppid').value;
    var total        = byId('total').value;


        var fd = new FormData();
        fd.append('client_id',patient.id);
        fd.append('pid',ppid);
        fd.append('total',total);

        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response == true) {
                        document.getElementById('success').style.display='block';
                        document.getElementById('success').innerHTML='Thank you for choosing us please wait.....';
                       
                        setTimeout(function(){
                        document.getElementById('success').style.display="none";
                        window.location.href=resp.data;
                        }, 5000);
                    }
                else{

                    // btnAddTocart.innerHTML = "+ Cart";
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong !!';
                   
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                }
                
            }
        }
        xhr.open('POST',base_ul+'patient/checkout.php',true);
         xhr.send(fd);
}


function viewMyOrder(id) {
    // alert(id)
}

function readMessage(id) {
   let doctorName        = document.querySelector('#doctorName');
   let mess_yeReschedule = document.querySelector('#mess_yeReschedule');
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);

                for (var i = 0; i<resp.length; i++) {
                    mess_yeReschedule.innerHTML = resp[i].reschedule
                    doctorName.innerHTML = resp[i].doctorName
                }
               
                
            }
        }
        xhr.open('GET',base_ul+'patient/getMyreadMessage.php?client_id='+id,true);
        xhr.send();

}

function updateReadStatus(bid,cid) {
        var fd = new FormData();
        fd.append('book_id',bid);
        fd.append('client_id',cid);

        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response == true) {
                        $('#modalprimary').modal('show')
                         readMessage(cid)
                    }
                else{
                  alert("Something went wrong ask system admin")
                }
                
            }
        }
        xhr.open('POST',base_ul+'patient/updateReadStausBkAppnt.php',true);
         xhr.send(fd);


}


















































function byId(id) {
    return document.getElementById(id);
}

function currentConverssion() {
    var currency = byId('currency').value;
    var pricelog = byId('pricelog')
    var pricelogcon = byId('pricelogcon')
    if (currency=="ZWL") {

        pricelogcon.innerHTML = pricelog*80
        pricelog.display = 'none'
        pricelogcon.display = 'block'


    }
    else if (currency=="ZWL") {
        alert("ZWL")
        
    }
    else if (currency=="ZAR") {
         alert("ZAR")
    }
    else if (currency=="USD") {
         alert("USD")
    }
    else if (currency=="PULA") {
         alert("PULA")
    }
    else if (currency=="POUND") {
         alert("POUND")
    }




    

}

function disablePost() {
    byId('mybtn').disabled=true;
}
function direct(address) {
    
    var windowlocation = window.location.href;
    var directory = windowlocation.substring(0,windowlocation.lastIndexOf("/") +1);
    window.location.href=directory+address+".php";
}

