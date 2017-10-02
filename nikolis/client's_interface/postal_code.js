/*function postal_code_search(str){
	var xhttp;
	if ( str = "" ){
		document.getElementById("").innerHTML = "";
		return;
	}

	xhttp = new XMLHttpRequest;
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	document.getElementById("").innerHTML = this.responseText;    
    	}
 	};

}*/

$(document).ready(function(){

   $("#tk").autocomplete({
   	source: function(request, response){
   		$.ajax({
   			url: "hint_tk.php",
   			dataType: "json",
   			data: {
   				q: request.term
   			},
   			success: function(data){
   				response(data);
   			}

   		});
   	},
   });

   $("#town").autocomplete({
   	source: function(request, response){
   		$.ajax({
   			url: "hint_tow.nphp",
   			dataType: "json",
            contentType: "application/json; charset=utf-8",   			
   			data: {
   				q: request.term
   			},
   			success: function(data){
   				response(data);
   			}
   		});
   	},
   });

   $("postal_code_search").p_c_search({
   	source: function(request, response){
   		$.ajax({
   			type: "POST"
   			url: "p_c_search.php",
   			contentType: "application/json; charset=utf-8",
   			dataType: "json",
   			data: {
   				q: request term
   			},
   			success: function(data){
   				alert('added');
   			}
   		})   		
   		$.getJSON("p_c_search.php", successFunct(received_data)){
   			var items[];

   		}
   	}
   })

   $(#town_search).t_search({
   	source: function(request, response){
   		$.ajax({
   			type: "POST"
   			url: "p_c_search.php",
   			contentType: "application/json; charset=utf-8",
   			dataType: "json",
   			data: {
   				q: request term
   			},
   			success: function(data){
   				alert('added');
   			}
   		})
   	} 
   })

}); 