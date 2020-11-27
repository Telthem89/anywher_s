var base_ul ='../webservices/';
var admin = JSON.parse(localStorage.getItem('admin'));
function admin_login() {
	//variable declation taking value of feilds
    var username=byId('username').value;
    var password=byId('password').value;
    if(username==""||password=="")
    {
    	document.getElementById('alert').style.display='block';
	    document.getElementById('alert').innerHTML='Username and password are  all required ';
	    if(username==""){ byId('username').focus();}
	    else if(password==""){ byId('password').focus();}


	    setTimeout(function(){
	      byId('alert').style.display="none";
	    }, 5000);
	 }
	 else {
	 	 var fd = new FormData;
          fd.append('username',username);
          fd.append('password',password);

          var xhr= new XMLHttpRequest();
          xhr.open('POST',base_ul+'admin/login_admin.php',true);
          xhr.onreadystatechange = function () {
          	if (xhr.readyState ==4 && xhr.status==200) {
          			  var resp=JSON.parse(this.responseText);
          			if (resp.response==true) 
          			{
          				localStorage.clear();
          				localStorage.setItem('admin',JSON.stringify(resp));
          				direct('Dashboard')
          			}
          			else{
          				byId('alert').style.display='block';
					    byId('alert').innerHTML='Username and or password incorrect';
					   
					    setTimeout(function(){
					      byId('alert').style.display="none";
					    }, 5000);
          			}
          		
          	}
          	else if (xhr.readyState !=1 && xhr.status!=200) {
				return 'Error 500';
			}
          }
          xhr.send(fd);	
	 }
}

function homeadmindetail() {
  var flname = byId('flname');
  flname.innerHTML=admin.fullname
}


function getProfile() {
byId('avatartacover').src='../webservices/uploads/'+admin.photo;
byId('avatarta').src='../webservices/uploads/'+admin.photo;
byId('f_name').innerHTML=admin.fullname
byId('email').innerHTML=admin.email
byId('phone').innerHTML=admin.phone
}

/*
function getAllDoctors() {
  var allDoctorsSector = byId('allDoctorsSector');
  var xhtttp =new XMLHttpRequest();
  xhtttp.open("GET",base_ul+'admin/getallDoctorswithPendingStatus.php',true);
  xhtttp.onreadystatechange = function () 
  {
    if (xhtttp.readyState ==4 && xhtttp.status==200)
    {
      if (this.responseText !=null)
      {
        var resp = JSON.parse(this.responseText);
         for (var i = 0; i < resp.length; i++)
         {
             var tr = document.createElement('tr');
             


              var dname= document.createElement('td');
              var mdate= document.createElement('td');
              var action= document.createElement('td');
              var status= document.createElement('td');


              dname.setAttribute('class','agenda-time');
              mdate.setAttribute('class','agenda-date active');
              action.setAttribute('class','agenda-events');
              status.setAttribute('class','agenda-events');

              dname.innerHTML=`${resp[i].fullname}`;
              mdate.innerHTML=`
                       <div class="dayofmonth">${resp[i].mydayofMonths}</div>
                      <div class="dayofweek">${resp[i].dataName}</div>
                      <div class="shortdate text-muted">${resp[i].myMonthName}, ${resp[i].yearname}</div>
              `;
              status.innerHTML=`
              ${resp[i].adminstatus}
              `;
              action.innerHTML=`
                <div class="row">
                          <div class="col-md-4 text-blue">
                            <a class="no-anchor-style" href="#" onclick="$('#modalprimary').modal('show'),loadDoctorDetails(${resp[i].id})">
                              <span class="fa fa-info-circle"></span>
                              Details<br>
                            </a>
                          </div>
                          <div class="col-md-4 text-green">
                            <a class="no-anchor-style" href="#" onclick="Approve(${resp[i].id})">
                              <span class="fa fa-check-circle"></span>
                              Approve<br>
                            </a>
                          </div>
                          <div class="col-md-4 text-red">
                            <a class="no-anchor-style" href="#" onclick="Reject(${resp[i].id})">
                              <span class="fa fa-trash"></span>
                              Reject<br>
                            </a>
                          </div>
                        </div>
              `;


               tr.appendChild(dname);
                tr.appendChild(mdate);
                tr.appendChild(action);
                tr.appendChild(status);

                allDoctorsSector.appendChild(tr);
         }
      }
    }
  }
  
  xhtttp.send();
}
*/

