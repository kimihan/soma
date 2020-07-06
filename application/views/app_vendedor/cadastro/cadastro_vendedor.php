<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="<?=base_url()?>public/js/app_vendedor/index.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/app_vendedor/cadastro.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/cookie.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/jquery.mask.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/crypto-js.min.js" type="text/javascript"></script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <form action="<?=base_url()?>app_vendedor/cadastro/cadastro_endereco" method="POST" id="fmrCadastroVendedor">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="descNome" value=""  placeholder="Nome completo" required autocomplete="nofill" />
                    <input type="hidden" name="flgTipoPessoa" id="tipoPessoa" value="">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" id="cpfOuCnpj" name="numCpf" value=""  placeholder="CPF/CNPJ" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="email" class="form-control" name="descEmail" value=""  placeholder="E-mail" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" value="" name="numTelefone" id="telefone" placeholder="Telefone">
            </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" value="" name="numWhatsapp" id="whatsapp" placeholder="Whatsapp">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="password" class="form-control" value="" name="descSenha" id="senha" placeholder="Senha" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="password" class="form-control" value="" id="confirmaSenha"  placeholder="Confirmar senha" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <hr class="mt-2 mb-0">
                </div>
                <div class="col-12 mb-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="isBanca" name="flgBanca">
                        <label class="custom-control-label" for="isBanca">É banca?</label>
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center" style="display: none;" id="divNomeBanca">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" name="descNomeBanca" value="" placeholder="Nome da banca">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnFormVoltar">Voltar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Proximo</button>
                </div>
            </div>
        </form>  
    </div>
</div>