/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var xmlHttp = false;
//Khoi tao xmlHttp
if (window.XMLHttpRequest) {
  xmlHttp = new XMLHttpRequest();
}

//Gửi bằng phương thức GET
function getData(dataSource, divID, keyword = "", pageno = 1) {
  if (xmlHttp) {
    var obj = document.getElementById(divID);
    var url = dataSource;
    url = url + "?keyword=" + keyword + "&pageno=" + pageno;
    xmlHttp.open("GET", url, true);
    //Đón dữ liệu từ server trả về
    xmlHttp.onreadystatechange = function () {
      //alert(xmlHttp.readyState);
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        obj.innerHTML = xmlHttp.responseText;
      }
    };
    xmlHttp.send(null);
  } else alert("loi");
}

//Gửi bằng phương thức POST
function postData(datasource, divID, data = {}) {
  if (xmlHttp) {
    var obj = document.getElementById(divID);
    var url = datasource;

    var param = "";

    for (const key in data) {
      if (data.hasOwnProperty(key)) {
        value = data[key];
        param = param + key + "=" + value + "&";
      }
    }

    console.log(param);

    //var param = "name=" + encodeURIComponent(user) + "&pass=" + encodeURIComponent(pass);
    xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );
    xmlHttp.send(param);

    xmlHttp.onreadystatechange = function () {
      if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        obj.innerHTML = xmlHttp.responseText;
      }
    };
  }
}
