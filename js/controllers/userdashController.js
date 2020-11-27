window.onload=function(){
   
    document.getElementById('flname').innerHTML=sessionStorage.getItem('firstname') +' '+sessionStorage.getItem('lastname');
}