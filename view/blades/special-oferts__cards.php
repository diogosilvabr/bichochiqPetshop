<?php
include("../model/database.php");
include("../controller/crudProdutos.php");
?>

<section class="special-oferts">
    <div class="title-about">
        <div class="dashed-title"></div>
        <h1>Não perca as nossas <span>ofertas especiais </span></h1>
        <p>para cuidar do seu animal de estimação!</p>
    </div>
    <div class="slider amareloOuro">
        <div class="slider-container">
            <div class="slider-content">

                <?php
                // Certifique-se de que $mongoDBColecao é uma instância válida de uma coleção MongoDB
                if ($colecao instanceof MongoDB\Collection) {
                    $produtos = $colecao->find(); // Buscar todos os documentos da coleção

                    // Verificar se foram encontrados documentos
                    if ($produtos) {
                        foreach ($produtos as $produto) {
                            $tamanhos = explode(',', $produto->tamanho);
                ?>
                            <div class="product-card">
                                <div iv class="card">
                                    <img src="images/<?php echo $produto->imagem; ?>" class="img-produto" alt="">
                                    <div class="sobre-card">
                                        <div class="info-card">
                                            <div class="sobre-produto"> 
                                                <?php echo $produto->nome; ?>
                                            </div>
                                            <div class="preco">
                                                <p class="parcelas">Ou em 12x de R$
                                                    <?php echo round($produto->preco/12); ?>
                                                </p>
                                                <p class="preco-avista">R$
                                                    <?php echo $produto->preco; ?>
                                                </p>
                                            </div>
                                            <div class="desconto">20% OFF</div>
                                        </div>
                                        <div class="add" id="infoCarrinho">
                                            <div class="botoes">
                                                <button class="btn-carr-mais" id="addCarrinho">Colocar no Carrinho</button>
                                                <a href="detalhes-produto.php?id=<?php echo $produto->_id; ?>" class="btn-carr-mais">Mais Detalhes</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="adicionar-produto">
                                        <div class="escolha">
                                            <div class="nome-produto">
                                                <h3>
                                                    <?php echo $produto->nome; ?>
                                                </h3>
                                            </div>

                                            <div class="tamanho">
                                                <h2>Tamanho</h2>
                                                <form>
                                                    <?php foreach ($tamanhos as $tamanho) { ?>
                                                        <label>
                                                            <input type="radio" name="tamanho" value="<?php echo $tamanho; ?>">
                                                            <span class="btn"><?php echo $tamanho; ?></span>
                                                        </label>
                                                    <?php } ?>
                                                </form>
                                            </div>


                                            <div class="quantidade">
                                                <h2>Quantidade</h2>
                                                <div class="quantity">
                                                    <button class="btn-quantity" data-action="decrease">-</button>
                                                    <input class="input-quantity" type="number" min="1" value="1">
                                                    <button class="btn-quantity" data-action="increase">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="confirmar-pedido">
                                            <div class="decide-pedido">
                                                <button class="btn-pedido cancelar-compra">Cancelar</button>
                                                <button class="btn-pedido confirmar-compra">Pronto</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>


            </div>
            <div class="buttons__prev-next">
                <button class="slider-button prev-button">
                    <svg width="14" height="23" viewBox="0 0 14 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.1283 21.6708L1.30799 11.8708C1.19143 11.7542 1.10867 11.6278 1.05971 11.4917C1.01076 11.3556 0.986668 11.2097 0.987445 11.0542C0.987445 10.8986 1.01153 10.7528 1.05971 10.6167C1.10789 10.4806 1.19065 10.3542 1.30799 10.2375L11.1283 0.408333C11.4003 0.136111 11.7403 0 12.1482 0C12.5562 0 12.9059 0.145833 13.1973 0.4375C13.4887 0.729167 13.6344 1.06944 13.6344 1.45833C13.6344 1.84722 13.4887 2.1875 13.1973 2.47917L4.63001 11.0542L13.1973 19.6292C13.4693 19.9014 13.6053 20.237 13.6053 20.636C13.6053 21.035 13.4596 21.3799 13.1682 21.6708C12.8768 21.9625 12.5368 22.1083 12.1482 22.1083C11.7597 22.1083 11.4197 21.9625 11.1283 21.6708Z" fill="#45CAF7" />
                    </svg>
                </button>

                <button class="slider-button next-button">
                    <svg width="14" height="23" viewBox="0 0 14 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.8717 1.32904L12.692 11.129C12.8086 11.2457 12.8914 11.3721 12.9403 11.5082C12.9893 11.6443 13.0134 11.7902 13.0126 11.9457C13.0126 12.1013 12.9885 12.2471 12.9403 12.3832C12.8921 12.5193 12.8094 12.6457 12.692 12.7624L2.8717 22.5915C2.59972 22.8638 2.25975 22.9999 1.85178 22.9999C1.44381 22.9999 1.09413 22.854 0.802724 22.5624C0.511319 22.2707 0.365617 21.9304 0.365617 21.5415C0.365617 21.1527 0.511319 20.8124 0.802724 20.5207L9.37003 11.9457L0.802726 3.37071C0.530747 3.09848 0.394758 2.76287 0.394758 2.36387C0.394758 1.96487 0.540461 1.61993 0.831865 1.32904C1.12327 1.03737 1.46324 0.89154 1.85178 0.89154C2.24032 0.89154 2.58029 1.03737 2.8717 1.32904Z" fill="#45CAF7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>