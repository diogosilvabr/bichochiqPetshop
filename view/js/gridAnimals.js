const aboutAnimals = document.querySelectorAll(
  ".about-animal, .about-animal__mobile"
);

aboutAnimals.forEach((aboutAnimal) => {
  const imgAboutAnimals = aboutAnimal.querySelector(
    ".about-animal > img, .about-animal__mobile > img"
  );
  // const patasAnimal = aboutAnimal.querySelector('.efeito-marca__animal');

  aboutAnimal.addEventListener("mouseenter", () => {
    imgAboutAnimals.classList.remove("animacao-removeOpacidade");
    imgAboutAnimals.classList.add("animacao-opacidade");

    // Aguarda o fim da animação para remover o display
    imgAboutAnimals.addEventListener("transitionend", () => {
      setTimeout(() => {
        imgAboutAnimals.style.display = "none";
      }, 200);
    });

    aboutAnimal.style.background = "none";
    const animacaoDiagonalEsquerda = aboutAnimal.querySelectorAll(
      ".animacao-diagonal__esquerda"
    );
    const animacaoDiagonalDireita = aboutAnimal.querySelectorAll(
      ".animacao-diagonal__direita"
    );
    const animacaoVerticalDesce = aboutAnimal.querySelectorAll(
      ".animacao-vertical__desce"
    );
    const animacaoVerticalSobe = aboutAnimal.querySelectorAll(
      ".animacao-vertical__sobe"
    );

    animacaoDiagonalEsquerda.forEach((diagonalEsquerda) => {
      diagonalEsquerda.style.display = "flex";

      const pataSvg1 = diagonalEsquerda.querySelector(
        ".animacao-diagonal__esquerda svg:nth-child(1)"
      );
      pataSvg1.style.animation = "marca-animacao .4s ease forwards .2s";

      const pataSvg2 = diagonalEsquerda.querySelector(
        ".animacao-diagonal__esquerda svg:nth-child(2)"
      );
      pataSvg2.style.animation = "marca-animacao .4s ease-in-out forwards .4s";

      const pataSvg3 = diagonalEsquerda.querySelector(
        ".animacao-diagonal__esquerda svg:nth-child(3)"
      );
      pataSvg3.style.animation = "marca-animacao .4s ease-in-out forwards .8s";

      const pataSvg4 = diagonalEsquerda.querySelector(
        ".animacao-diagonal__esquerda svg:nth-child(4)"
      );
      pataSvg4.style.animation = "marca-animacao .4s ease-in-out forwards 1.2s";
    });

    animacaoDiagonalDireita.forEach((diagonalDireita) => {
      diagonalDireita.style.display = "flex";

      const pataSvg5 = diagonalDireita.querySelector(
        ".animacao-diagonal__direita svg:nth-child(1)"
      );
      pataSvg5.style.animation = "marca-animacao .4s ease forwards .2s";

      const pataSvg6 = diagonalDireita.querySelector(
        ".animacao-diagonal__direita svg:nth-child(2)"
      );
      pataSvg6.style.animation = "marca-animacao .4s ease-in-out forwards .4s";

      const pataSvg7 = diagonalDireita.querySelector(
        ".animacao-diagonal__direita svg:nth-child(3)"
      );
      pataSvg7.style.animation = "marca-animacao .4s ease-in-out forwards .8s";

      const pataSvg8 = diagonalDireita.querySelector(
        ".animacao-diagonal__direita svg:nth-child(4)"
      );
      pataSvg8.style.animation = "marca-animacao .4s ease-in-out forwards 1.2s";
    });

    // animação para descer
    animacaoVerticalDesce.forEach((verticalDesce) => {
      verticalDesce.style.display = "flex";

      const pataSvg9 = verticalDesce.querySelector(
        ".animacao-vertical__desce svg:nth-child(1)"
      );
      pataSvg9.style.animation = "marca-animacao .4s ease forwards .2s";

      const pataSvg10 = verticalDesce.querySelector(
        ".animacao-vertical__desce svg:nth-child(2)"
      );
      pataSvg10.style.animation = "marca-animacao .4s ease-in-out forwards .4s";

      const pataSvg11 = verticalDesce.querySelector(
        ".animacao-vertical__desce svg:nth-child(3)"
      );
      pataSvg11.style.animation = "marca-animacao .4s ease-in-out forwards .8s";

      const pataSvg12 = verticalDesce.querySelector(
        ".animacao-vertical__desce svg:nth-child(4)"
      );
      pataSvg12.style.animation =
        "marca-animacao .4s ease-in-out forwards 1.2s";
    });

    animacaoVerticalSobe.forEach((verticalSobe) => {
      verticalSobe.style.display = "flex";

      const pataSvg13 = verticalSobe.querySelector(
        ".animacao-vertical__sobe svg:nth-child(1)"
      );
      pataSvg13.style.animation = "marca-animacao .4s ease forwards .2s";

      const pataSvg14 = verticalSobe.querySelector(
        ".animacao-vertical__sobe svg:nth-child(2)"
      );
      pataSvg14.style.animation = "marca-animacao .4s ease forwards .4s";

      const pataSvg15 = verticalSobe.querySelector(
        ".animacao-vertical__sobe svg:nth-child(3)"
      );
      pataSvg15.style.animation = "marca-animacao .4s ease forwards .8s";

      const pataSvg16 = verticalSobe.querySelector(
        ".animacao-vertical__sobe svg:nth-child(4)"
      );
      pataSvg16.style.animation = "marca-animacao .4s ease forwards 1.2s";
    });

    const titleAnimals = aboutAnimal.querySelectorAll(".title-animal");

    titleAnimals.forEach((titleAnimal) => {
      timeoutLink = setTimeout(() => {
        titleAnimal.style.display = "flex";
        // titleAnimal.classList.add('.title-animal.active');
      }, 1500);
    });
  });

  aboutAnimal.addEventListener("mouseleave", () => {
    imgAboutAnimals.classList.remove("animacao-opacidade");
    imgAboutAnimals.classList.add("animacao-removeOpacidade");
    // Aguarda o fim da animação para exibir a imagem novamente
    imgAboutAnimals.addEventListener("transitionend", () => {
      imgAboutAnimals.style.display = "block";
    });

    aboutAnimal.style.background = "";

    const animacaoDiagonalEsquerda = aboutAnimal.querySelectorAll(
      ".animacao-diagonal__esquerda"
    );
    const animacaoDiagonalDireita = aboutAnimal.querySelectorAll(
      ".animacao-diagonal__direita"
    );
    const animacaoVerticalDesce = aboutAnimal.querySelectorAll(
      ".animacao-vertical__desce"
    );
    const animacaoVerticalSobe = aboutAnimal.querySelectorAll(
      ".animacao-vertical__sobe"
    );

    animacaoDiagonalEsquerda.forEach((diagonalEsquerda) => {
      diagonalEsquerda.style.display = "none";
    });

    animacaoDiagonalDireita.forEach((diagonalDireita) => {
      diagonalDireita.style.display = "none";
    });

    // animação para descer
    animacaoVerticalDesce.forEach((verticalDesce) => {
      verticalDesce.style.display = "none";
    });

    animacaoVerticalSobe.forEach((verticalSobe) => {
      verticalSobe.style.display = "none";
    });

    const titleAnimals = aboutAnimal.querySelectorAll(".title-animal");

    titleAnimals.forEach((titleAnimal) => {
      clearTimeout(timeoutLink);
      titleAnimal.style.display = "none";
    });
  });
});