function getAllClients() {
  var mainConterPatient = byId('mainConterPatient');
  var xhtttp =new XMLHttpRequest();
  xhtttp.open("GET",base_ul+'admin/getAllClient.php',true);
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
          for (myObjects in myObject){
            html = `
                <div class="card">
                  <img src="../webservices/uploads/${myObject.avatar}" alt="Cover" class="card-img-top">
                  <div class="card-body text-center">
                    <img src="../webservices/uploads/${myObject.avatar}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                    <h5 class="card-title">${myObject.fullname}</h5>
                    <p class="heading2">${myObject.email}</p>
                    <p class="text-secondary user-status mb-1">ACTIVE</p>
                    <p class="text-muted font-size-sm">${myObject.phoneNumber}</p>
                  </div>
                  <div class="card-footer text-center">
                    <div class="row">
                      <div class="col-md-12">
                        <button class="btn btn-success btn-sm" onclick="$('#modalprimary').modal('show'),loadClientInfo(${myObject.id})"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm""buttn" data-toggle="tooltip" title="delete" onclick="deleteClientInfo(${myObject.id})" ><i class="fa fa-trash" ></i></button>
                        <button class="btn btn-info btn-sm" data-toggle="tooltip" title="verify" onclick="verifyClientInfo(${myObject.id})" ><i class="fa fa-check-circle"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
            `
          }
             var section = document.createElement("div");
              section.setAttribute("class", "col-md-6");
              section.innerHTML =html;
              mainConterPatient.appendChild(section);
         }
      }
    }
  }
  
  xhtttp.send();
}


function totalDoctors() {
    var totalDoctors =byId('totalDoctors')
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'admin/totalPendingDoctors.php',true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    totalDoctors.innerHTML=resp[i].totalDoctors;
                }

                }

                
            }
        }
         xhr.send();
}

function totalClient() {
    var totalClient =byId('totalClient')
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'admin/getAllClientsCount.php',true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    totalClient.innerHTML=resp[i].totalClient;
                }

                }

               
            }
        }
         xhr.send();
}

function getAllPractioners() {
  var practioner = byId('practioner');
  var xhtttp =new XMLHttpRequest();
  xhtttp.open("GET",base_ul+'admin/getAllDoctors.php',true);
  xhtttp.onreadystatechange = function () 
  {
    if (xhtttp.readyState ==4 && xhtttp.status==200)
    {
      if (this.responseText !=null)
      {
        var resp = JSON.parse(this.responseText);
         for (var i = 0; i < resp.length; i++)
         {
             var tr = document.createElement('tr');

              var select= document.createElement('td');
              var photo= document.createElement('td');
              var dname= document.createElement('td');
              var speciality= document.createElement('td');
              var joindate= document.createElement('td');
              var status= document.createElement('td');
              var actions= document.createElement('td');


              select.setAttribute('class','align-middle');
              photo.setAttribute('class','align-middle text-center');
              dname.setAttribute('class','text-nowrap align-middle');
              speciality.setAttribute('class','text-nowrap align-middle');
              joindate.setAttribute('class','text-nowrap align-middle');
              status.setAttribute('class','text-center align-middle');
              actions.setAttribute('class','text-center align-middle');


              select.innerHTML=`<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                              <input type="checkbox" class="custom-control-input" id="item-1">
                              <label class="custom-control-label" for="item-1"></label>
                            </div>`;
              photo.innerHTML=`<div class="bg-light d-inline-flex justify-content-center align-items-center align-top" style="width: 35px; height: 35px; border-radius: 3px;">
                                <img src="../webservices/uploads/${resp[i].avatar}" style="opacity: 0.8;"></div>`
              dname.innerHTML=`${resp[i].fullname}`
              speciality.innerHTML=`${resp[i].speciality}`
              joindate.innerHTML=`<span>${resp[i].datecreate}</span>`
              status.innerHTML=`<i class="fa fa-fw text-secondary cursor-pointer fa-toggle-on text-green"></i>`
              actions.innerHTML=`<button class="badge badge-success" type="button"   onclick="$('#user-form-modal').modal('show'),loadDoctInfo(${resp[i].id})"><i class="fa fa-edit"></i></button>
                                <button class="badge badge-danger" type="button"><i class="fa fa-trash"></i></button>`
               tr.appendChild(select);
                tr.appendChild(photo);
                tr.appendChild(dname);
                tr.appendChild(speciality);
                tr.appendChild(joindate);
                tr.appendChild(status);
                tr.appendChild(actions);
                practioner.appendChild(tr);
         }
      }
    }
  }
  
  xhtttp.send();
}


