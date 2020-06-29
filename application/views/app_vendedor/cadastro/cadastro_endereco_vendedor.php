<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="<?=base_url()?>public/js/app_vendedor/index.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/app_vendedor/cadastro.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/cookie.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/jquery.mask.js" type="text/javascript"></script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1 class="text-center font-italic">
                <?=NOME_APP_VENDEDOR?>
                </h1>
            </div>
        </div>
        <form action="<?=base_url()?>app_vendedor/cadastro/salvar" method="POST" id="fmrCadastroVendedorEndereco">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2" id="divCep">
                    <input type="text" class="form-control" name="numCep" value="" required placeholder="CEP" id="cep" maxlength="10" autocomplete="nofill">
                </div>
                <div class="col-2 mb-2" style="display: none;" id="divCarregandoCep">
                    <button class="btn btn-outline-secondary btn-block" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Carregando...
                    </button>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="descLogradouro" id="logradouro" value="" required placeholder="Logradouro" readonly>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="number" class="form-control" name="numLocal" value="" placeholder="Numero" readonly required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="descComplemento" value="" placeholder="Complemento" readonly autocomplete="off" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="descBairro" id="bairro" value="" required placeholder="Bairro" readonly>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="descCidade" id="localidade" value="" required placeholder="Cidade" readonly>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="siglaUf" id="uf" value="" required placeholder="Estado" maxlength="2" readonly>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
            <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnFormVoltar">Voltar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Salvar</button>
                </div>
            </div>
        </form>  
    </div>
</div>