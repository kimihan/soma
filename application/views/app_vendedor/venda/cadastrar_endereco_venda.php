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
        <div class="row">
            <div class="col-12 mb-3">
                <h1 class="text-center font-italic">
                    <?= NOME_APP_VENDEDOR ?>
                </h1>
            </div>
        </div>

        <form action="<?=base_url()?>app_vendedor/venda/cadastrar_venda_endereco" method="POST" id="fmrCadastroVendaEndereco">
            <div id="divCall">
                <?php $this->load->view('app_cliente/cadastro/campos_cadastro_endereco_cliente'); ?>
            </div>
            <div class="form-row justify-content-center align-self-center mt-2">
                <div class="col-12 mb-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="isCall" name="flgLigacao">
                        <label class="custom-control-label" for="isCall">Ligar para completar os dados</label>
                    </div>
                    <hr style="background-color: #DEDE1F !important;" class="my-2">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnUpload">Upload de foto da proposta</button>
                    <input type="file" style="display: none;" name="inpFoto" multiple />
                </div>
                <div class="col-12 mb-2" style="display: none;" id="divCarregandoFoto">
                    <button class="btn btn-light btn-block" type="button" disabled>
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
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnFormVoltar">Voltar</button>
                </div>
                <div class="col-6 col-lg-6">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Cadastrar venda</button>
                </div>
            </div>
        </form>
    </div>
</div>