var base_ul      ='../webservices/';
var pharmacy     = JSON.parse(localStorage.getItem('pharmacy'));
// ========================== PHARMACIST==========================================//
/*Load ALL Pharmacist Details from Local storage */

	function LoadPharmacistFromLocalStorage_home() {
		var flname          = byId('flname');
		flname.innerHTML    =pharmacy.fullname;
	    byId('avatar1').src ='../webservices/uploads/'+pharmacy.avatar;
	}


    function loadPharmacistprofile()
    {
        var  fname              = byId('fname');
        fname.innerHTML         = pharmacy.fullname;
        var first_name          = byId('first_name');
        var last_name           = byId('last_name');
        var dob                  =byId('dob').value;
        var gender               =byId('gender').value;
        var phone               = byId('phone');
        var email               = byId('email');
        var nationality         = byId('nationality');
        var city                = byId('city');
        var work_address        = byId('work_address');
        var qualification       = byId('qualification');
        var city                = byId('city');
        var facebook            =byId('facebook')
        var youtube             =byId('youtube')
        var skype               =byId('skype')
        var twitter             =byId('twitter')
        var instagram           =byId('instagram')
        var viber               =byId('viber')

        first_name.value        =pharmacy.firstname
        last_name.value         =pharmacy.lastname;
        dob.innerHTML           =pharmacy.dob;
        gender.innerHTML        =pharmacy.gender;
        phone.value             =pharmacy.phoneNumber;
        email.value             =pharmacy.email;
        work_address.value      =pharmacy.address;
        qualification.value     =pharmacy.qualification;
        nationality.value       =pharmacy.country
        city.value              =pharmacy.city
        facebook.value          =pharmacy.facebook              
        youtube.value           =pharmacy.youtube
        skype .value            =pharmacy.skype
        twitter.value           =pharmacy.twitter
        instagram.value         =pharmacy.instagram
        viber .value            =pharmacy.viber
        byId('avatar').src      ='../webservices/uploads/'+pharmacy.avatar;
        byId('avatar1').src     ='../webservices/uploads/'+pharmacy.avatar;
    }
/*Load ALL Pharmacist Details from Local storage */


/*E-mail Verification Code*/
function pharmacy_ActivateAccount() {
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
  
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'pharmacy/activateAccountpharm.php',true);
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
/*E-mail Verification Code*/

