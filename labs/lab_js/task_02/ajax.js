function send(){
  const url = "./ajax-handler.php";
	
  var callback = function (text) {
  console.log(text);
  };

  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let confirmPassword = document.getElementById("confirmPassword").value;

  let object = { username, password, confirmPassword };

  let jsonObject = JSON.stringify(object);
	
  ajax(url, { success: callback, 
              data: jsonObject });			  
}
function ajax(url, settings){
    var xhr = new XMLHttpRequest();
    xhr.onload = function(){
      if (xhr.status == 200) {
        settings.success(xhr.response);
      } else {
        console.error(xhr.response);
      }
    };
     
    xhr.open("POST", url);
    xhr.setRequestHeader("Content-Type", "application/json;");
    xhr.send(settings.data);
  }