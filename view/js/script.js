const cards = document.querySelectorAll(".card");

// passeia por dentro de todos os elementos de todos os cards
cards.forEach((card) => {
  const infoCard = card.querySelector(".info-card");
  const sobreCard = card.querySelector(".sobre-card");
  const infoCarrinho = card.querySelector("#infoCarrinho");
  const imgProduto = card.querySelector(".img-produto");

  // ao passar o mouse por cima, execute essas funções;
  card.addEventListener("mouseenter", () => {
    infoCarrinho.classList.remove("animacao-opacidade");
    sobreCard.classList.remove("efeito-desce-info");
    imgProduto.classList.remove("animacao-removeOpacidade");
    infoCard.classList.remove("animacao-removeOpacidade");

    infoCard.classList.add("animacao-opacidade");
    imgProduto.classList.add("animacao-opacidade");
    infoCarrinho.classList.add("animacao-removeOpacidade");
    sobreCard.classList.add("efeito-sobe-info");

    setTimeout(() => {
      infoCard.style.display = "none";
      infoCarrinho.style.display = "block";
    }, 20);
  });

  // ao tirar o mouse de cima, execute essas funções;
  card.addEventListener("mouseleave", () => {
    infoCard.classList.remove("animacao-opacidade");
    imgProduto.classList.remove("animacao-opacidade");

    infoCarrinho.classList.add("animacao-opacidade");
    infoCarrinho.classList.remove("animacao-removeOpacidade");
    infoCard.classList.add("animacao-removeOpacidade");
    imgProduto.classList.add("animacao-removeOpacidade");

    sobreCard.classList.remove("efeito-sobe-info");
    sobreCard.classList.add("efeito-desce-info");

    setTimeout(() => {
      infoCard.style.display = "block";
      infoCarrinho.style.display = "none";
    }, 100);
  });

  // variaveis do botão que encaminha para o carrinho e seus dados.
  const botaoCarrinho = card.querySelector("#addCarrinho");
  const nomeProduto = card.querySelector(".sobre-produto").textContent;
  const precoParcelas = card.querySelector(".parcelas").textContent;
  const precoAvista = card.querySelector(".preco-avista");
  const addProduto = card.querySelector(".adicionar-produto");

  botaoCarrinho.addEventListener("click", () => {
    addProduto.classList.add("animacao-removeOpacidade");
    addProduto.style.display = "block";
    card.querySelector('input[name="tamanho"]').checked = true;
  });

  // para remover a telinha de selecionar o que deseja do produto e colocar no carrinho
  addProduto.addEventListener("mouseleave", () => {
    addProduto.classList.remove("animacao-opacidade");
    addProduto.classList.add("animacao-removeOpacidade");
    addProduto.style.display = "none";
  });

  // ao clicar no botao de confirmar compra - retorna os dados no console.log
  const confirmarCompra = card.querySelector(".confirmar-compra");
  let subtotal = 0;

  confirmarCompra.addEventListener("click", () => {
    const tamanhoSelecionado = card.querySelector('input[name="tamanho"]:checked');
    const quantidadeSelecionada = card.querySelector(".input-quantity").value;
    const imageProduto = card.querySelector(".img-produto").getAttribute("src");
    const precoAvistaConvert = parseFloat(precoAvista.textContent.replace(/[^\d.,]/g, '').replace(',', '.'));
    const precoFormatado = precoAvistaConvert.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

    if (tamanhoSelecionado) {
      const selectedProducts = document.querySelector(".selected-products");
      selectedProducts.style.display = "flex";
      const totalPrice = quantidadeSelecionada * precoAvistaConvert;

      // mostrar dentro do carrinho a lista com infos do produto clicado
      const selectedProductsInfo = document.querySelector(".selected-products__infos");
      selectedProductsInfo.innerHTML += `
        <div class="product-info">
          <div class="product-info__img">
            <img src='${imageProduto}'>
          </div>

          <div class="product-info__about">
              <div class="product__nome-code">
                  <span class="product-name">${nomeProduto}</span>
                  <span class="product-code">Code: 1</span>
              </div>
              <div class="product-price">
                  <div class="price">${quantidadeSelecionada} x R$${precoFormatado} = <span id="priceSubtotal">R$${(totalPrice).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</span></div>
                  <button class="remove-product">
                      <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M11.5 0C5.152 0 0 5.152 0 11.5C0 17.848 5.152 23 11.5 23C17.848 23 23 17.848 23 11.5C23 5.152 17.848 0 11.5 0ZM16.1 12.65H6.9C6.2675 12.65 5.75 12.1325 5.75 11.5C5.75 10.8675 6.2675 10.35 6.9 10.35H16.1C16.7325 10.35 17.25 10.8675 17.25 11.5C17.25 12.1325 16.7325 12.65 16.1 12.65Z" fill="white"/>
                      </svg>
                  </button>
              </div>
          </div>
        </div>
      `;

      const selectedProcutsSubtotal = document.querySelector('.selected-products__subtotal');
      const priceSubtotal = document.querySelectorAll('#priceSubtotal');

      priceSubtotal.forEach((price) => {
        let priceValue = parseFloat(price.textContent.replace(/[^\d.,]/g, '').replace(',', '.'));
        subtotal += priceValue;
      });

      selectedProcutsSubtotal.innerHTML = `
        <div class="subtotal-price">Subtotal: <span>R$${subtotal.toFixed(2)}</span></div>
        <button class="subtotal-price__finalize">
            <svg width="43" height="40" viewBox="0 0 43 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.2203 36.2963C18.2203 37.0288 18.0065 37.7449 17.6061 38.354C17.2057 38.963 16.6366 39.4377 15.9707 39.7181C15.3049 39.9984 14.5722 40.0717 13.8653 39.9288C13.1584 39.7859 12.5091 39.4332 11.9995 38.9152C11.4898 38.3972 11.1428 37.7373 11.0022 37.0189C10.8616 36.3004 10.9337 35.5557 11.2095 34.879C11.4854 34.2022 11.9524 33.6237 12.5517 33.2168C13.1509 32.8098 13.8555 32.5926 14.5762 32.5926C15.5427 32.5926 16.4696 32.9828 17.1529 33.6774C17.8363 34.372 18.2203 35.314 18.2203 36.2963ZM33.5253 32.5926C32.8046 32.5926 32.1 32.8098 31.5008 33.2168C30.9015 33.6237 30.4344 34.2022 30.1586 34.879C29.8828 35.5557 29.8106 36.3004 29.9513 37.0189C30.0919 37.7373 30.4389 38.3972 30.9486 38.9152C31.4582 39.4332 32.1075 39.7859 32.8144 39.9288C33.5212 40.0717 34.2539 39.9984 34.9198 39.7181C35.5857 39.4377 36.1548 38.963 36.5552 38.354C36.9556 37.7449 37.1693 37.0288 37.1693 36.2963C37.1693 35.314 36.7854 34.372 36.102 33.6774C35.4186 32.9828 34.4918 32.5926 33.5253 32.5926ZM42.9033 10.2833L37.9309 26.7093C37.6135 27.7715 36.9675 28.7014 36.0888 29.361C35.2102 30.0205 34.1457 30.3745 33.0534 30.3704H15.1101C14.0021 30.3667 12.9251 29.9983 12.0405 29.3202C11.1559 28.6421 10.5114 27.691 10.2033 26.6093L3.97384 4.44444H2.18643C1.60655 4.44444 1.05043 4.21032 0.640391 3.79357C0.230355 3.37682 0 2.81159 0 2.22222C0 1.63285 0.230355 1.06762 0.640391 0.650874C1.05043 0.234126 1.60655 0 2.18643 0H4.52227C5.31365 0.00248488 6.08291 0.265708 6.71464 0.750181C7.34637 1.23466 7.80651 1.91426 8.02603 2.68704L9.35428 7.40741H40.8134C41.1556 7.40738 41.493 7.48898 41.7985 7.64564C42.104 7.80231 42.369 8.02966 42.5723 8.30941C42.7756 8.58916 42.9114 8.9135 42.9689 9.25634C43.0264 9.59918 43.0039 9.95094 42.9033 10.2833ZM37.8526 11.8519H10.6024L14.4086 25.3889C14.4522 25.5437 14.5442 25.6799 14.6708 25.7769C14.7974 25.8738 14.9516 25.9261 15.1101 25.9259H33.0534C33.2094 25.9262 33.3613 25.8757 33.487 25.7817C33.6126 25.6877 33.7052 25.5552 33.7512 25.4037L37.8526 11.8519Z" fill="white" />
            </svg>
            Finalizar Compra
        </button>
      `;

      const productsInfos = document.querySelectorAll('.product-info');
      const menuScreenD = document.querySelector(".menu-screen");
      const iconsForBuys = document.querySelector('.icon');

      let qtdProductsInfos = productsInfos.length;
      iconsForBuys.innerHTML = `
        <svg width="43" height="40" viewBox="0 0 43 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18.2203 36.2963C18.2203 37.0288 18.0065 37.7449 17.6061 38.354C17.2057 38.963 16.6366 39.4377 15.9707 39.7181C15.3049 39.9984 14.5722 40.0717 13.8653 39.9288C13.1584 39.7859 12.5091 39.4332 11.9995 38.9152C11.4898 38.3972 11.1428 37.7373 11.0022 37.0189C10.8616 36.3004 10.9337 35.5557 11.2095 34.879C11.4854 34.2022 11.9524 33.6237 12.5517 33.2168C13.1509 32.8098 13.8555 32.5926 14.5762 32.5926C15.5427 32.5926 16.4696 32.9828 17.1529 33.6774C17.8363 34.372 18.2203 35.314 18.2203 36.2963ZM33.5253 32.5926C32.8046 32.5926 32.1 32.8098 31.5008 33.2168C30.9015 33.6237 30.4344 34.2022 30.1586 34.879C29.8828 35.5557 29.8106 36.3004 29.9513 37.0189C30.0919 37.7373 30.4389 38.3972 30.9486 38.9152C31.4582 39.4332 32.1075 39.7859 32.8144 39.9288C33.5212 40.0717 34.2539 39.9984 34.9198 39.7181C35.5857 39.4377 36.1548 38.963 36.5552 38.354C36.9556 37.7449 37.1693 37.0288 37.1693 36.2963C37.1693 35.314 36.7854 34.372 36.102 33.6774C35.4186 32.9828 34.4918 32.5926 33.5253 32.5926ZM42.9033 10.2833L37.9309 26.7093C37.6135 27.7715 36.9675 28.7014 36.0888 29.361C35.2102 30.0205 34.1457 30.3745 33.0534 30.3704H15.1101C14.0021 30.3667 12.9251 29.9983 12.0405 29.3202C11.1559 28.6421 10.5114 27.691 10.2033 26.6093L3.97384 4.44444H2.18643C1.60655 4.44444 1.05043 4.21032 0.640391 3.79357C0.230355 3.37682 0 2.81159 0 2.22222C0 1.63285 0.230355 1.06762 0.640391 0.650874C1.05043 0.234126 1.60655 0 2.18643 0H4.52227C5.31365 0.00248488 6.08291 0.265708 6.71464 0.750181C7.34637 1.23466 7.80651 1.91426 8.02603 2.68704L9.35428 7.40741H40.8134C41.1556 7.40738 41.493 7.48898 41.7985 7.64564C42.104 7.80231 42.369 8.02966 42.5723 8.30941C42.7756 8.58916 42.9114 8.9135 42.9689 9.25634C43.0264 9.59918 43.0039 9.95094 42.9033 10.2833ZM37.8526 11.8519H10.6024L14.4086 25.3889C14.4522 25.5437 14.5442 25.6799 14.6708 25.7769C14.7974 25.8738 14.9516 25.9261 15.1101 25.9259H33.0534C33.2094 25.9262 33.3613 25.8757 33.487 25.7817C33.6126 25.6877 33.7052 25.5552 33.7512 25.4037L37.8526 11.8519Z" fill="white" />
        </svg>
        <div class="notification-buy">${qtdProductsInfos}</div>
      `;

      // ao clicar no botão remove-product, faz com que o elemento seja deletado.
      const removeButtons = document.querySelectorAll(".remove-product");

      removeButtons.forEach((removeButton) => {
        removeButton.addEventListener("click", (e) => {
          
          const parentButton = removeButton.parentElement;
          const valueParentButton = parentButton.querySelector('.price > span');
          let valueButtonFloat = parseFloat(valueParentButton.textContent.replace(/[^\d.,]/g, '').replace(',', '.'));

          const productInfo = e.target.closest(".product-info");
          subtotal -= valueButtonFloat;
    
          selectedProcutsSubtotal.innerHTML = `
            <div class="subtotal-price">Subtotal: <span>R$${subtotal.toFixed(2)}</span></div>
            <button class="subtotal-price__finalize">
                <svg width="43" height="40" viewBox="0 0 43 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.2203 36.2963C18.2203 37.0288 18.0065 37.7449 17.6061 38.354C17.2057 38.963 16.6366 39.4377 15.9707 39.7181C15.3049 39.9984 14.5722 40.0717 13.8653 39.9288C13.1584 39.7859 12.5091 39.4332 11.9995 38.9152C11.4898 38.3972 11.1428 37.7373 11.0022 37.0189C10.8616 36.3004 10.9337 35.5557 11.2095 34.879C11.4854 34.2022 11.9524 33.6237 12.5517 33.2168C13.1509 32.8098 13.8555 32.5926 14.5762 32.5926C15.5427 32.5926 16.4696 32.9828 17.1529 33.6774C17.8363 34.372 18.2203 35.314 18.2203 36.2963ZM33.5253 32.5926C32.8046 32.5926 32.1 32.8098 31.5008 33.2168C30.9015 33.6237 30.4344 34.2022 30.1586 34.879C29.8828 35.5557 29.8106 36.3004 29.9513 37.0189C30.0919 37.7373 30.4389 38.3972 30.9486 38.9152C31.4582 39.4332 32.1075 39.7859 32.8144 39.9288C33.5212 40.0717 34.2539 39.9984 34.9198 39.7181C35.5857 39.4377 36.1548 38.963 36.5552 38.354C36.9556 37.7449 37.1693 37.0288 37.1693 36.2963C37.1693 35.314 36.7854 34.372 36.102 33.6774C35.4186 32.9828 34.4918 32.5926 33.5253 32.5926ZM42.9033 10.2833L37.9309 26.7093C37.6135 27.7715 36.9675 28.7014 36.0888 29.361C35.2102 30.0205 34.1457 30.3745 33.0534 30.3704H15.1101C14.0021 30.3667 12.9251 29.9983 12.0405 29.3202C11.1559 28.6421 10.5114 27.691 10.2033 26.6093L3.97384 4.44444H2.18643C1.60655 4.44444 1.05043 4.21032 0.640391 3.79357C0.230355 3.37682 0 2.81159 0 2.22222C0 1.63285 0.230355 1.06762 0.640391 0.650874C1.05043 0.234126 1.60655 0 2.18643 0H4.52227C5.31365 0.00248488 6.08291 0.265708 6.71464 0.750181C7.34637 1.23466 7.80651 1.91426 8.02603 2.68704L9.35428 7.40741H40.8134C41.1556 7.40738 41.493 7.48898 41.7985 7.64564C42.104 7.80231 42.369 8.02966 42.5723 8.30941C42.7756 8.58916 42.9114 8.9135 42.9689 9.25634C43.0264 9.59918 43.0039 9.95094 42.9033 10.2833ZM37.8526 11.8519H10.6024L14.4086 25.3889C14.4522 25.5437 14.5442 25.6799 14.6708 25.7769C14.7974 25.8738 14.9516 25.9261 15.1101 25.9259H33.0534C33.2094 25.9262 33.3613 25.8757 33.487 25.7817C33.6126 25.6877 33.7052 25.5552 33.7512 25.4037L37.8526 11.8519Z" fill="white" />
                </svg>
                Finalizar Compra
            </button>
          `;
          
          if (qtdProductsInfos > 1) {
            qtdProductsInfos--;
            iconsForBuys.innerHTML = `
              <svg width="43" height="40" viewBox="0 0 43 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.2203 36.2963C18.2203 37.0288 18.0065 37.7449 17.6061 38.354C17.2057 38.963 16.6366 39.4377 15.9707 39.7181C15.3049 39.9984 14.5722 40.0717 13.8653 39.9288C13.1584 39.7859 12.5091 39.4332 11.9995 38.9152C11.4898 38.3972 11.1428 37.7373 11.0022 37.0189C10.8616 36.3004 10.9337 35.5557 11.2095 34.879C11.4854 34.2022 11.9524 33.6237 12.5517 33.2168C13.1509 32.8098 13.8555 32.5926 14.5762 32.5926C15.5427 32.5926 16.4696 32.9828 17.1529 33.6774C17.8363 34.372 18.2203 35.314 18.2203 36.2963ZM33.5253 32.5926C32.8046 32.5926 32.1 32.8098 31.5008 33.2168C30.9015 33.6237 30.4344 34.2022 30.1586 34.879C29.8828 35.5557 29.8106 36.3004 29.9513 37.0189C30.0919 37.7373 30.4389 38.3972 30.9486 38.9152C31.4582 39.4332 32.1075 39.7859 32.8144 39.9288C33.5212 40.0717 34.2539 39.9984 34.9198 39.7181C35.5857 39.4377 36.1548 38.963 36.5552 38.354C36.9556 37.7449 37.1693 37.0288 37.1693 36.2963C37.1693 35.314 36.7854 34.372 36.102 33.6774C35.4186 32.9828 34.4918 32.5926 33.5253 32.5926ZM42.9033 10.2833L37.9309 26.7093C37.6135 27.7715 36.9675 28.7014 36.0888 29.361C35.2102 30.0205 34.1457 30.3745 33.0534 30.3704H15.1101C14.0021 30.3667 12.9251 29.9983 12.0405 29.3202C11.1559 28.6421 10.5114 27.691 10.2033 26.6093L3.97384 4.44444H2.18643C1.60655 4.44444 1.05043 4.21032 0.640391 3.79357C0.230355 3.37682 0 2.81159 0 2.22222C0 1.63285 0.230355 1.06762 0.640391 0.650874C1.05043 0.234126 1.60655 0 2.18643 0H4.52227C5.31365 0.00248488 6.08291 0.265708 6.71464 0.750181C7.34637 1.23466 7.80651 1.91426 8.02603 2.68704L9.35428 7.40741H40.8134C41.1556 7.40738 41.493 7.48898 41.7985 7.64564C42.104 7.80231 42.369 8.02966 42.5723 8.30941C42.7756 8.58916 42.9114 8.9135 42.9689 9.25634C43.0264 9.59918 43.0039 9.95094 42.9033 10.2833ZM37.8526 11.8519H10.6024L14.4086 25.3889C14.4522 25.5437 14.5442 25.6799 14.6708 25.7769C14.7974 25.8738 14.9516 25.9261 15.1101 25.9259H33.0534C33.2094 25.9262 33.3613 25.8757 33.487 25.7817C33.6126 25.6877 33.7052 25.5552 33.7512 25.4037L37.8526 11.8519Z" fill="white" />
              </svg>
              <div class="notification-buy">${qtdProductsInfos}</div>
            `;
            productInfo.remove();
          } else {
            productInfo.remove();
            selectedProducts.style.animation = "close-products-selected .5s ease forwards";  
            setTimeout(() => {
              selectedProducts.style.display = 'none'; 
              menuScreenD.classList.remove("active");
            }, 500);
          }
        });

      });

      const selectedProductsButton = document.querySelector(".selected-products__button");

      selectedProductsButton.addEventListener("click", () => {
        menuScreenD.classList.add("active");
        selectedProducts.style.animation =
          "open-products-selected .5s ease forwards";
      });

      menuScreenD.addEventListener("click", function (event) {
        if (
          !selectedProducts.contains(event.target) &&
          !selectedProductsButton.contains(event.target)
        ) {
          menuScreenD.classList.remove("active");
          selectedProducts.style.animation =
            "close-products-selected .5s ease forwards";
        }
      });
      closeCard();
    } else {
      alert("Por favor, selecione um tamanho");
    }
  });

  const closeCard = () => {
    addProduto.classList.remove("animacao-removeOpacidade");
    addProduto.classList.add("animacao-opacidade");

    infoCard.classList.remove("animacao-opacidade");
    imgProduto.classList.remove("animacao-opacidade");

    infoCarrinho.classList.add("animacao-opacidade");
    infoCarrinho.classList.remove("animacao-removeOpacidade");
    infoCard.classList.add("animacao-removeOpacidade");
    imgProduto.classList.add("animacao-removeOpacidade");

    sobreCard.classList.remove("efeito-sobe-info");
    sobreCard.classList.add("efeito-desce-info");

    setTimeout(() => {
      infoCard.style.display = "block";
      infoCarrinho.style.display = "none";
    }, 100);
  };

  const cancelarCompra = card.querySelector(".cancelar-compra");
  cancelarCompra.addEventListener("click", () => {
    closeCard();
  });

  // para quantidade
  const decreaseBtn = card.querySelector('[data-action="decrease"]');
  const increaseBtn = card.querySelector('[data-action="increase"]');
  const inputQuantity = card.querySelector(".input-quantity");

  decreaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(inputQuantity.value);
    if (currentValue > 1) {
      inputQuantity.value = currentValue - 1;
    }
  });

  increaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(inputQuantity.value);
    inputQuantity.value = currentValue + 1;
  });
});
