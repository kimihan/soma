<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="<?=base_url()?>public/js/app_vendedor/index.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/app_vendedor/cadastro.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/cookie.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/jquery.mask.js" type="text/javascript"></script>

<script>
    $(() => {
        if(getCookie("dadosVendedor") == "") {
            window.location.href = "<?=base_url()?>app_vendedor/cadastro";
        }
    });
</script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
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
                <div class="col-12 mb-2" style="display: none;" id="divCarregandoCep">
                    <button class="btn btn-light btn-block" type="button" disabled id="btnCarregando" >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Carregando...
                    </button>
                </div>
            </div>
            <div id="divFormEndereco" style="display: none;">
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

<div class="modal fade" id="modalSucessoCadastroVendedor" tabindex="-1" role="dialog" aria-labelledby="modalSucessoCadastroVendedor" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro criado com sucesso!</h5>
      </div>
      <div class="modal-body">
        <p>
            Parabéns vocë finalizou seu cadastro no nosso aplicativo, agora vocë já pode iniciar suas vendas!
        </p>
      </div>
      <div class="modal-footer">
        <a href="<?=base_url()?>app_vendedor/venda" class="btn btn-outline-secondary btn-block" >Ir para o login</a>
      </div>
    </div>
  </div>
</div>