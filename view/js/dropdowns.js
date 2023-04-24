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
  const dropbtn__account = dropdown.querySelector(".dropbtn__account");
  const user = dropdown.querySelector(".user");
  const menuButton = dropdown.querySelector(".menu-button");
  const dropbtnPath = dropdown.querySelector(".dropbtn > svg path");
  const userPath = dropdown.querySelector(".dropbtn__account > svg path");
  const menuHamburguerSpans = dropdown.querySelectorAll(
    ".menu-hamburguer > span"
  );

  if (dropdownContents) {
    dropdownContents.style.height = 0;
  }

  if (user) {
    user.style.height = 0;
    userPath.setAttribute("fill", "var(--branco)");
  }

  dropdown.addEventListener("mouseenter", () => {
    if (dropBtn) {
      dropBtn.style.backgroundColor = "var(--azul)";
      dropBtn.style.color = "var(--branco)";
      dropbtnPath.setAttribute("fill", "var(--branco)");
    }

    if (user) {
      user.classList.add("show-user");
      user.style.height = user.scrollHeight + "px";
    }

    if (dropdownContents) {
      menuButton.style.backgroundColor = "var(--azul)";
      dropBtn.style.backgroundColor = "";
      dropBtn.style.color = "var(--branco)";
      menuHamburguerSpans.forEach((menuHamburguerSpan) => {
        menuHamburguerSpan.style.backgroundColor = "var(--branco)";
      });
      dropdownContents.classList.add("show");
      dropdownContents.style.height = dropdownContents.scrollHeight + "px";
    }
  });

  dropdown.addEventListener("mouseleave", () => {
    if (dropBtn) {
      dropBtn.style.backgroundColor = "transparent";
      dropBtn.style.color = "var(--pretoPuro)";
      dropbtnPath.setAttribute("fill", "var(--preto80)");
    }
    if (user) {
      user.classList.remove("show-user");
      user.style.height = "0";
    }

    if (dropdownContents) {
      menuButton.style.backgroundColor = "transparent";
      dropBtn.style.backgroundColor = "transparent";
      dropBtn.style.color = "var(--pretoPuro)";
      menuHamburguerSpans.forEach((menuHamburguerSpan) => {
        menuHamburguerSpan.style.backgroundColor = "var(--pretoPuro)";
      });

      dropdownContents.classList.remove("show");
      dropdownContents.style.height = "0";
    }
  });
});

const url = "json/produtos.json";
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

const activeModalLogins = document.querySelectorAll('#active-modal-login');
const formCreate = document.querySelector('.form-container__create');
const formCongratulation = document.querySelector('.form-container__congratulations');

activeModalLogins.forEach((activeModalLogin) => {
  activeModalLogin.addEventListener('click', (e) => {
    
    if (menu.contains(e.target)) {
      menu.classList.remove("active");
    }

    menuScreen.classList.add('active');
    const loginModal = document.querySelector('.login-modal');
    const createAccount = document.querySelector('.create-account');
    loginModal.classList.add('active');
  
    menuScreen.addEventListener("click", function (event) {
      if (!loginModal.contains(event.target) && !createAccount.contains(event.target)) {
        menuScreen.classList.remove("active");
        loginModal.classList.remove("active");
        createAccount.classList.remove("active");
      }
    });
  
    const linkCreateAccount = document.querySelector('.login-account__link');
  
    linkCreateAccount.addEventListener('click', () => {
      loginModal.classList.remove('active');
      createAccount.classList.add('active');
      formCreate.style.display = 'block';
      formCongratulation.style.display = 'none';  
      
      const cadastrarUsuario = document.querySelector('#cadastrarUsuario');
      cadastrarUsuario.addEventListener('click', (e) => {
        e.preventDefault();
        formCreate.style.display = 'none';
        formCongratulation.style.display = 'flex';  
      });
    });  
  });
})
