<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Cancelamento da cobrança  <?=!empty($idCobranca)?$idCobranca:NULL?>
        </h3>
    </div>
    <form id="form" method="post" role="form">
        <div class="card-body col-6">
            <div class="form-group row">
                <label  class="col-2">Motivo</label>
                <div class="col-10">
                    <textarea placeholder="Digite o motivo do cancelamento da cobrança" name="descRazaoCancelamento" id="descRazaoCancelamento" style="width: 600px; height: 200px;" class="required"></textarea>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    <a href="<?=base_url()?>app_gerencial/cobrancas/cancelar"><button type="submit" class="btn btn-danger  mr-2">Cancelar</button></a>
                    <a href="<?=base_url()?>app_gerencial/cobrancas/"><button type="button" class="btn btn-secondary">Voltar</button></a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/cobrancas/ajax_cancela_cobranca/<?=!empty($idCobranca)?$idCobranca:NULL?>",
            data: $("#form").serializeArray(),
            success : function(text){
                alert("Cobrança cancelada com sucesso!");
                window.location.href = "<?=base_url()?>app_gerencial/cobrancas";
            }
        });
    }

    jQuery(function() {
        $("#form").submit(function(event){
            event.preventDefault();
            if($(this).valid()) {
                submitForm();
            }
        });
    });
</script>