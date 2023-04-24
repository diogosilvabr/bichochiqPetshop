<section class="container-requests">
    <div class="requests-products">
        <h5>Meus pedidos</h5>
        <div class="view-requests">
            <div class="user-solicites">
                <button class="user-solicites__button active" data-target="#in-progress">Em andamento</button>
                <button class="user-solicites__button" data-target="#completed">Concluídos</button>
                <button class="user-solicites__button" data-target="#canceled">Cancelados</button>
            </div>

            <div class="view-request__solicited">
                <div class="view-card__info active" id="in-progress">
                    <?php include('blades/request-products__solicited.php'); ?>
                </div>
                <div class="view-card__info" id="completed">
                    <?php include('blades/request-products__completed.php'); ?>
                </div>
                <div class="view-card__info" id="canceled">
                    <?php include('blades/request-products__canceled.php'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="requests-products">
        <h5>Minhas informações</h5>
        <div class="view-requests">
            <div class="user-solicites">
                <button class="user-solicites__button active" data-target="#my-address">Meus endereços</button>
                <button class="user-solicites__button" data-target="#my-cards">Meus cartões</button>
                <button class="user-solicites__button" data-target="#my-data">Meus dados</button>
            </div>

            <div class="view-request__solicited">
                <div class="view-card__info active" id="my-address">
                    <?php include('blades/my-adress-user.php'); ?>
                </div>
                <div class="view-card__info" id="my-cards">
                    <?php include('blades/my-card-user.php'); ?>
                </div>
                <div class="view-card__info" id="my-data">
                    <?php include('blades/my-informations-user.php'); ?>
                </div>
            </div>
        </div>
    </div>
</section>