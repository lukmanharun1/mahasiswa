// cek lewat local storage
const mode = localStorage.getItem("mode");

const tombolLightDark = document.getElementById("lightDark");
const labelLightDark = tombolLightDark.previousElementSibling;

if (mode === "dark") {
  tombolLightDark.setAttribute("checked", "");
  labelLightDark.innerHTML = "Dark Mode";
  document.body.dataset.mode = "dark";
}

tombolLightDark.addEventListener("click", function (e) {
  if (tombolLightDark.getAttribute("checked") === "") {
    // ubah menjadi light mode
    localStorage.setItem("mode", "light");
    labelLightDark.innerHTML = "Light Mode";
    document.body.dataset.mode = "light";
    tombolLightDark.removeAttribute("checked");
  } else {
    // ubah menjadu dark mode
    localStorage.setItem("mode", "dark");
    labelLightDark.innerHTML = "Dark Mode";
    document.body.dataset.mode = "dark";
    tombolLightDark.setAttribute("checked", "");
  }
});
