<!-- CSS -->
<link href="http://localhost/soma/public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="http://localhost/soma/public/js/app_vendedor/index.js" type="text/javascript"></script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                <?=NOME_APP_VENDEDOR?>
                </h1>
            </div>
        </div>
        
        <form>
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
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnFormVoltar">Voltar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Logar</button>
                </div>
            </div>
        </form>
    </div>
</div>