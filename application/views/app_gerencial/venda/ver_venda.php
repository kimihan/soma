<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            <?=!empty($dadosVenda->descNome)?$dadosVenda->descNome:NULL?>
        </h3>
    </div>
    <!--begin::Form-->
    <div class="card-body col-6">
        <div class="form-group row">
            <label  class="col-2 col-form-label">ID</label>
            <div class="col-10 col-form-label">
                <?=!empty($dadosVenda->idServico)?$dadosVenda->idServico:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2 col-form-label">Cliente</label>
            <div class="col-10 col-form-label">
                <?=!empty($dadosVenda->descNome)?$dadosVenda->descNome:NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2 col-form-label">Data Venda</label>
            <div class="col-10 col-form-label">
                <?=!empty($dadosVenda->dataVenda)?formataData($dadosVenda->dataVenda):NULL?>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-2 col-form-label">Vendedores</label>
            <div class="col-10 col-form-label">
                <table class="table ">
                    <tr>
                        <th>Vendedor</th>
                        <th>Comissão</th>
                    </tr>
                    <tr>
                        <?php foreach($dadosVenda->vendedores as $key => $vendedor):?>
                            <td><?=$vendedor->descNome?></td>
                            <td><?=$vendedor->numComissao?>%</td>
                        <?php endforeach?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-10">
                <a href="<?=base_url()?>app_gerencial/vendas/editar"><button type="button" class="btn btn-primary  mr-2">Inserir</button></a>
                <a href="<?=base_url()?>app_gerencial/vendas/"><button type="button" class="btn btn-secondary">Voltar</button></a>
            </div>
        </div>
    </div>
</div>
