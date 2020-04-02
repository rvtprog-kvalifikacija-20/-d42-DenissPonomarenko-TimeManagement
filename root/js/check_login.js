function validateForm() {
    var x = document.forms["loginForm"]["u_login"].value;
    if (x == "") {
        alert("Необходимо ввести имя");
        return false;
    }
} 