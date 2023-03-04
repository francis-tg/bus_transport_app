/* class sendRequest {
  constructor() {}

  get(url, params) {
    fetch(url, {
      method: "GET",
        body: params,
    }).then((response) => {
      new Promise((resolve, reject) => {
        resolve(response);
      });
    });
  }
  post(url, params) {
    fetch(url, {
      method: "POST",
      body: params
    }).then((response) => {
      new Promise((resolve, reject) => {
        resolve(response);
      });
    });
  } 
}*/

function sendRequest(method, url, data, callback) {
  // create an XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // specify the callback function to be executed when the request completes
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      callback(xhr.responseText);
    }
  };

  // open the request and send it
  /* xhr.open(method, url, true);
  xhr.send(data); */
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send(encodeURIComponent(data));
}

/* document.querySelector("#addUser").addEventListener("submit", (e) => {
  e.preventDefault();
  let formData = `nom=${
    document.querySelector("#addUser #nom").value
  }&prenom= ${document.querySelector("#addUser #prenom").value}&phone= ${
    document.querySelector("#addUser #phone").value
  }&id_role= ${document.querySelector("#addUser #role").value}&password= ${
    document.querySelector("#addUser #password").value
  }`;

  sendRequest("POST", e.target.action, formData, (data) => {
    console.log(data);
  });
}); */
