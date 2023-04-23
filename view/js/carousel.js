// carrossel slider
const slides = document.querySelectorAll(".slide");
let indiceSlideAtual = 0;
const intervalo = 5000;

function proximoSlide() {
  slides[indiceSlideAtual].classList.remove("active");
  indiceSlideAtual++;
  if (indiceSlideAtual === slides.length) {
    indiceSlideAtual = 0;
  }
  slides[indiceSlideAtual].classList.add("active");
}

setInterval(proximoSlide, intervalo);