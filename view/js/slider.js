// Selecionando os elementos da página
const sliderContainer = document.querySelector(".slider-container");
const sliderContent = document.querySelector(".slider-content");
const prevButton = document.querySelector(".prev-button");
const nextButton = document.querySelector(".next-button");
const productCards = document.querySelectorAll(".product-card");
const spacing = 10;
const cardWidth = 212;
let currentPosition = 0;

function slide(direction) {
  const containerWidth = sliderContainer.clientWidth;
  const contentWidth = sliderContent.clientWidth;
  const maxPosition = Math.ceil(
    (contentWidth - containerWidth) / (cardWidth + spacing)
  );
  currentPosition = currentPosition + direction;
  if (currentPosition < 0) {
    currentPosition = maxPosition;
  } else if (currentPosition > maxPosition) {
    currentPosition = 0;
  }
  sliderContent.style.transform = `translateX(-${
    currentPosition * (cardWidth + spacing)
  }px)`;
}

prevButton.addEventListener("click", () => slide(-1));
nextButton.addEventListener("click", () => slide(1));