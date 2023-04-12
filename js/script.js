const cards = document.querySelectorAll('.card');

// passeia por dentro de todos os elementos de todos os cards
cards.forEach(card => {
  const infoCard = card.querySelector('.info-card');
  const sobreCard = card.querySelector('.sobre-card');
  const infoCarrinho = card.querySelector('#infoCarrinho');
  const imgProduto = card.querySelector('.img-produto');

  // ao passar o mouse por cima, execute essas funções;
  card.addEventListener('mouseenter', () => {
    infoCarrinho.classList.remove('animacao-opacidade');
    sobreCard.classList.remove('efeito-desce-info');
    imgProduto.classList.remove('animacao-removeOpacidade');
    infoCard.classList.remove('animacao-removeOpacidade');

    infoCard.classList.add('animacao-opacidade');
    imgProduto.classList.add('animacao-opacidade');
    infoCarrinho.classList.add('animacao-removeOpacidade');
    sobreCard.classList.add('efeito-sobe-info');

    setTimeout(() => {
      infoCard.style.display = 'none';
      infoCarrinho.style.display = 'block';
    }, 20);

  });

  // ao tirar o mouse de cima, execute essas funções;
  card.addEventListener('mouseleave', () => {
    infoCard.classList.remove('animacao-opacidade');
    imgProduto.classList.remove('animacao-opacidade');

    infoCarrinho.classList.add('animacao-opacidade');
    infoCarrinho.classList.remove('animacao-removeOpacidade');
    infoCard.classList.add('animacao-removeOpacidade');
    imgProduto.classList.add('animacao-removeOpacidade');

    sobreCard.classList.remove('efeito-sobe-info');
    sobreCard.classList.add('efeito-desce-info');

    setTimeout(() => {
      infoCard.style.display = 'block';
      infoCarrinho.style.display = 'none';
    }, 100);
  });

  // variaveis do botão que encaminha para o carrinho e seus dados.
  const botaoCarrinho = card.querySelector('#addCarrinho');
  const sobreProduto = card.querySelector('.sobre-produto').textContent;
  const precoParcelas = card.querySelector('.parcelas').textContent;
  const precoAvista = card.querySelector('.preco-avista').textContent;
  const addProduto = card.querySelector('.adicionar-produto');

  botaoCarrinho.addEventListener('click', () => {
    addProduto.classList.add('animacao-removeOpacidade');
    addProduto.style.display = 'block';
    card.querySelector('input[name="tamanho"]').checked = true;
  });

  // para remover a telinha de selecionar o que deseja do produto e colocar no carrinho
  addProduto.addEventListener('mouseleave', () => {
    addProduto.classList.remove('animacao-opacidade');
    addProduto.classList.add('animacao-removeOpacidade');
    addProduto.style.display = 'none';      
  });

  // ao clicar no botao de confirmar compra - retorna os dados no console.log
  const confirmarCompra = card.querySelector('.confirmar-compra');
  confirmarCompra.addEventListener('click', () => {
    const tamanhoSelecionado = card.querySelector('input[name="tamanho"]:checked');
    const quantidadeSelecionada = card.querySelector('.input-quantity').value;
    if (tamanhoSelecionado) {
      console.log('Tamanho selecionado: ' + tamanhoSelecionado.value);
      console.log('Nome do Produto:', sobreProduto);
      console.log('Preço do Produto:', precoAvista);
      console.log(`Quantidade selecionada: ${quantidadeSelecionada}`);
      console.log('------------------------------------');
      card.remove();
    } else {
      alert('Por favor, selecione um tamanho');
    }
  });

  const cancelarCompra = card.querySelector('.cancelar-compra');
  cancelarCompra.addEventListener('click', () => {
    addProduto.classList.remove('animacao-removeOpacidade');
    addProduto.classList.add('animacao-opacidade');

    infoCard.classList.remove('animacao-opacidade');
    imgProduto.classList.remove('animacao-opacidade');

    infoCarrinho.classList.add('animacao-opacidade');
    infoCarrinho.classList.remove('animacao-removeOpacidade');
    infoCard.classList.add('animacao-removeOpacidade');
    imgProduto.classList.add('animacao-removeOpacidade');

    sobreCard.classList.remove('efeito-sobe-info');
    sobreCard.classList.add('efeito-desce-info');

    setTimeout(() => {
      infoCard.style.display = 'block';
      infoCarrinho.style.display = 'none';
    }, 100);
  });

  // para quantidade
  const decreaseBtn = card.querySelector('[data-action="decrease"]');
  const increaseBtn = card.querySelector('[data-action="increase"]');
  const inputQuantity = card.querySelector('.input-quantity');

  decreaseBtn.addEventListener('click', () => {
    let currentValue = parseInt(inputQuantity.value);
    if (currentValue > 1) {
      inputQuantity.value = currentValue - 1;
    }
  });

  increaseBtn.addEventListener('click', () => {
    let currentValue = parseInt(inputQuantity.value);
    inputQuantity.value = currentValue + 1;
  });
});