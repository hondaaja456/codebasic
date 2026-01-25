// Utility function for making fetch requests
function fetchData(url, method, data) {
  return fetch(url, {
    method: method,
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: data
  })
  .then(response => response.text());
}

// Example usage
fetchData("login.php", "POST", `username=${username}&password=${password}`)
  .then(data => {
    if (data === "ok") {
      window.location.href = "dashboard.php";
    } else {
      alert("Login failed");
    }
  });
