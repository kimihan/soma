<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Cobrança
        </h3>
    </div>
    <!--begin::Form-->
    <form id="form" method="post" role="form">
        <div class="card-body col-6">
            <div class="form-group row">
                <label  class="col-2 col-form-label">Cliente</label>
                <div class="col-8">
                    <div class="dropdown bootstrap-select form-control dropup">
                        <select class="form-control selectpicker" data-size="7" data-live-search="true" tabindex="null" name="Cliente_idCliente" id="Cliente_idCliente">
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
                <label  class="col-2 col-form-label">Serviço</label>
                <div class="col-8">
                    <div class="dropdown bootstrap-select form-control dropup">
                        <select class="form-control selectpicker" tabindex="null" name="Servico_idServico" id="Servico_idServico">
                            <option>Selecione o Cliente</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Data da Vencimento</label>
                <div class="col-8">
                    <input class="form-control required" type="date" value="" name="dataVencimento" id="dataVencimento"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Data de Pagamento</label>
                <div class="col-8">
                    <input class="form-control" type="date" value="" name="dataPagamento" id="dataPagamento"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Preço</label>
                <div class="col-8">
                    <input class="form-control required" type="text" value="" name="vrPreco" id="vrPreco" class="required" />
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Cobrança Paga?</label>
                <div class="col-8">
                    <div class="dropdown bootstrap-select form-control dropup">
                        <select class="form-control selectpicker" tabindex="null" name="flgPago" id="flgPago">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
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
            url: "<?=base_url()?>app_gerencial/cobrancas/ajax_salvar",
            data: $("#form").serializeArray(),
            success : function(text){
                alert("Registro salvo com sucesso!");
                window.location.href = "<?=base_url()?>app_gerencial/cobrancas";
            }
        });
    }

    function retornaServicosCliente(idCliente){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/cobrancas/ajax_servicos_cliente",
            data: {"idCliente":idCliente},
            dataType: "json",
            success : function(resp){
                var html = "";
                jQuery.each(resp, function (key, val) {
                    console.log(val);
                    html += "<option value='"+val.idServico+"' vrPreco='"+val.vrPreco+"'>"+val.nomeProduto+"</option>";
                });

                jQuery("#Servico_idServico").html(html);
                jQuery("#Servico_idServico").selectpicker('refresh');

                retornaPrecoServico(jQuery("#Servico_idServico").val());
            }
        });
    }

    function retornaPrecoServico(idServico){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/cobrancas/ajax_preco_servico",
            data: {"idServico":idServico},
            dataType: "json",
            success : function(resp){
                jQuery("#vrPreco").val(resp.vrPreco);
            }
        });
    }

    function formSuccess(){
        $( "#msgSubmit" ).removeClass( "hidden" );
    }

    jQuery(function() {
        $("#Cliente_idCliente").change(function() {
            retornaServicosCliente(jQuery(this).val());
        });

        $("#Servico_idServico").change(function() {
            retornaPrecoServico(jQuery(this).val());
        });

        $("#form").submit(function(event){
            event.preventDefault();
            if($(this).valid()) {
                submitForm();
            }
        });
    });
</script>