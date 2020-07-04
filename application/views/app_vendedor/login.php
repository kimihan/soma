<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="<?=base_url()?>public/js/app_vendedor/index.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/crypto-js.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/app_vendedor/login.js" type="text/javascript"></script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                <?=NOME_APP_VENDEDOR?>
                </h1>
            </div>
        </div>
        
        <form action="<?=base_url()?>app_vendedor/login/logar" method="POST" id="fmrLoginVendedor">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="email" class="form-control" name="descEmail" value=""  placeholder="E-mail" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="password" class="form-control" value="" name="descSenha" id="senha" placeholder="Senha" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6">
                    <a href="http://localhost/soma/app_vendedor/login" class="btn btn-outline-secondary btn-block" >Voltar</a>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Logar</button>
                </div>
            </div>
        </form>
    </div>
</div>