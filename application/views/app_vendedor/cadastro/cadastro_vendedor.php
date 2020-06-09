<!-- CSS -->
<link href="http://localhost/soma/public/css/index.css" rel="stylesheet" type="text/css"/>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                    <?= NOME_APP_VENDEDOR ?>
                </h1>
            </div>
        </div>
        <form action="cadastro/cadastro_endereco" method="POST">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control"  value="" required placeholder="Nome completo">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control"  value="" required placeholder="CPF/CNPJ">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="email" class="form-control"  value="" required placeholder="E-mail">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="password" class="form-control" value="" required placeholder="Senha">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <hr class="mt-2 mb-0">
                </div>
                <div class="col-12 mb-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">É banca?</label>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control"  value="" placeholder="Nome da banca">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Proximo</button>
                </div>
            </div>
        </form>  
    </div>
</div>