function loadDoctorDetails(id) {
  //getDoctorProfile.php
var MDPCZ_ID=byId('MDPCZ_ID')
var gender=byId('gender')
var fname=byId('fname')
var lname=byId('lname')
var phoneNumber=byId('phoneNumber')
var email=byId('email')
var avatar_img=byId('avatar_img')
  var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/getDoctorProfile.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    MDPCZ_ID.value=resp[i].MDPCZ_ID;
                    gender.value=resp[i].gender;
                    fname.value=resp[i].firstname;
                    lname.value=resp[i].lastname;
                    phoneNumber.value=resp[i].phoneNumber;
                    email.value=resp[i].email;
                    avatar_img.src='../webservices/uploads/'+ resp[i].avatar;

                }
                }

                
            }
        }
         xhr.send();
}


function cregisterClient()
{
  var fname=byId('fname').value;
  var lname=byId('lname').value;
  var email=byId('email').value;
  var phoneNumber=byId('phoneNumber').value;
  var pass=byId('pass').value;
  var passcom=byId('passcom').value;
  var cgender=byId('cgender').value;
  var caddesss=byId('caddesss').value;

  var fd = new FormData;
  fd.append('firstname',fname);
  fd.append('lastname',lname);
  fd.append('email',email);
  fd.append('phoneNumber',phoneNumber);
  fd.append('password',pass);
  fd.append('gender',cgender);
  fd.append('address',caddesss);

  var xhr= new XMLHttpRequest();
  // xhr.open('POST','https://remotehealth.sagehillhost.com/webservices/patient/patient_register.php',true);
  xhr.open('POST',base_ul+'admin/admin_patient_register.php',true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
    {

   var resp = JSON.parse(this.responseText);
         if (resp.response=="E-mail Address is already exist please try another E-mail Address") {
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='E-mail Address is already exist please try another E-mail Address';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                    return false;
            }
            else if (resp.response=="Phone is already exist please try another phone Number") {
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Phone is already exist please try another phone Number';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
                    return false;
            }
            
            else if (resp.response==true){
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Account Successfully Created you may check your email address';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);

                    setTimeout(function(){
                      direct('users');
                      }, 5000);
                    
                     
              }
              else{
                    document.getElementById('alert').style.display='block';
                    document.getElementById('alert').innerHTML='Something went wrong contact Ustawi Techinical Team';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000); 
              } 
        }
      }
      xhr.send(fd);
}


function  registerPractionner() {
var MDPCZ_ID=byId('MDPCZ_ID').value;
var firstname=byId('firstname').value;
var lastname=byId('lastname').value;
var dob=byId('dob').value;
var gender=byId('gender').value;
var phoneNumber=byId('phone1').value;
var email=byId('emailAddress').value;
var address=byId('address').value;
var qualification=byId('qualification').value;
var specialty=byId('specialty').value;
var experience=byId('experience').value;
var password=byId('password').value;

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
   // raise a post xhr request to service
        var xhr= new XMLHttpRequest();     
        xhr.open('POST',base_ul+'admin/admin_doctor.php',true);
     xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
            { 
                if(this.responseText!='Email address already Exist please choose anaother email')
                {
                     
                         byId('success1').style.display='block';
                         byId('success1').innerHTML='Account Successfully Created';
                    setTimeout(function(){
                    document.getElementById('alert').style.display="none";
                    }, 5000);
                    setTimeout(function(){
                      direct('practitioners');
                      }, 5000);

                }
                else{

                         byId('alert1').style.display='block';
                         byId('alert1').innerHTML='Email address already Exist please choose anaother email';
                    setTimeout(function(){
                         byId('alert1').style.display="none";
                    }, 5000);

                } 

            }
        }
        //send form data
        xhr.send(fd);
}

function Approve(id){
    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'admin/approve.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response==true) {
                   byId('success').style.display='block';
                  byId('success').innerHTML='Account has been approved successfully';
                  setTimeout(function(){
                    byId('success').style.display="none";
                    }, 5000);
                }
                else {
                    byId('alert').style.display='block';
                  byId('alert').innerHTML='Error occur try again';
                  setTimeout(function(){
                    byId('alert').style.display="none";
                    }, 5000);
                }
            }
        }
         xhr.send();
}

