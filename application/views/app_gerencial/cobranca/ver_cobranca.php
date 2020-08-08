<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            <?=!empty($dadosCobranca->descNome)?$dadosCobranca->descNome:NULL?>
        </h3>
    </div>
    <div class="card-body col-6">
        <div class="form-group row">
            <label  class="col-2">ID</label>
            <div class="col-10">
                <?=!empty($dadosCobranca->idCobranca)?$dadosCobranca->idCobranca:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2">Nome</label>
            <div class="col-10">
                <?=!empty($dadosCobranca->descNome)?$dadosCobranca->descNome:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2">E-mail</label>
            <div class="col-10">
                <?=!empty($dadosCobranca->descEmail)?$dadosCobranca->descEmail:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2">Data Gerado</label>
            <div class="col-10">
                <?=!empty($dadosCobranca->dataGerado)?formataData($dadosCobranca->dataGerado):NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2">Data Vencimento</label>
            <div class="col-10">
                <?=!empty($dadosCobranca->dataVencimento)?formataData($dadosCobranca->dataVencimento):NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2">Data Pagamento</label>
            <div class="col-10">
                <?=!empty($dadosCobranca->dataPagamento)?formataData($dadosCobranca->dataPagamento):NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2">Valor</label>
            <div class="col-10">
                <?=!empty($dadosCobranca->vrPreco)?number_format($dadosCobranca->vrPreco, 2, ",", "."):NULL?>
            </div>
        </div>
        <?php if(empty($dadosCobranca->flgPago)):?>
            <div class="form-group row">
                <label  class="col-2"></label>
                <div class="col-10">
                    <button type="button" class="btn btn-primary  mr-2" id="botaoPagar">Marcar como paga</button>
                </div>
            </div>
        <?php endif?>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-10">
                <?php if(empty($dadosCobranca->flgCancelado)):?>
                    <a href="<?=base_url()?>app_gerencial/cobrancas/cancelar/<?=!empty($dadosCobranca->idCobranca)?$dadosCobranca->idCobranca:NULL?>"><button type="button" class="btn btn-danger  mr-2">Cancelar</button></a>
                <?php endif?>
                <a href="<?=base_url()?>app_gerencial/cobrancas/"><button type="button" class="btn btn-secondary">Voltar</button></a>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/cobrancas/ajax_marcar_pago",
            data: {"idCobranca": <?=!empty($dadosCobranca->idCobranca)?$dadosCobranca->idCobranca:NULL?>},
            success : function(text){
                alert("Cobrança marcada com sucesso!");
                window.location.href = "<?=base_url()?>app_gerencial/cobrancas";
            }
        });
    }

    function formSuccess(){
        $( "#msgSubmit" ).removeClass( "hidden" );
    }

    jQuery(function() {
        $("#botaoPagar").click(function(){
            submitForm();
        });
    });
</script>