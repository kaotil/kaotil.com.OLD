  var requestAjax = function(endpoint, data, callback) {
    var xhr = new XMLHttpRequest();  
    xhr.onreadystatechange = function(){
      if (this.readyState==4 && this.status==200) {
        callback(this.response);
      }
    };
    xhr.open('GET',endpoint,true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    //xhr.send(JSON.stringify(data));
    xhr.send();
  };