function Reject(id){
    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'admin/reject.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response==true) {
                   byId('success').style.display='block';
                    byId('success').innerHTML='Account has been rejected';
                    setTimeout(function(){
                      byId('success').style.display="none";
                      }, 5000);
                }
                else {
                    byId('alert').style.display='block';
                  byId('alert').innerHTML='Error occur try again';
                  setTimeout(function(){
                    byId('alert').style.display="none";
                    }, 5000);
                }

            }
        }
         xhr.send();
}

function loadClientInfo(id){
  var fname=byId('fname');
  var lname=byId('lname');
  var email=byId('email');
  var phoneNumber=byId('phoneNumber');
  var cgender=byId('cgender');
  var caddesss=byId('caddesss');
  var cid=byId('cid');
  byId('clientreg').style.display = 'none'

        var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'patient/getClientProfile.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    fname.value=resp[i].firstname;
                    lname.value=resp[i].lastname;
                    email.value=resp[i].email;
                    phoneNumber.value=resp[i].phoneNumber;
                    cgender.value=resp[i].gender;
                    caddesss.value=resp[i].address;
                    cid.value=resp[i].id;

                }
                }

                
            }
        }
         xhr.send();


}
function updateClientInfo(){
  var fname=byId('fname').value;
  var lname=byId('lname').value;
  var email=byId('email').value;
  var phoneNumber=byId('phoneNumber').value;
  var pass=byId('pass').value;
  var cid=byId('cid').value;
  var cgender=byId('cgender').value;
  var caddesss=byId('caddesss').value;

  var fd = new FormData;
  fd.append('firstname',fname);
  fd.append('lastname',lname);
  fd.append('email',email);
  fd.append('phoneNumber',phoneNumber);
  fd.append('gender',cgender);
  fd.append('address',caddesss);
  fd.append('password',pass);
  fd.append('id',cid);


  var xhr= new XMLHttpRequest();
  xhr.open('POST',base_ul+'admin/updateClientInfor.php',true);
    xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
    {

   var resp = JSON.parse(this.responseText);
          if(resp.response==true)
          {
             byId('success').style.display='block';
              byId('success').innerHTML='Client information Updated successfully';
              setTimeout(function(){
              byId('alert').style.display="none";
              }, 5000);

              setTimeout(function(){
                direct('users');
                }, 5000);     
          }

          else{
             byId('alert').style.display='block';
              byId('alert').innerHTML='Failed to update client account something went wrong';
              setTimeout(function(){
              byId('alert').style.display="none";
              }, 5000);
            }
        }
      }
      xhr.send(fd);
}
function deleteClientInfo(id){

        var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'admin/deleteClient.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                     if (resp.response == true) 
                     {
                         byId('success').style.display='block';
                         byId('success').innerHTML='Account deleted successfully';
                        setTimeout(function(){
                          byId('success').style.display="none";
                          }, 5000);
                     }
                     else {
                        byId('alert').style.display='block';
                         byId('alert').innerHTML='Error occured trying to delete account';
                        setTimeout(function(){
                          byId('alert').style.display="none";
                          }, 5000)
                     }
                }

                
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
              return 'Error 500';
            }
        }
         xhr.send();
}
function verifyClientInfo(id){
  alert(id);
}



function loadDoctInfo(id) {
  var MDPCZ_ID=byId('MDPCZ_ID');
  var firstname=byId('firstname');
  var lastname=byId('lastname');
  var dob=byId('dob');
  var gender=byId('gender');
  var phoneNumber=byId('phone1');
  var email=byId('emailAddress');
  var address=byId('address');
  var qualification=byId('qualification');
  var specialty=byId('specialty');
  var experience=byId('experience');
  var pid=byId('pid');
  byId('register').style.display = 'none'


   var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'doctor/getDoctorProfile.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText !=null) {
                     var resp = JSON.parse(this.responseText);
                for (var i = 0; i < resp.length; i++){
                    MDPCZ_ID.value=resp[i].MDPCZ_ID;
                    firstname.value=resp[i].firstname;
                    lastname.value=resp[i].lastname;
                    dob.value=resp[i].dob;
                    gender.value=resp[i].gender;
                    phoneNumber.value=resp[i].phoneNumber;
                    email.value=resp[i].email;
                    address.value=resp[i].address;
                    qualification.value=resp[i].qualification;
                    specialty.value=resp[i].speciality;
                    experience.value=resp[i].experience;
                    pid.value=resp[i].id;

                }
                }

                
            }
        }
         xhr.send();
}


