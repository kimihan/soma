<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!-- JS -->
<script src="<?=base_url()?>public/js/app_vendedor/index.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/jquery.mask.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/cookie.js" type="text/javascript"></script>
<script src="<?=base_url()?>public/js/app_vendedor/venda.js" type="text/javascript"></script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <form action="<?=base_url()?>app_vendedor/venda/cadastrar_venda_endereco" method="POST" id="fmrCadastroVenda">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <select class="form-control" name="produto" required>
                        <option selected value="">Selecione o produto</option>"
                        <?php
                            foreach ($dadosProdutos as $key => $value) {
                                echo "<option value='{$value->idProduto}-{$value->vrPreco}'>{$value->descNome} - R$ {$value->vrPreco}</option>";
                            }
                        ?>
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