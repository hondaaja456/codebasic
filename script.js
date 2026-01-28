document.getElementById("loginBtn").onclick = function () {
  document.getElementById("loginModal").style.display = "block";
};


function closeModal() {
  document.getElementById("loginModal").style.display = "none";
}


document.getElementById("submitLogin").onclick = function () {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  fetch("login.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `username=${username}&password=${password}`
  })
  .then(res => res.text())
  .then(data => {
    if (data === "success") {
      window.location.href = "dashboard.php";
    } else {
      document.getElementById("errorMsg").innerText = "Wrong login!";
    }
  });
};