function updatePractionner(){
  var MDPCZ_ID=byId('MDPCZ_ID').value;
  var firstname=byId('firstname').value;
  var lastname=byId('lastname').value;
  var dob=byId('dob').value;
  var gender=byId('gender').value;
  var phoneNumber=byId('phone1').value;
  var email=byId('emailAddress').value;
  var address=byId('address').value;
  var qualification=byId('qualification').value;
  var specialty=byId('specialty').value;
  var experience=byId('experience').value;
  var pid=byId('pid').value;
  var password=byId('password').value;


var fd = new FormData;
fd.append('MDPCZ_ID',MDPCZ_ID);
fd.append('firstname',firstname);
fd.append('lastname',lastname);
fd.append('dob',dob);
fd.append('gender',gender);
fd.append('address',address);
fd.append('qualification',qualification);
fd.append('speciality',specialty);
fd.append('experience',experience);
fd.append('phoneNumber',phoneNumber);
fd.append('email',email);
fd.append('password',password);
fd.append('id',pid);


  var xhr= new XMLHttpRequest();
  xhr.open('POST',base_ul+'admin/updatedoctorInfor.php',true);
    xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
    {

   var resp = JSON.parse(this.responseText);
          if(resp.response==true)
          {
             byId('success1').style.display='block';
              byId('success1').innerHTML='Doctor information Updated successfully';
              setTimeout(function(){
              byId('success1').style.display="none";
              }, 5000);

              setTimeout(function(){
                direct('users');
                }, 5000);     
          }

          else{
             byId('alert1').style.display='block';
              byId('alert1').innerHTML='Failed to update Doctor account something went wrong';
              setTimeout(function(){
              byId('alert1').style.display="none";
              }, 5000);
            }
        }
      }
      xhr.send(fd);
}


/*========================================Pharmacist/ Pharmacy======================================*/
function loadAllPendingPharmacists(){
   var xhr= new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200)
            {
                var resp = JSON.parse(this.responseText);
                for(var i=0;i<resp.length;i++){
                    var p = resp[i];
                    // console.log(resp[i].firstname)
                }
            }
        else if (xhr.readyState !=1 && xhr.status!=200) {
            return 'Error 500';
        }

      }
      xhr.open('GET',base_ul+'pharmacy/getAllPharmacys.php',true);
      xhr.send();

}

function getPharmachDetails(id){
  var pfirstname      = byId('pfirstname')
  var plastname       = byId('plastname')
  var pdob            = byId('pdob')
  var phoneNum        = byId('pphone1')
  var pgender         = byId('pgender')
  var pemailAddress   = byId('pemailAddress')
  var paddress        = byId('paddress')
  var pqualification  = byId('pqualification')
  var phid            = byId('phid')

 var pharmname        = byId('pharmname')
 var register         = byId('register')
 var btnUpdate        = byId('btnUpdate')

 register.style.display='none'
 btnUpdate.style.display='block'
 pharmname.innerHTML ='Update Pharmacist';
 var xhr= new XMLHttpRequest();
 xhr.onreadystatechange = function () {
  if (xhr.readyState ==4 && xhr.status==200){
    var resp = JSON.parse(this.responseText);
    for(var i=0;i<resp.length;i++){
          pfirstname.value      = resp[i].firstname
          plastname.value       = resp[i].lastname
          pdob .value           = resp[i].dob
          phoneNum .value       = resp[i].phoneNumber
          pgender .value        = resp[i].gender
          pemailAddress .value  = resp[i].email
          paddress.value        = resp[i].address
          pqualification.value  = resp[i].qualification
          phid .value           = resp[i].id
    }
  }
    else if (xhr.readyState !=1 && xhr.status!=200) {
      return 'Error 500';
  }
 }
  xhr.open('GET',base_ul+'admin/getPharmacistProfile.php?id='+id,true);
  xhr.send();
}


