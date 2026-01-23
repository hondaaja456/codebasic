document.querySelectorAll(".toggle").forEach(button => {
  button.addEventListener("click", () => {
    const paragraph = button.previousElementSibling;
    paragraph.classList.toggle("hidden");
  });
});
