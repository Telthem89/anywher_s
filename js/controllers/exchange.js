var base_url ='https://api.exchangeratesapi.io/';
var mi_base_url ='https://v6.exchangerate-api.com/v6/97e721a032521475128310a6/latest/USD';

function loadAllExchange() {
	var xhr= new XMLHttpRequest();
    var rateChange = document.getElementById('rateChange')
    xhr.onreadystatechange = function (){
        if (xhr.readyState ==4 && xhr.status==200){
        	var resp = JSON.parse(this.responseText)
        		// for (var i = 0; i < resp.length; i++){
        			console.log(resp)
        			var rates_data = resp['rates'];


        			var num = 10001
        			for (rates_ in rates_data) {

        				console.log(rates_[0])
        				num++;
        				 var tr = document.createElement('tr');

                        var ref= document.createElement('td');
                        var currency= document.createElement('td');
                        var amount= document.createElement('td');

                       


                        ref.innerHTML=num;
                        currency.innerHTML=rates_;
                        amount.innerHTML=rates_;
                        
                        tr.appendChild(ref);
                        tr.appendChild(currency);
                        tr.appendChild(amount);
                        rateChange.appendChild(tr);
        			}
        	
        		
        		// document.write(respondata)
        	
            
            
        }
    }
    xhr.open('GET',base_url+'latest',true);
     xhr.send();
}