function registerPharmacist(){
  var pfirstname      = byId('pfirstname').value
  var plastname       = byId('plastname').value
  var pdob            = byId('pdob').value
  var phoneNum        = byId('pphone1').value
  var pgender         = byId('pgender').value
  var pemailAddress   = byId('pemailAddress').value
  var paddress        = byId('paddress').value
  var pqualification  = byId('pqualification').value
  var ppassword       = byId('ppassword').value

var fd = new FormData();
fd.append('firstname',pfirstname);
fd.append('lastname',plastname);
fd.append('dob',pdob);
fd.append('gender',pgender);
fd.append('address',paddress);
fd.append('qualification',pqualification);
fd.append('phoneNumber',phoneNum);
fd.append('email',pemailAddress);
fd.append('password',ppassword);


  var xhr= new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200)
            {
                var resp = JSON.parse(this.responseText);
                if (resp.response=="E-mail Address is already exist") {
                     document.getElementById('alert').style.display='block';
                     document.getElementById('alert').innerHTML='E-mail Address is already exist please try another E-mail Address';
                     setTimeout(function(){
                     document.getElementById('alert').style.display="none";
                     }, 5000); 
                     return false;
             }
             else  if (resp.response=="Phone is already exist") {
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
                  document.getElementById('success').style.display="none";
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
        else if (xhr.readyState !=1 && xhr.status!=200) {
            return 'Error 500';
        }

      }
  xhr.open('POST',base_ul+'admin/admin_pharmacy.php',true);
  xhr.send(fd);
}

function updatePharmacist(){
  var pfirstname      = byId('pfirstname').value
  var plastname       = byId('plastname').value
  var pdob            = byId('pdob').value
  var phoneNum        = byId('pphone1').value
  var pgender         = byId('pgender').value
  var pemailAddress   = byId('pemailAddress').value
  var paddress        = byId('paddress').value
  var pqualification  = byId('pqualification').value
  var phid            = byId('phid').value


var fd = new FormData;
fd.append('firstname',pfirstname);
fd.append('lastname',plastname);
fd.append('dob',pdob);
fd.append('gender',pgender);
fd.append('address',paddress);
fd.append('qualification',pqualification);
fd.append('phoneNumber',phoneNum);
fd.append('email',pemailAddress);
fd.append('id',phid);

var xhr= new XMLHttpRequest();
xhr.onreadystatechange = function () {
 if (xhr.readyState ==4 && xhr.status==200){
   var resp = JSON.parse(this.responseText);
   if(resp.response == true){
    swal({
      icon: "success",
    });

    setTimeout(function(){
      location.reload();
      }, 5000); 
   }
   else{
    swal({
      icon: "error",
    });
   }
  
 }
   else if (xhr.readyState !=1 && xhr.status!=200) {
     return 'Error 500';
 }
}
  xhr.open('POST',base_ul+'admin/updatePharmacistInfor.php',true);
  xhr.send(fd);
}

function deletePharm(id){

  var xhr= new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
        {
            var resp = JSON.parse(this.responseText);
            if(resp.response ==true){
              swal({
                icon: "success",
              });
              setInterval(function(){
                location.reload();
              },1000)

            }
           
        }
    else if (xhr.readyState !=1 && xhr.status!=200) {
        return 'Error 500';
    }

  }
  xhr.open('GET',base_ul+'admin/deletePharmacist.php?id='+id,true);
  xhr.send();
}

function VerifyPharmacist(params){
   var xhr= new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
        {
            var resp = JSON.parse(this.responseText);
            if(resp.response ==true){
              swal({
                icon: "success",
              });
              setInterval(function(){
                location.reload();
              },1000)

            }
           
        }
    else if (xhr.readyState !=1 && xhr.status!=200) {
        return 'Error 500';
    }

  }
  xhr.open('GET',base_ul+'admin/approvePharm.php?id='+params,true);
  xhr.send();
}

function RejectPharmacist(params) {
   var xhr= new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState ==4 && xhr.status==200)
        {
            var resp = JSON.parse(this.responseText);
            if(resp.response ==true){
              swal({
                icon: "success",
              });
              setInterval(function(){
                location.reload();
              },1000)

            }
           
        }
    else if (xhr.readyState !=1 && xhr.status!=200) {
        return 'Error 500';
    }

  }
  xhr.open('GET',base_ul+'admin/rejectPharmacist.php?id='+params,true);
  xhr.send();
}
/*========================================Pharmacist/ Pharmacy======================================*/






















































































































































//logout
function Logout() {
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'admin/logout.php?id='+admin.id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText =='error') {
                    localStorage.removeItem("admin");
                    direct("../index")
                }
                
            }
        }
         xhr.send();
}


function byId(id) {
	return document.getElementById(id);
}

function direct(address) {
	
	var windowlocation = window.location.href;
	var directory = windowlocation.substring(0,windowlocation.lastIndexOf("/") +1);
	window.location.href=directory+address+".php";
}