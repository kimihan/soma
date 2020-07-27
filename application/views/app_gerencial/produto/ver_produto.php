<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            <?=!empty($dadosProduto->descNome)?$dadosProduto->descNome:NULL?>
        </h3>
    </div>
    <!--begin::Form-->
    <div class="card-body col-6">
        <div class="form-group row">
            <label  class="col-2 col-form-label">ID</label>
            <div class="col-10">
                <?=!empty($dadosProduto->idProduto)?$dadosProduto->idProduto:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2 col-form-label">Nome</label>
            <div class="col-10">
                <?=!empty($dadosProduto->descNome)?$dadosProduto->descNome:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label for="example-email-input" class="col-2 col-form-label">Coberturas</label>
            <div class="col-10">
                <?=!empty($dadosProduto->descCoberturas)?$dadosProduto->descCoberturas:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label for="example-email-input" class="col-2 col-form-label">Exibe no aplicativo?</label>
            <div class="col-10">
                <?=!empty($dadosProduto->flgAplicativo)?"Sim":"Não"?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-10">
                <a href="<?=base_url()?>app_gerencial_produtos/editar"><button type="button" class="btn btn-primary  mr-2">Inserir</button></a>
                <a href="<?=base_url()?>app_gerencial_produtos/"><button type="button" class="btn btn-secondary">Voltar</button></a>
            </div>
        </div>
    </div>
</div>
