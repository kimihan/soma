<!-- CSS -->
<link href="public/css/index.css" rel="stylesheet" type="text/css"/>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                    <?= NOME_APP_VENDEDOR ?>
                </h1>
            </div>
        </div>

        <form>
            <?php $this->load->view('app_cliente/cadastro/campos_cadastro_endereco_cliente'); ?>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <hr class="mt-1 mb-0">
                </div>
                <div class="col-12 mb-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Ligar para completar os dados</label>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-1">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Upload de foto da proposta</button>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Cadastrar venda</button>
                </div>
            </div>
        </form>
    </div>
</div>