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
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <select class="form-control">
                        <option>Produto A</option>
                    </select>
                </div>
            </div>
            <?php $this->load->view('app_cliente/cadastro/campos_cadastro_cliente'); ?>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Proximo</button>
                </div>
            </div>
        </form>
    </div>
</div>