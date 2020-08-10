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
        <form action="<?=base_url()?>app_cliente/pagamento" method="POST" id="fmrCadastroClientePagamento">
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" disabled class="form-control" value="<?=$dadosProduto->descNome . ' - R$' . number_format($dadosProduto->vrPreco,2,",",".")?>">
                    <input type="hidden" name="servico" value="<?=$dadosProduto->idServico?>" />
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
                        <option value="-1">Periodicidade de pagamento</option>
                        <option value="mensal">Mensal</option>
                        <option value="anual">Anual</option>
                    </select>
                    <select class="form-control" name="periodoPagseguro" style="display: none;">
                        <option value="-1">Periodicidade de pagamento</option>
                        <option value="<?=PLANO_PAGSEGURO_MENSAL?>">Mensal</option>
                        <option value="<?=PLANO_PAGSEGURO_ANUAL?>">Anual</option>
                    </select>
                </div>
            </div>
            <div id="divCartaoCredito" style="display: none;">
                <div class="form-row justify-content-center align-self-center">
                    <div class="col-12 mb-2">
                        <input type="text" class="form-control" value="" id="nCartao" name="nCartao" required placeholder="Número do cartão">
                    </div>
                </div>
                <div class="form-row justify-content-center align-self-center">
                    <div class="col-8 mb-2">
                        <input type="text" class="form-control" value="" id="vencimento" name="vencimento" required placeholder="Vencimento">  
                    </div>
                    <div class="col-4 mb-2">
                        <input type="text" class="form-control" value="" id="cvv" name="cvv"required placeholder="CVV">
                    </div>
                </div>
                <div class="form-row justify-content-center align-self-center">
                    <div class="col-12 mb-2">
                        <input type="text" class="form-control" value="" required placeholder="Nome no cartão" name="nomeCartao">
                    </div>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2">
                    <input type="text" class="form-control" id="cpfOuCnpj" name="numCpf" value=""  placeholder="CPF/CNPJ" required>
                </div>
            </div>
            <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2" style="display: none;" id="divCarregandoPagamento">
                    <a class="btn btn-primary btn-block btn-not-default" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Carregando...
                    </a>
                </div>     
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

<div class="modal fade" id="modalPreAprovalPagSeguro" tabindex="-1" role="dialog" aria-labelledby="modalPreAprovalPagSeguro" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="col-12 modal-title text-center">Confirmar pagamento?</h5>
      </div>
      <div class="modal-body">
        <p class="text-center">
        <div class="form-row justify-content-center align-self-center">
                <div class="col-12 mb-2" style="display: none;" id="divCarregandoPreAprovalPagSeguro">
                    <a class="btn btn-primary btn-block btn-not-default" type="button" disabled >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Carregando...
                    </a>
                </div>     
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="button" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-outline-secondary btn-block" type="button" id="btnConfirmarPagSeguro">Confirmar</button>
                </div>
            </div>
        </p>
      </div>
    </div>
  </div>
</div>