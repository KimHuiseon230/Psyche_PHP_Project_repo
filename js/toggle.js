document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.querySelector("#menuToggle")
  const menu = document.querySelector("#menu")
  const checkbox = document.querySelector("#checkbox")

  menuToggle.addEventListener("click", () => {
    if (menu.style.display == "none") {
      menu.style.display = "block";
    } else {
      menu.style.display = "none";
    }
  })
})