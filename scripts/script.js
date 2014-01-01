function handleResponse(data, status){
	if (interval) {
      clearInterval(interval);
    }
	if(status == "success"){
		console.log(data);
		var result = $.parseJSON(data);
		$("#sqlQuery").html(result.sqlQuery);
		//console.log(data);
		if(result.state == 1){
			$("#queryResult").html(result.message);
			return;
		}
		if($(result.queryRes).length > 0){
			var table = "<table border=\"1\">";
			table += "<tr>";
			//Print Column titles
			$.each(result.queryRes[0], function(key, value){
				table += "<td>"+key+"</td>";
			});
			table += "</tr>";

			//Print all rows
			$.each(result.queryRes, function(){
				table += "<tr>";
				$.each(this, function(key, val){
					table += "<td>"+val+"</td>";
				});
				table += "</tr>";
			});
			table += "</table>";
			$("#queryResult").html(table);
		}else{
			$("#queryResult").html("<p>"+result.queryRes+"</p>");
		}
	} else {
		alert("Data: " + data + "\nStatus: " + status);
	}
}