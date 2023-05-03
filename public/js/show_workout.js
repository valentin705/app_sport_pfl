const desc = document.querySelectorAll(".description");

desc.forEach((element) => {
  element.addEventListener("click", () => {
    element.classList.toggle("description-5");
  });
});