// grid animals mobile
const owlCarousel = document.querySelector(".owl-carousel");
const owlCards = Array.from(owlCarousel.querySelectorAll(".owl-card"));

const totalCards = owlCards.length;
const visibleCards = 3;
const centerIndex = Math.floor(visibleCards / 2);

const setSelected = (cardIndex) => {
  owlCards.forEach((card) => {
    card.classList.remove("selected");
    card.style.opacity = 0.3;
  });

  owlCards[cardIndex].classList.add("selected");
  owlCards[cardIndex].style.opacity = 1;
};

const updateCarousel = (cardIndex) => {
  const start = cardIndex - centerIndex;
  const end = cardIndex + centerIndex;

  owlCards.forEach((card, index) => {
    if (index >= start && index <= end) {
      card.style.display = "block";
      card.style.order = index - cardIndex + centerIndex;
    } else {
      card.style.display = "none";
    }
  });
};

const rotateCarousel = (direction) => {
  const selectedCardIndex = owlCards.findIndex((card) =>
    card.classList.contains("selected")
  );

  const newSelectedCardIndex =
    direction === "right"
      ? selectedCardIndex === totalCards - 1
        ? 0
        : selectedCardIndex + 1
      : selectedCardIndex === 0
      ? totalCards - 1
      : selectedCardIndex - 1;

  setSelected(newSelectedCardIndex);
  updateCarousel(newSelectedCardIndex);
};

owlCarousel.addEventListener("click", (event) => {
  if (event.target.classList.contains("selected")) {
    return; // não faz nada se o elemento clicado já está selecionado
  } else if (event.target.classList.contains("owl-card")) {
    const selectedCardIndex = owlCards.findIndex((card) =>
      card.classList.contains("selected")
    );
    const newSelectedCardIndex = owlCards.indexOf(event.target);

    if (newSelectedCardIndex === centerIndex) {
      return; // não faz nada se o elemento clicado é o elemento central
    } else if (newSelectedCardIndex > selectedCardIndex) {
      rotateCarousel("right");
    } else {
      rotateCarousel("left");
    }
  } else {
    const selectedCardIndex = owlCards.findIndex((card) =>
      card.classList.contains("selected")
    );

    if (event.clientX < window.innerWidth / 2) {
      rotateCarousel("left");
    } else {
      rotateCarousel("right");
    }
  }
});

setSelected(centerIndex);
updateCarousel(centerIndex);









  






