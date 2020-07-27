<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            <?=!empty($dadosComissao[0]->descNome)?$dadosComissao[0]->descNome:NULL?>
        </h3>
    </div>
    <!--begin::Form-->
    <div class="card-body col-10">
        <div class="form-group row">
            <label  class="col-2 col-form-label">Vendas vinculadas</label>
            <div class="col-12 col-form-label">
                <table class="table">
                    <tr>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Data da venda</th>
                        <th>% da Comissão</th>
                        <th>Valor da venda</th>
                        <th>Valor da comissão</th>
                    </tr>
                    <?php foreach($dadosComissao as $key => $vendedor):?>
                        <tr>
                        
                            <td><?=$vendedor->descNome?></td>
                            <td><?=$vendedor->nomeCliente?></td>
                            <td><?=formataData($vendedor->dataVenda)?></td>
                            <td><?=$vendedor->numComissao?>%</td>
                            <td>R$ <?=number_format($vendedor->vrPreco, 2, ",", ".")?></td>
                            <td>R$ <?=number_format($vendedor->vrComissao, 2, ",", ".")?></td>                       
                        </tr>
                    <?php endforeach?>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-10">
                <a href="<?=base_url()?>app_gerencial_comissoes/"><button type="button" class="btn btn-secondary">Voltar</button></a>
            </div>
        </div>
    </div>
</div>
