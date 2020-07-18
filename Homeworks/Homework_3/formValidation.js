window.onload = function () {
  document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault();
  });
};

function isFormValid() {
  let areFieldsValid =
    isUsernameValid() &&
    areNamesValid() &&
    isEmailValid() &&
    isPasswordValid() &&
    isZipCodeValid();

  if (areFieldsValid) {
    let username = document.getElementById("username").value;
    registerUser(username);
    return true;
  }
  return false;
}

function isUsernameValid() {
  if (!document.getElementById("username").value.match(/^\w{3,10}$/)) {
    document.getElementById("usernameError").innerHTML =
      "Please, enter username with length between 3 and 10 symbols!";
    return false;
  }
  document.getElementById("usernameError").innerHTML = "";
  return true;
}

function areNamesValid() {
  let names = document.getElementById("names").value;
  if (!names.match(/^[A-Z][a-z]+ [A-Z][a-z]+$/) || names.lenght > 50) {
    document.getElementById("namesError").innerHTML =
      "Please, enter correct first and last name with max length 50 symbols!";
    return false;
  }
  document.getElementById("namesError").innerHTML = "";
  return true;
}

function isEmailValid() {
  if (!document.getElementById("email").value.match(/[^@]+@[^\.]+\..+/)) {
    document.getElementById("emailError").innerHTML =
      "Please, enter valid email!";
    return false;
  }
  document.getElementById("emailError").innerHTML = "";
  return true;
}

function isPasswordValid() {
  if (
    !document
      .getElementById("password")
      .value.match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,10}$/)
  ) {
    document.getElementById("passwordError").innerHTML =
      "Please, enter password with length between 6 and 10 symbols. It should contain letters and numbers!";
    return false;
  }
  document.getElementById("passwordError").innerHTML = "";
  return true;
}

function isZipCodeValid() {
  let zipCode = document.getElementById("zip_code").value;
  if (!zipCode.match(/^\d{5}-\d{4}$/) && zipCode != "") {
    document.getElementById("zipCodeError").innerHTML =
      "The zip code is invalid! It should be in the format 11111-1111";
    return false;
  }
  document.getElementById("zipCodeError").innerHTML = "";
  return true;
}

function registerUser(username) {
  setTimeout(() => 4000);
  fetch("https://jsonplaceholder.typicode.com/users", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((users) => {
      if (isExistingUser(username, users)) {
        document.getElementById("registrationMessage").innerHTML =
          "The username is already existing!";
      } else {
        document.getElementById("registrationMessage").innerHTML =
          "Successful registration!";
      }
    });
}

function isExistingUser(username, users) {
  for (const user of users) {
    if (user.username === username) {
      return true;
    }
  }
  return false;
}