/*Update Pharmacist Profile*/
function UpdatePharmacistProfile() 
{
    var first_name=byId('first_name').value;
    var last_name=byId('last_name').value;
    var work_address=byId('work_address').value;
    var qualification=byId('qualification').value;
    var phone=byId('phone').value;
    var email=byId('email').value;
    var dob=byId('dob').value;
    var gender=byId('gender').value;
    var nationality=byId('nationality').value;
    var city=byId('city').value;
    // var bio=byId('bio').value;

        var fd = new FormData();
        fd.append('id',pharmacy.id);
        fd.append('firstname',first_name);
        fd.append('lastname',last_name);
        fd.append('dob',dob);
        fd.append('gender',gender);
        fd.append('address',work_address);
        fd.append('qualification',qualification);
        fd.append('phoneNumber',phone);
        fd.append('email',email);
        fd.append('country',nationality);
        fd.append('city',city);
        
        $('#logging_in').modal('show')
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'pharmacy/updatePharmacist.php',true);
        // btnUpdate.innerHTML = "Please Wait...."

        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                $('#logging_in').modal('hide')
                if (resp.response ==true) {
                    
                    $('#logging_in').modal('hide')
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Account has been updated successfully';
                   getPharmProfileDetails(pharmacy.id);
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                     $('#logging_in').modal('hide')
                    
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
/* Update Pharmacist Profile */


/*Update Pharmacist Profile Picture*/
function UpdatePharmacistProfilePicture() 
{
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
        fd.append('id',pharmacy.id);
        fd.append('avatar',avatar);
   
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'pharmacy/updatePharmacistProPic.php',true);
         $('#logging_in').modal('show')
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){         
                $('#logging_in').modal('hide')
                var resp = JSON.parse(this.responseText);
                if (resp.response == true) {
                     $('#logging_in').modal('hide')
                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Your profile picture has been updated successfully !!';
                    getPharmProfileDetails(pharmacy.id)
                    setTimeout(function(){
                     document.getElementById('success').style.display="none";
                      $('#logging_in').modal('hide')
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
         xhr.send(fd);
     }
}
/* Pharmacist Profile Picture*/

function updatePharmacistSocialDetails() {
    var facebook    =byId('facebook').value
    var youtube     =byId('youtube').value
    var skype       =byId('skype').value
    var twitter     =byId('twitter').value
    var instagram   =byId('instagram').value
    var viber       =byId('viber').value


        var fd      = new FormData();
        fd.append('id',pharmacy.id);
        fd.append('facebook',facebook);
        fd.append('youtube',youtube);
        fd.append('skype',skype);
        fd.append('twitter',twitter);
        fd.append('instagram',instagram);
        fd.append('viber',viber);

 
        var xhr= new XMLHttpRequest();
        xhr.open('POST',base_ul+'pharmacy/updatesocialMedia.php',true);
        $('#logging_in').modal('show')
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                if (resp.response ==true) {
                    $('#logging_in').modal('hide')

                    document.getElementById('success').style.display='block';
                    document.getElementById('success').innerHTML='Social has been updated successfully';
                    getPharmProfileDetails(pharmacy.id);
                    setTimeout(function(){
                    document.getElementById('success').style.display="none";
                    $('#logging_in').modal('hide')
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


function getPharmProfileDetails(id) {
    var first_name       =byId('first_name');
    var last_name        =byId('last_name');
    var dob              =byId('dob');
    var gender           =byId('gender');
    var phone            =byId('phone');
    var email            =byId('email').value;
    var nationality      =byId('nationality');
    var city             =byId('city');
    var work_address     =byId('work_address');
    var qualification    =byId('qualification');

    var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'pharmacy/getPharmicistProfile.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                localStorage.clear();
                for (var i = 0; i < resp.length; i++){
                     var pharmacy = resp[i];
                    localStorage.setItem('pharmacy',JSON.stringify(pharmacy));

                    first_name.value    =resp[i].firstname
                    last_name.value     =resp[i].lastname
                    dob.value     =resp[i].dob
                    gender.value     =resp[i].gender
                    phone.value         =resp[i].phoneNumber
                    email.value         =resp[i].email
                    nationality.value   =resp[i].country
                    city.value          =resp[i].city
                    work_address.value  =resp[i].address
                    qualification.value =resp[i].qualification

                }
            }
        }
         xhr.send();
}

// =================================END PHARMACIST==========================================//






// ================================= ADD SUPPLIER==========================================//
function AddSupplier() {

    //regex for email validation 
     const emailregrex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
     //regex for phone validation 
     const phonevali =/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;


    var comapany_name        =byId('comapany_name').value
    var country              =byId('country').value
    var city                 =byId('city').value
    var address              =byId('address').value
    var phone                =byId('phone').value
    var email                =byId('email').value
    var btnSupplier          =byId('btnSupplier')
    // var btnUpdateSupplier    =byId('btnUpdateSupplier')

    if (comapany_name =='') {
        byId('alert').style.display='block';
        byId('alert').innerHTML='Please Company Name is required';
        byId('alert').class="btn btn-warning"
        byId('comapany_name').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }
    else if (country==''){
        byId('alert').style.display='block';
        byId('alert').innerHTML='Country is required';
        byId('alert').class="btn btn-warning"
        byId('country').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }
    else if (city==''){
        byId('alert').style.display='block';
        byId('alert').innerHTML='City is required';
        byId('alert').class="btn btn-warning"
        byId('city').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }
    else if (address==''){
        byId('alert').style.display='block';
        byId('alert').innerHTML='Physical Address is required';
        byId('alert').class="btn btn-warning"
        byId('address').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }
    else if (phone==''){
        byId('alert').style.display='block';
        byId('alert').innerHTML='Phone Number is required';
        byId('alert').class="btn btn-warning"
        byId('phone').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }
    else if (phonevali.test(phone)==false){
        byId('alert').style.display='block';
        byId('alert').innerHTML='Not a valid Phone Number please enter valid phone';
        byId('alert').class="btn btn-warning"
        byId('phone').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }
    else if (email==''){
        byId('alert').style.display='block';
        byId('alert').innerHTML='E-mail Address is required';
        byId('alert').class="btn btn-warning"
        byId('email').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }
    else if (emailregrex.test(email)==false){
        byId('alert').style.display='block';
        byId('alert').innerHTML='Valid email is required';
        byId('alert').class="btn btn-warning"
        byId('email').focus();
        setTimeout(function(){
           byId('alert').style.display="none";
        }, 5000);
    }

    else {
         var fd = new FormData;
          fd.append('comapany_name',comapany_name);
          fd.append('country',country);
          fd.append('city',city);
          fd.append('address',address);
          fd.append('phone',phone);
          fd.append('email',email);
          btnSupplier.innerHTML="Please wait...."

          var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                // byId('formReset').reset();
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Supplier has been added successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        btnSupplier.innerHTML="Add Supplier"
                        byId('formReset').reset();
                        byId('success').style.display='none';
                        $('#modalprimary').modal('hide')
                        direct('supplier')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to add Supplier try again!!';
                    setTimeout(function(){
                         btnSupplier.innerHTML="Add Supplier"
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("POST",base_ul+'pharmacy/AddSupplier.php',true);
          xhr.send(fd);
    }

}
function GetAllSuppliers() {
    const mySuppliers =   document.querySelector('#mySuppliers');
    var xhr= new XMLHttpRequest();   
    xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200) {
            if (this.responseText!=null) {
                var resp = JSON.parse(this.responseText);
                var num = 0;
                for (var i = 0; i < resp.length; i++){
                    num++;
                        var tr = document.createElement('tr');

                        var serialNum= document.createElement('td');
                        var company= document.createElement('td');
                        var country= document.createElement('td');
                        var city= document.createElement('td');
                        // var address= document.createElement('td');
                        var phone= document.createElement('td');
                        var email= document.createElement('td');
                        var catAction= document.createElement('td');









                        serialNum.setAttribute('class','text-center');
                        catAction.setAttribute('class','text-center');

                        
                        serialNum.innerHTML=num;
                        company.innerHTML=resp[i].comapany_name;
                        country.innerHTML=resp[i].country;
                        city.innerHTML=resp[i].city;
                        // address.innerHTML=resp[i].address;
                        phone.innerHTML=resp[i].phone;
                        email.innerHTML=resp[i].email;
                        catAction.innerHTML=`
                        <button class="btn btn-sm btn-success" type="button" onclick="$('#modalprimary').modal('show'),GetSupplierDetails(${resp[i].id})" ><i class="fa fa-user-plus"></i> </button>
                        <button class="btn btn-sm btn-danger" type="button" onclick="DeleteSupplier(${resp[i].id})"><i class="fa fa-trash"></i> </button>
                        `;


                        tr.appendChild(serialNum);
                        tr.appendChild(company);
                        tr.appendChild(country);
                        tr.appendChild(city);
                        // tr.appendChild(address);
                        tr.appendChild(phone);
                        tr.appendChild(email);
                        tr.appendChild(catAction);
                        mySuppliers.appendChild(tr);

                  
                }

            }
        }
        else if (xhr.readyState !=1 &&xhr.status!=200) {
            return 'Error 500';
        }
    }
    xhr.open('GET',base_ul+'pharmacy/getAllSuppliers.php',true);
    xhr.send();
}
function GetSupplierDetails(id) {
    var comapany_name        =byId('comapany_name')
    var country              =byId('country')
    var city                 =byId('city')
    var address              =byId('address')
    var phone                =byId('phone')
    var email                =byId('email')
    var sid                  =byId('sid')
    var btnSupplier          =byId('btnSupplier')
    var btnUpdateSupplier    =byId('btnUpdateSupplier')

     btnSupplier.style.display = 'none'
     btnUpdateSupplier.style.display = 'block'
     

     ctname.innerHTML     =""
     var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'pharmacy/getSupplierDetail.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                
                for (var i = 0; i < resp.length; i++){
                    ctname.innerHTML     ='Update '+ resp[i].comapany_name 
                    comapany_name.value =resp[i].comapany_name 
                    country.value       =resp[i].country 
                    city.value          =resp[i].city 
                    address.value       =resp[i].address 
                    phone.value         =resp[i].phone 
                    email.value         =resp[i].email 
                    sid.value           =resp[i].id  
                }
            }
        }
        xhr.send();
}
function UpdateSupplierDetails() {
    var comapany_name        =byId('comapany_name').value
    var country              =byId('country').value
    var city                 =byId('city').value
    var address              =byId('address').value
    var phone                =byId('phone').value
    var email                =byId('email').value
    var sid                  =byId('sid').value
    var btnSupplier          =byId('btnSupplier')
    var btnUpdateSupplier    =byId('btnUpdateSupplier')


    var fd                   = new FormData;

          fd.append('id',sid);
          fd.append('comapany_name',comapany_name);
          fd.append('country',country);
          fd.append('city',city);
          fd.append('address',address);
          fd.append('phone',phone);
          fd.append('email',email);
          btnUpdateSupplier.innerHTML="Please wait...."

          var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                // byId('formReset').reset();
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Supplier has been updated successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        btnSupplier.style.display = 'block'
                        btnUpdateSupplier.style.display = 'none'
                        byId('formReset').reset();
                        byId('success').style.display='none';
                        $('#modalprimary').modal('hide')
                        direct('supplier')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to add Supplier try again!!';
                    setTimeout(function(){
                        btnCategory.innerHTML="Add Category"
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("POST",base_ul+'pharmacy/updateSupplier.php',true);
          xhr.send(fd);
}
function DeleteSupplier(id) {
    var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Supplier has been deleted successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        byId('success').style.display='none';
                        direct('supplier')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to delete Supplier try again!!';
                    setTimeout(function(){
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("GET",base_ul+'pharmacy/deleteSupplier.php?id='+id,true);
          xhr.send();
}

// ================================= END ADD SUPPLIER==========================================//













// ================================= ADD MEDICINE==========================================//
function AddMedicine() {
    var name                 =byId('name').value
    var quantity             =byId('quantity').value
    var usage                =byId('usage').value
    var sideeffect           =byId('sideeffect').value
    var precautions          =byId('precautions').value
    var interation           =byId('interation').value
    var overdose             =byId('overdose').value
    var imageurl             =byId('imageurl').files[0]
    var supplierId           =byId('supplierId').value
    var catID                =byId('catID').value
    var expiry_date          =byId('expiry_date').value
    var btnAddMedicine       =byId('btnAddMedicine')
    //var btnUpdateMedicine    =byId('btnUpdateMedicine')


 var fd = new FormData();
 fd.append('name',name);
 fd.append('quantity',quantity);
 fd.append('usage',usage);
 fd.append('sideeffect',sideeffect);
 fd.append('precautions',precautions);
 fd.append('interation',interation);
 fd.append('overdose',overdose);
 fd.append('imageurl',imageurl);
 fd.append('supplierId',supplierId);
 fd.append('catID',catID);
 fd.append('expiry_date',expiry_date);


     var xhr= new XMLHttpRequest();
     btnAddMedicine.innerHTML='Loading...'
    xhr.onreadystatechange = function (){
        if (xhr.readyState ==4 && xhr.status==200) {           
           var resp = JSON.parse(this.responseText);
           btnAddMedicine.innerHTML='Add Medicine'
           if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Drug has been added successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        btnAddMedicine.innerHTML='Add Medicine'
                        byId('formReset').reset();
                        byId('success').style.display='none';
                        $('#modalprimary').modal('hide')
                        direct('medicine')
                    }, 5000)
           }
           else {
                byId('alert').style.display='block';
                byId('alert').innerHTML='  No drug added try again';
                setTimeout(function(){
                    btnAddMedicine.innerHTML='Add Medicine'
                    byId('alert').style.display='none';
                }, 5000)
           }

        }
        else if (xhr.readyState !=1 && xhr.status!=200) {
            return 'Error 500';
        }
    }
    xhr.open('POST',base_ul+'pharmacy/addMedicine.php',true);
    xhr.send(fd);
}
function GetAllMedicines() {
    
     const myMedicine =   document.querySelector('#myMedicine');
        var xhr= new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                if (this.responseText!=null) {
                    var resp = JSON.parse(this.responseText);
                    var num = 0;
                    for (var i = 0; i < resp.length; i++){
                        num++;
                            var tr = document.createElement('tr');

                            var serialNum= document.createElement('td');
                            var imageurl= document.createElement('td');
                            var drug= document.createElement('td');
                            var quantity= document.createElement('td');
                            var usage= document.createElement('td');
                            var dupplier= document.createElement('td');
                            var category= document.createElement('td');
                            var expiry= document.createElement('td');
                            var catAction= document.createElement('td');




                            serialNum.setAttribute('class','text-center');

                            
                            serialNum.innerHTML=num;
                            imageurl.innerHTML          =`
                                <div class="bg-light d-inline-flex justify-content-center align-items-center align-top" 
                                style="width: 35px; height: 35px; border-radius: 3px;">
                                    <img src="../webservices/uploads/${resp[i].imageurl}" style="opacity: 0.8;" class="img-fluid"></div>

                            `
                            drug.innerHTML =resp[i].name;
                            quantity.innerHTML =resp[i].quantity;
                            usage.innerHTML =resp[i].usage;
                            dupplier.innerHTML =resp[i]. comapany_name;
                            category.innerHTML =resp[i].category_name;
                            expiry.innerHTML =resp[i].expiry_date;
                            catAction.innerHTML=`
                            <button class="btn btn-sm btn-success" type="button" onclick="$('#modalprimary').modal('show'),GetMedicineDetails(${resp[i].id})" ><i class="fa fa-cart-plus"></i> </button>
                            <button class="btn btn-sm btn-danger" type="button" onclick="DeleteMedicine(${resp[i].id})"><i class="fa fa-trash"></i> </button>
                            `;


                            tr.appendChild(serialNum);
                            tr.appendChild(imageurl);
                            tr.appendChild(drug);
                            tr.appendChild(quantity);
                            tr.appendChild(usage);
                            tr.appendChild(dupplier);
                            tr.appendChild(category);
                            tr.appendChild(expiry);
                            tr.appendChild(catAction);
                            myMedicine.appendChild(tr);

                      
                    }

                }
            }
            else if (xhr.readyState !=1 &&xhr.status!=200) {
                return 'Error 500';
            }
        }

        xhr.open('GET',base_ul+'pharmacy/getMyMedicines.php?id='+pharmacy.id,true);
        xhr.send();
}
function GetAllMediCategory() {
    var xhr= new XMLHttpRequest(); 
    xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200) {
            
            if (this.responseText!=null) {
                
                var resp = JSON.parse(this.responseText);
                
          //console.log(resp)
                for (var i = 0;i < resp.length; i++) {
                      var id = resp[i]['id'];
                      var name = resp[i]['category_name'];

                      $("#catID").append("<option value='"+id+"'>"+name+"</option>");

                   
                        
                }
            }           
        }

        else if (xhr.readyState !=1 && xhr.status!=200) {
            return 'Error 500';
        }
            
    }
     xhr.open('GET',base_ul+'pharmacy/getAllCategories.php',true);
     xhr.send();
}
function getMedSupplier() {
     var xhr= new XMLHttpRequest(); 
    xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200) {
            
            if (this.responseText!=null) {
                
                var resp = JSON.parse(this.responseText);
                
          //console.log(resp)
                for (var i = 0;i < resp.length; i++) {
                      var id = resp[i]['id'];
                      var name = resp[i]['comapany_name'];

                      $("#supplierId").append("<option value='"+id+"'>"+name+"</option>");

                   
                        
                }
            }           
        }

        else if (xhr.readyState !=1 && xhr.status!=200) {
            return 'Error 500';
        }
            
    }
     xhr.open('GET',base_ul+'pharmacy/getAllSuppliers.php',true);
     xhr.send();
}
function GetMedicineDetails(id) {
    var name                 =byId('name')
    var quantity             =byId('quantity')
    var usage                =byId('usage')
    var sideeffect           =byId('sideeffect')
    var precautions          =byId('precautions')
    var interation           =byId('interation')
    var overdose             =byId('overdose')
    var imageurl             =byId('imageurl')
    var supplierId           =byId('supplierId')
    var catID                =byId('catID')
    var mid                  =byId('mid')
    var caid                  =byId('caid')
    var supid                  =byId('supid')
    var expiry_date          =byId('expiry_date')
    var btnAddMedicine       =byId('btnAddMedicine')
    var btnUpdateMedicine    =byId('btnUpdateMedicine')
    var ctname               =byId('ctname')

     btnAddMedicine.style.display = 'none'
     btnUpdateMedicine.style.display = 'block'
     

     ctname.innerHTML     =""
     var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'pharmacy/getMedicineDetails.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                
                for (var i = 0; i < resp.length; i++){
                    ctname.innerHTML     ='Update '+ resp[i].name
                    mid.value               =resp[i].id 
                    name.value               =resp[i].name 
                    quantity.value            =resp[i].quantity 
                    usage.value            =resp[i].usage 
                    sideeffect.value            =resp[i].sideeffect 
                    precautions.value            =resp[i].precautions 
                    interation.value            =resp[i].interation 
                    overdose.value            =resp[i].overdose 
                    imageurl.src            ='../webservices/uploads/'+resp[i].imageurl 
                    supplierId.value            =resp[i].comapany_name 
                    catID.value                 =resp[i].category_name 

                    caid.value                   =resp[i].cid 
                    supid.value                  =resp[i].sid 
                    expiry_date.value            =resp[i].expiry_date 
                }
            }
        }
        xhr.send();
}
function UpdateMedicineDetails() {
    var name                 =byId('name').value
    var quantity             =byId('quantity').value
    var usage                =byId('usage').value
    var sideeffect           =byId('sideeffect').value
    var precautions          =byId('precautions').value
    var interation           =byId('interation').value
    var overdose             =byId('overdose').value
    var expiry_date             =byId('expiry_date').value
    var supplierId           =byId('supplierId').value
    var catID                =byId('catID').value
    var mid                  =byId('mid').value
    var caid                 =byId('caid').value
    var supid                =byId('supid').value

      var btnAddMedicine       =byId('btnAddMedicine')
     var btnUpdateMedicine     =byId('btnUpdateMedicine')


     var fd = new FormData;
          fd.append('id',mid);
          fd.append('name',name);
          fd.append('quantity',quantity);
          fd.append('usage',usage);
          fd.append('sideeffect',sideeffect);
          fd.append('precautions',precautions);
          fd.append('interation',interation);
          fd.append('overdose',overdose);
          fd.append('supplierId',supid);
          fd.append('catID',caid);
          fd.append('expiry_date',expiry_date);
          btnUpdateMedicine.innerHTML="Loading...."

          var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                // byId('formReset').reset();
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Medicine has been updated successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        btnAddMedicine.style.display = 'block'
                        btnUpdateMedicine.style.display = 'none'
                        byId('formReset').reset();
                        byId('success').style.display='none';
                        $('#modalprimary').modal('hide')
                        direct('medicine')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to add Medicine try again!!';
                    setTimeout(function(){
                        btnCategory.innerHTML="Add Medicine"
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("POST",base_ul+'pharmacy/updateMedicine.php',true);
          xhr.send(fd);
}
function DeleteMedicine(id) {
    var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Medicine has been deleted successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        byId('success').style.display='none';
                        direct('medicine')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to delete Medicine try again!!';
                    setTimeout(function(){
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("GET",base_ul+'pharmacy/deleteMedicine.php?id='+id,true);
          xhr.send();
}

// ================================= END ADD MEDICINE==========================================//
















// ================================= ADD CATEGORY==========================================//
function AddCategory() {
    var category_name   =byId('category_name').value
    var btnCategory   =byId('btnCategory')
     if (category_name=="")
     {
        byId('alert').style.display='block';
        byId('alert').innerHTML='Category name is required';
        byId('alert').class="btn btn-warning"
        byId('category_name').focus();
        setTimeout(function(){
            byId('alert').style.display="none";
        }, 5000);
     }
     else {
          var fd = new FormData;
          fd.append('category_name',category_name);
          btnCategory.innerHTML="Please wait...."

          var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                // byId('formReset').reset();
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Category has been added successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        btnCategory.innerHTML="Add Category"
                        byId('formReset').reset();
                        byId('success').style.display='none';
                        $('#modalprimary').modal('hide')
                        direct('category')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to add category try again!!';
                    setTimeout(function(){
                        btnCategory.innerHTML="Add Category"
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("POST",base_ul+'pharmacy/AddCategory.php',true);
          xhr.send(fd);
     }
}
function GetAllCategories() {
    const myCategory =   document.querySelector('#myCategory');
    var xhr= new XMLHttpRequest();
    xhr.open('GET',base_ul+'pharmacy/getAllCategories.php',true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState ==4 && xhr.status==200) {
            if (this.responseText!=null) {
                var resp = JSON.parse(this.responseText);
                var num = 0;
                for (var i = 0; i < resp.length; i++){
                    num++;
                        var tr = document.createElement('tr');

                        var serialNum= document.createElement('td');
                        var catname= document.createElement('td');
                        var catAction= document.createElement('td');



                        serialNum.setAttribute('class','text-center');
                        // catname.setAttribute('class','text-center');
                        catAction.setAttribute('class','text-center');

                        
                        serialNum.innerHTML=num;
                        catname.innerHTML=resp[i].category_name;
                        catAction.innerHTML=`
                        <button class="btn btn-sm btn-success" type="button" onclick="$('#modalprimary').modal('show'),GetCategoryDetails(${resp[i].id})" ><i class="fa fa-cart-plus"></i> Edit</button>
                        <button class="btn btn-sm btn-danger" type="button" onclick="DeletyCategory(${resp[i].id})"><i class="fa fa-trash"></i> Delete</button>
                        `;


                        tr.appendChild(serialNum);
                        tr.appendChild(catname);
                        tr.appendChild(catAction);
                        myCategory.appendChild(tr);

                  
                }

            }
        }
        else if (xhr.readyState !=1 &&xhr.status!=200) {
            return 'Error 500';
        }
    }
    xhr.send();
}
function GetCategoryDetails(id) {
     var category_name           =byId('category_name')
     var cid                     =byId('cid')
     var btnCategory             =byId('btnCategory')
     var btnUpdateCategory       =byId('btnUpdateCategory')
     var ctname                  =byId('ctname')

     btnCategory.style.display = 'none'
     btnUpdateCategory.style.display = 'block'
     

     ctname.innerHTML     =""
     var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'pharmacy/getCategoryDetail.php?id='+id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                var resp=JSON.parse(this.responseText);
                
                for (var i = 0; i < resp.length; i++){
                    ctname.innerHTML     ='Update '+ resp[i].category_name 
                    category_name.value  =resp[i].category_name 
                    cid.value            =resp[i].id  
                }
            }
        }
        xhr.send();
}
function UpdateCategoryDetails() {
    var category_name     =byId('category_name').value
    var btnCategory       =byId('btnCategory')
    var btnUpdateCategory =byId('btnUpdateCategory')
    var cid               =byId('cid').value


     var fd = new FormData;
          fd.append('id',cid);
          fd.append('category_name',category_name);
          btnUpdateCategory.innerHTML="Please wait...."

          var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                // byId('formReset').reset();
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Category has been updated successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        btnCategory.style.display = 'block'
                        btnUpdateCategory.style.display = 'none'
                        byId('formReset').reset();
                        byId('success').style.display='none';
                        $('#modalprimary').modal('hide')
                        direct('category')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to add category try again!!';
                    setTimeout(function(){
                        btnCategory.innerHTML="Add Category"
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("POST",base_ul+'pharmacy/updateCategory.php',true);
          xhr.send(fd);
}
function DeletyCategory(id) {
     

          var xhr= new XMLHttpRequest();
          xhr.onreadystatechange = function () {
            if (xhr.readyState ==4 && xhr.status==200) {
                var resp = JSON.parse(this.responseText);
                if (resp.response == true) {
                    byId('success').style.display='block';
                    byId('success').innerHTML='Category has been deleted successfully';
                    // GetAllCategories()
                    setTimeout(function(){
                        byId('success').style.display='none';
                        direct('category')
                    }, 5000)
                    
                }
                else {
                    byId('alert').style.display='block';
                    byId('alert').innerHTML='Error occured trying to delete category try again!!';
                    setTimeout(function(){
                        byId('alert').style.display='none';
                    }, 5000)
                }
            
            }
            else if (xhr.readyState !=1 && xhr.status!=200) {
                return 'Error 500';
            }
          }
          xhr.open("GET",base_ul+'pharmacy/deleteCategory.php?id='+id,true);
          xhr.send();
}

// ================================= END ADD CATEGORY==========================================//








/*========logout========*/

function Logout() {
      var xhr= new XMLHttpRequest();
        xhr.open('GET',base_ul+'pharmacy/logout.php?id='+pharmacy.id,true);
        xhr.onreadystatechange = function (){
            if (xhr.readyState ==4 && xhr.status==200){
                if (this.responseText =='error') {
                	localStorage.clear();
                    localStorage.removeItem("pharmacy");
                    sessionStorage.removeItem('email');
                    sessionStorage.removeItem('firstname');
                    sessionStorage.removeItem('lastname');
                    sessionStorage.removeItem('id');
                    sessionStorage.removeItem('phoneNumber');
                    direct("../login/login");
                }
                
            }
        }
         xhr.send();
}
/*========logout========*/










































































































/*=========================Boko's Libraries================================*/
function direct(address) {
    
    var windowlocation = window.location.href;
    var directory = windowlocation.substring(0,windowlocation.lastIndexOf("/") +1);
    window.location.href=directory+address+".php";
}

function byId(id) {
    return document.getElementById(id);
}

function addOptions(data,select,zeroOption) {
    byId(''+select+'').innerHTML ="";
    var zero = element('option');
    zero.innerHTML =zeroOption;
    byId(''+select+'').appendChild(zero);

        for (var i = 0; i < data.length; i++) {
        
            var option= element('option');
            Object.keys(data[i]).forEach(function(key,value) {

                if (key=="name") {
                    option.innerHTML=data[i][''+key+''];
                }
                else if (key=="id") {

                    option.setAttribute('id',data[i][''+key+''])
                }
            
            });
            byId(''+select+'').appendChild(option);
    }

}
function element(type) {

    var element = document.createElement(type);
    return element;
}
/*=========================Boko's Libraries================================*/