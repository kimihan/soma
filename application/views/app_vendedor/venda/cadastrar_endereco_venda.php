<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!-- JS -->
<script src="<?=base_url()?>public/js/app_vendedor/index.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/jquery.mask.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/cookie.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/app_vendedor/venda.js" type="text/javascript"></script>

<script>
    $(() => {
        if(getCookie("dadosVenda") == "") {
            window.location.href = "<?=base_url()?>app_vendedor/venda";
        }
    });
</script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <form action="<?=base_url()?>app_vendedor/venda/salvar" method="POST" id="fmrCadastroVendaEndereco" enctype="multipart/form-data">
            <div id="divCall">
                <?php $this->load->view('app_cliente/cadastro/campos_cadastro_endereco_cliente'); ?>
            </div>
            <div class="form-row justify-content-center align-self-center mt-2">
                <div class="col-12 mb-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="isCall" name="flgLigacao">
                        <label class="custom-control-label" for="isCall">Ligar para completar os dados</label>
                    </div>
                    <hr style="background-color: #003446 !important;" class="my-2">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnUpload">Upload de foto da proposta</button>
                    <input type="file" style="display: none;" id="inpFoto" multiple />
                </div>
                <div class="col-12 mb-2" style="display: none;" id="divCarregandoFoto">
                    <button class="btn btn-primary btn-block btn-not-default" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Carregando...
                    </button>
                </div> 
            </div>
            <div class="form-row justify-content-center align-self-center" id="divArquivosUpload" style="display: none;">
                <div class="col-12 mb-2">
                    <ul class="list-group" style="color: black;" id="listUploadFotos">
                    </ul>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-6" name="divCadastrarVenda">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnFormVoltar">Voltar</button>
                </div>
                <div class="col-6 col-lg-6" name="divCadastrarVenda">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Cadastrar venda</button>
                </div>
                <div class="col-12" id="divCarregandoVenda" style="display: none;">
                    <button class="btn btn-primary btn-block btn-not-default" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Carregando...
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalSucessoCadastroVenda" tabindex="-1" role="dialog" aria-labelledby="modalSucessoCadastroVenda" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center">Venda criada com sucesso!</h5>
      </div>
      <div class="modal-body">
        <p class="text-center">
            Você finalizou sua venda! <br>Informe para o cliente que o login é: <br>#<span id="spanIdVenda"></span>
        </p>
      </div>
      <div class="modal-footer">
        <a href="." class="btn btn-outline-secondary btn-block" >Fechar</a>
      </div>
    </div>
  </div>
</div>