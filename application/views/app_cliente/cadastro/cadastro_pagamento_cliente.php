<!-- CSS -->
<link href="<?=base_url()?>public/css/index.css" rel="stylesheet" type="text/css"/>

<!--JS -->
<script>
    var sessionIdPagSeguro = "<?=$sessionIdPagSeguro?>";
</script>
<script src="<?=base_url()?>public/js/app_cliente/index.js" type="text/javascript"></script>
<?php 
    if(AMBIENTE_DEV != "1") {
        echo  '<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>';
    } else {
        echo  '<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>';
    }
?>
<script src="<?=base_url()?>public/js/app_cliente/cadastro_pagamento_pagseguro.js" type="text/javascript"></script>

<div class="jumbotron d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h1 class="text-center font-italic">
                    Pagamento
                </h1>
            </div>
        </div>
        <form action="<?=base_url()?>app_cliente/cliente/salvar" method="POST" id="fmrCadastroClientePagamento">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" disabled class="form-control" value="<?=$dadosProduto->descNome . ' - R$' . number_format($dadosProduto->vrPreco,2,",",".")?>">
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <select class="form-control" name="formaPagamento" required>
                        <option>Forma de pagamento</option>
                        <?php
                            foreach ($formasPagamento as $key => $value) {
                                echo "<option value='{$value->id}'>{$value->nome}</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center" required>
                <div class="col-12 mb-2">
                    <select class="form-control" name="periodo">
                        <option>Periodicidade de pagamento</option>
                        <option value="mensal">Mensal</option>
                        <option value="anual">Anual</option>
                    </select>
                </div>
            </div>
            <div id="divCartaoCredito" style="display: none;">
                <div class="form-row justify-content-center align-self-center">
                    <div class="col-12 mb-2">
                        <input type="text" class="form-control" value="" id="nCartao" required placeholder="Número do cartão">
                    </div>
                </div>
                <div class="form-row justify-content-center align-self-center">
                    <div class="col-8 mb-2">
                        <input type="text" class="form-control" value="" id="vencimento" required placeholder="Vencimento">  
                    </div>
                    <div class="col-4 mb-2">
                        <input type="text" class="form-control" value="" id="cvv" required placeholder="CVV">
                    </div>
                </div>
                <div class="form-row justify-content-center align-self-center">
                    <div class="col-12 mb-2">
                        <input type="number" class="form-control" value="" required placeholder="Nome no cartão" max="16">
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" id="cpfOuCnpj" name="numCpf" value=""  placeholder="CPF/CNPJ" required>
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