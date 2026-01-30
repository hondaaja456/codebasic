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









// this code is used if you re planning to redirect to php and needed security 
// document.getElementById("loginForm").addEventListener("submit", function (e) {
//   e.preventDefault();

//   const formData = new FormData(this);

//   fetch("login.php", {
//     method: "POST",
//     body: formData
//   })
//   .then(res => res.text())
//   .then(data => {
//     if (data === "success") {
//       window.location.href = "dashboard.php";
//     } else {
//       document.getElementById("msg").innerText = "Invalid login";
//     }
//   });
// });
