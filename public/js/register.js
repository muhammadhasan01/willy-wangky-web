var http = new XMLHttpRequest()
http.onreadystatechange = function() {
    if (this.readyState === 4) {
        if (this.responseText === "ok") {
            document.getElementById("register-form").submit()
        } else {
            document.getElementById("fail-upload").innerText = "Username / Email already registered."
        }
    }
}
document.getElementById("register-button").addEventListener("click", () => {
    var username = document.getElementById("username").value
    var email = document.getElementById("email").value
    var password = document.getElementById("password").value
    var confirm_password = document.getElementById("confirm-password").value
    if (username && email && password && confirm_password) {
        if (password !== confirm_password) {
            document.getElementById("fail-upload").innerText = "Your password does not match your confirmation password."
        } else {
            document.getElementById("fail-upload").innerText = ""
            http.open("GET", `register-api.php?email=${email}&username=${username}`, true)
            http.send()
        }
    } else {
        document.getElementById("fail-upload").innerText = "Please fill all your form."
    }
})
