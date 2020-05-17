<!-- CSS -->
<link href="public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="public/js/app_cliente/index.js" type="text/javascript"></script>


<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                    <?= NOME_APP_CLIENTE ?>
                </h1>
            </div>
        </div>
        <form>
            <?php $this->load->view('app_cliente/cadastro/campos_cadastro_endereco_cliente'); ?>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="button">Voltar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Proximo</button>
                </div>
            </div>
        </form>  
    </div>
</div>