<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Venda <?=!empty($dadosVenda->descNome)?$dadosVenda->descNome:NULL?>
        </h3>
    </div>
    <!--begin::Form-->
    <form id="form" method="post" role="form">
        <div class="card-body col-6">
            <div class="form-group row">
                <label  class="col-2 col-form-label">Cliente</label>
                <div class="col-8">
                    <div class="dropdown bootstrap-select form-control dropup">
                        <select class="form-control selectpicker" data-size="7" data-live-search="true" tabindex="null" name="idCliente" id="idCliente">
                            <option value="">Cliente</option>
                            <?php foreach($dadosClientes as $key => $cliente):?>
                                <option value="<?=$cliente->idCliente?>" ><?=$cliente->descNome?></option>
                            <?php endforeach?>
                        </select>
                        <div class="dropdown-menu" style="max-height: 344px; overflow: hidden;">
                            <div class="bs-searchbox">
                                <input type="search" class="form-control required" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-5" aria-autocomplete="list" aria-activedescendant="bs-select-5-215">
                            </div>
                            <div class="inner show" role="listbox" id="bs-select-5" tabindex="-1" style="max-height: 273px; overflow-y: auto;">
                                <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                    <li class="no-results">Sem resultadoss</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Data da Venda</label>
                <div class="col-8">
                    <input class="form-control required" type="date" value="<?=!empty($dadosVenda->dataVenda)?$dadosVenda->dataVenda:NULL?>" name="dataVenda" id="dataVenda"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Preço</label>
                <div class="col-8">
                    <input class="form-control required" type="number" value="<?=!empty($dadosVenda->vrPreco)?$dadosVenda->vrPreco:NULL?>" name="vrPreco" id="vrPreco"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Produto</label>
                <div class="col-8">
                    <div class="dropdown bootstrap-select form-control dropup"">
                        <select class="form-control selectpicker" data-size="7" data-live-search="true" tabindex="null" name="idProduto" id="idProduto>
                            <option value="">Produto</option>
                            <?php foreach($dadosProdutos as $key => $produto):?>
                                <option value="<?=$produto->idProduto?>" ><?=$produto->descNome?></option>
                            <?php endforeach?>
                        </select>
                        <div class="dropdown-menu" style="max-height: 344px; overflow: hidden;">
                            <div class="bs-searchbox">
                                <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-5" aria-autocomplete="list" aria-activedescendant="bs-select-5-215">
                            </div>
                            <div class="inner show" role="listbox" id="bs-select-5" tabindex="-1" style="max-height: 273px; overflow-y: auto;">
                                <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                    <li class="no-results">Sem resultadoss</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Vendedores vinculados</label>
                <div class="col-8">
                    <table  id="listaProdutos" class="table">
                        <tr>
                            <th>Vendedor</th>
                            <th>% comissão</th>
                        </tr>
                        <tr style="margin-top: 10px">
                            <td style="width: 200px;">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" data-live-search="true" tabindex="null" name="idVendedor0" id="idVendedor0">
                                        <option value="">Vendedor</option>
                                        <?php foreach($dadosVendedores as $key => $vendedor):?>
                                            <option value="<?=$vendedor->idVendedor?>" ><?=$vendedor->descNome?></option>
                                        <?php endforeach?>
                                    </select>
                                    <div class="dropdown-menu" style="max-height: 344px; overflow: hidden;">
                                        <div class="bs-searchbox">
                                            <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-5" aria-autocomplete="list" aria-activedescendant="bs-select-5-215">
                                        </div>
                                        <div class="inner show" role="listbox" id="bs-select-5" tabindex="-1" style="max-height: 273px; overflow-y: auto;">
                                            <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                                <li class="no-results">Sem resultadoss</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="    width: 200px;">
                                <input class="form-control" type="number" value="0" name="vrComissao0" id="vrComissao0" style="width: 180px;"/>
                            </td>
                        </tr>
                        <tr style="margin-top: 10px">
                            <td style="width: 200px;">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" data-live-search="true" tabindex="null" name="idVendedor1" id="idVendedor1">
                                        <option value="">Vendedor</option>
                                        <?php foreach($dadosVendedores as $key => $vendedor):?>
                                            <option value="<?=$vendedor->idVendedor?>" ><?=$vendedor->descNome?></option>
                                        <?php endforeach?>
                                    </select>
                                    <div class="dropdown-menu" style="max-height: 344px; overflow: hidden;">
                                        <div class="bs-searchbox">
                                            <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-5" aria-autocomplete="list" aria-activedescendant="bs-select-5-215">
                                        </div>
                                        <div class="inner show" role="listbox" id="bs-select-5" tabindex="-1" style="max-height: 273px; overflow-y: auto;">
                                            <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                                <li class="no-results">Sem resultadoss</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="    width: 200px;">
                                <input class="form-control" type="number" value="0" name="vrComissao1" id="vrComissao1" style="width: 180px;"/>
                            </td>
                        </tr>
                        <tr style="margin-top: 10px">
                            <td style="width: 200px;">
                                <div class="dropdown bootstrap-select form-control dropup">
                                    <select class="form-control selectpicker" data-size="7" data-live-search="true" tabindex="null" name="idVendedor2" id="idVendedor2">
                                        <option value="">Vendedor</option>
                                        <?php foreach($dadosVendedores as $key => $vendedor):?>
                                            <option value="<?=$vendedor->idVendedor?>" ><?=$vendedor->descNome?></option>
                                        <?php endforeach?>
                                    </select>
                                    <div class="dropdown-menu" style="max-height: 344px; overflow: hidden;">
                                        <div class="bs-searchbox">
                                            <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-5" aria-autocomplete="list" aria-activedescendant="bs-select-5-215">
                                        </div>
                                        <div class="inner show" role="listbox" id="bs-select-5" tabindex="-1" style="max-height: 273px; overflow-y: auto;">
                                            <ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;">
                                                <li class="no-results">Sem resultadoss</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="    width: 200px;">
                                <input class="form-control" type="number" value="0" name="vrComissao2" id="vrComissao2" style="width: 180px;"/>
                            </td>
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
                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                    <a href="<?=base_url()?>app_gerencial_vendas/"><button type="button" class="btn btn-secondary">Voltar</button></a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial_vendas/ajax_salvar",
            data: $("#form").serializeArray(),
            success : function(text){
                if(text == "success") {
                    alert("Registro salvo com sucesso!");
                    window.location.href = "<?=base_url()?>app_gerencial_vendas";
                }
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