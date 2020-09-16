function validateForm() {
  var x = document.forms["plancreategv"]["id"].value;
  if (x == "2") {
    alert("Bạn không có quyền thêm kế hoạch đối với loại đồ án này");
    return false;
  }
  else {
  	alert("Thêm thành công");
  	return true;
  }
}

function validateFile() {
	var x = document.forms["file"]["id"].value;
	if (x == "1" || x == "2") {
		alert("Thêm thành công");
		return true;
	}
}

// function changeDatetimeFormat() {
// 	var dt = new Date();
// 	document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ 
// 								(("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" " 
// 								+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
// }

function date_time(id)
{
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
 //   months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
    d = date.getDate();
    day = date.getDay();
    days = new Array('CN', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7');
    h = date.getHours();
    if(h<10)
    {
            h = "0"+h;
    }
    m = date.getMinutes();
    if(m<10)
    {
            m = "0"+m;
    }
    s = date.getSeconds();
    if(s<10)
    {
            s = "0"+s;
    }
    result = ''+days[day]+' '+d+'-'+(month+1)+'-'+year+' '+h+':'+m+':'+s;
    document.getElementById(id).innerHTML = result;
    setTimeout('date_time("'+id+'");','1000');
    return true;
}

