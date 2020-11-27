window.onload=function(){
   
    document.getElementById('flname').innerHTML=sessionStorage.getItem('firstname')+" "+sessionStorage.getItem('lastname');
    document.getElementById('speciality').innerHTML=sessionStorage.getItem('speciality');
}
   

