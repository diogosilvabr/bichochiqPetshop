const searchInput = document.querySelector(".search-input input");
const searchButton = document.querySelector(".search-input button");

// searchButton.addEventListener("click", () => {
//   const searchValue = searchInput.value;
//   window.location.href = "https://www.google.com/search?q=" + searchValue;
// });

const dropdowns = document.querySelectorAll(".dropdown");
dropdowns.forEach((dropdown) => {
  const dropdownContents = dropdown.querySelector(".dropdown-content");
  const dropBtn = dropdown.querySelector(".dropbtn");
  const menuButton = dropdown.querySelector(".menu-button");
  const dropbtnPath = dropdown.querySelector(".dropbtn > svg path");
  const menuHamburguerSpans = dropdown.querySelectorAll(".menu-hamburguer > span");

  if (dropdownContents) {
    dropdownContents.style.height = 0;
  }

  dropdown.addEventListener("mouseenter", () => {
    dropbtnPath.setAttribute("fill", "var(--branco)");

    if (dropdownContents) {
      menuButton.style.backgroundColor = "var(--azul)";
      dropBtn.style.backgroundColor = "";
      dropBtn.style.color = "var(--branco)";
      menuHamburguerSpans.forEach((menuHamburguerSpan) => {
        menuHamburguerSpan.style.backgroundColor = "var(--branco)";
      });
      dropdownContents.classList.add("show");
      dropdownContents.style.height = dropdownContents.scrollHeight + "px";
    } else {
      dropBtn.style.backgroundColor = "var(--azul)";
      dropBtn.style.color = "var(--branco)";
    }
  });

  dropdown.addEventListener("mouseleave", () => {
    dropbtnPath.setAttribute("fill", "var(--preto80)");

    if (dropdownContents) {
      menuButton.style.backgroundColor = "transparent";
      dropBtn.style.backgroundColor = "transparent";
      dropBtn.style.color = "var(--pretoPuro)";
      menuHamburguerSpans.forEach((menuHamburguerSpan) => {
        menuHamburguerSpan.style.backgroundColor = "var(--pretoPuro)";
      });

      dropdownContents.classList.remove("show");
      dropdownContents.style.height = "0";
    } else {
      dropBtn.style.backgroundColor = "transparent";
      dropBtn.style.color = "var(--pretoPuro)";
    }
  });
});

const url = "../json/produtos.json";
const letras = document.querySelectorAll(".letra");
const listaProdutos = document.getElementById("lista-produtos");

function selecionarLetraA() {
  const letraA = document.querySelector('[data-letra="A"]');
  letraA.dispatchEvent(new MouseEvent("mouseenter"));
}

letras.forEach((letra) => {
  letra.addEventListener("mouseenter", () => {
    const letraSelecionada = letra.getAttribute("data-letra");

    letras.forEach((outraLetra) => {
      if (outraLetra.getAttribute("data-letra") !== letraSelecionada) {
        removerCorAzul(outraLetra);
      }
    });

    letra.style.color = "var(--azul)";
    fetch(url)
      .then((response) => response.json())
      .then((produtosJSON) => {
        const produtos = produtosJSON[letraSelecionada] || [];
        if (produtos.length > 0) {
          listaProdutos.innerHTML = "";
          produtos.forEach((produto) => {
            const li = document.createElement("li");
            li.textContent = produto.nome;
            listaProdutos.appendChild(li);
          });
        } else {
          const li = document.createElement("li");
          li.textContent = "Desculpe, não temos produtos com esta inicial";
          listaProdutos.innerHTML = "";
          listaProdutos.appendChild(li);
        }
      })
      .catch((error) => console.error(error));
  });
});

selecionarLetraA();

function atualizarProdutos(letraSelecionada) {
  const listaProdutos = document.querySelector("#lista-produtos");

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      const produtosFiltrados = data[letraSelecionada];

      listaProdutos.innerHTML = "";

      produtosFiltrados.forEach((produto) => {
        const itemLista = document.createElement("li");
        itemLista.textContent = produto.name;
        listaProdutos.appendChild(itemLista);
      });
    })
    .catch((error) => console.error(error));
}

function removerCorAzul(letra) {
  letra.style.color = "var(--pretoPuro)";
}

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


// Selecionando os elementos da página
const sliderContainer = document.querySelector('.slider-container');
const sliderContent = document.querySelector('.slider-content');
const prevButton = document.querySelector('.prev-button');
const nextButton = document.querySelector('.next-button');
const productCard = document.querySelectorAll('.product-card');
const cardWidth = 212;
const minTranslate = 0;
let maxTranslate = (productCard.length - 5) * cardWidth;
let currentPosition = 0;

function showPrev() {
  currentPosition -= cardWidth;
  if (currentPosition < minTranslate) {
    currentPosition = minTranslate;
  }
  sliderContent.style.transform = `translateX(${-currentPosition}px)`;
}

function showNext() {
  currentPosition += cardWidth;
  if (currentPosition > maxTranslate) {
    currentPosition = maxTranslate;
  }
  sliderContent.style.transform = `translateX(${-currentPosition}px)`;
}

prevButton.addEventListener('click', showPrev);
nextButton.addEventListener('click', showNext);




// carrossel de marcas
const container = document.querySelector('.food-animals__container');
let isDown = false;
let startX;
let scrollLeft;

container.addEventListener('mousedown', (e) => {
  isDown = true;
  container.classList.add('active');
  startX = e.pageX - container.offsetLeft;
  scrollLeft = container.scrollLeft;
});

container.addEventListener('mouseleave', () => {
  isDown = false;
  container.classList.remove('active');
});

container.addEventListener('mouseup', () => {
  isDown = false;
  container.classList.remove('active');
});

container.addEventListener('mousemove', (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - container.offsetLeft;
  const walk = (x - startX) * 1.5;
  container.scrollLeft = scrollLeft - walk;
});