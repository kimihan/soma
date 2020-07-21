<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Inserir produto
        </h3>
    </div>
    <!--begin::Form-->
    <form id="form" method="post" role="form">
        <div class="card-body col-6">
            <div class="form-group row">
                <label  class="col-2 col-form-label">Nome</label>
                <div class="col-10">
                    <input class="form-control" type="hidden" value="<?=!empty($dadosProduto->idProduto)?$dadosProduto->idProduto:NULL?>" name="idProduto" id="idProduto"/>
                    <input class="form-control required" type="text" value="<?=!empty($dadosProduto->descNome)?$dadosProduto->descNome:NULL?>" name="descNome" id="descNome"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Coberturas</label>
                <div class="col-10">
                    <textarea class="form-control" name="descCoberturas" id="descCoberturas"><?=!empty($dadosProduto->descCoberturas)?$dadosProduto->descCoberturas:NULL?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Exibe no aplicativo?</label>
                <div class="col-10">
                    <input class="form-control" type="checkbox" value="<?=!empty($dadosProduto->flgAplicativo)?$dadosProduto->flgAplicativo:NULL?>" name="flgAplicativo" id="flgAplicativo"/>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                    <a href="<?=base_url()?>app_gerencial/produtos/"><button type="button" class="btn btn-secondary">Voltar</button></a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/produtos/ajax_salvar",
            data: $("#form").serializeArray(),
            success : function(text){
                alert("Registro salvo com sucesso!");
            }
        });
    }

    function formSuccess(){
        $( "#msgSubmit" ).removeClass( "hidden" );
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