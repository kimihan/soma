<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script src="<?=base_url()?>public/js/app_cliente/index.js" type="text/javascript"></script>


<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <form action="<?=base_url()?>app_cliente/cliente/cadastro_endereco" method="POST" id="fmrCadastroClienteDados">
            <?php $this->load->view('app_cliente/cadastro/campos_cadastro_cliente'); ?>
            <input type="hidden" value='<?=json_encode($dadosCliente)?>' id="dadosCliente"/>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12">
                    <button class="btn btn-outline-secondary btn-block" type="submit">Proximo</button>
                </div>
            </div>
        </form>
    </div>
</div>