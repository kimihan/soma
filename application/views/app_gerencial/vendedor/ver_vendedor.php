<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="dados-tab" data-toggle="tab" href="#dados">
                <span class="nav-icon">
                    <i class="flaticon2-chat-1"></i>
                </span>
            <span class="nav-text">Dados do vendedor</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="produtos-tab" data-toggle="tab" href="#produtos" aria-controls="produtos">
            <span class="nav-icon">
                <i class="flaticon2-layers-1"></i>
            </span>
            <span class="nav-text">Produtos do vendedor</span>
        </a>
    </li>
</ul>
<div class="tab-content mt-5" id="myTabContent" style="margin-top: 0px !important;">
    <div class="tab-pane active show" id="dados" role="tabpanel" aria-labelledby="dados-tab">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    <?=!empty($dadosVendedor->descNome)?$dadosVendedor->descNome:NULL?>
                </h3>
            </div>
            <!--begin::Form-->
            <form id="formVendedor" method="post" role="form">
                <div class="card-body col-6">
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">ID</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->idCliente)?$dadosVendedor->idCliente:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Nome</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descNome)?$dadosVendedor->descNome:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descEmail)?$dadosVendedor->descEmail:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Senha</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descSenha)?$dadosVendedor->descSenha:NULL?>"
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">CPF</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->numCpf)?$dadosVendedor->numCpf:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">RG</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descRg)?$dadosVendedor->descRg:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Data de nascimento</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->dataNascimento)?$dadosVendedor->dataNascimento:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Tipo pessoa</label>
                        <div class="col-10">
                            <?=empty($dadosVendedor->flgTipoPessoa) || $dadosVendedor->flgTipoPessoa == "F"?"Física":"Jurídica"?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Sexo</label>
                        <div class="col-10">
                            <?=empty($dadosVendedor->flgSexo) || $dadosVendedor->flgSexo == "M"?"Masculino":"Feminino"?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Telefone</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->numTelefone)?$dadosVendedor->numTelefone:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Whatsapp</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->numWhatsapp)?$dadosVendedor->numWhatsapp:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Cep</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->numCep)?$dadosVendedor->numCep:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Endereço</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descLogradouro)?$dadosVendedor->descLogradouro:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Número</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->numLocal)?$dadosVendedor->numLocal:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Complemento</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descComplemento)?$dadosVendedor->descComplemento:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Bairro</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descBairro)?$dadosVendedor->descBairro:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-2 col-form-label">Cidade</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->descCidade)?$dadosVendedor->descCidade:NULL?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Estado</label>
                        <div class="col-10">
                            <?=!empty($dadosVendedor->siglaUf)?$dadosVendedor->siglaUf:NULL?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-10">
                            <a href="<?=base_url()?>app_gerencial/vendedores/editar"><button type="button" class="btn btn-primary  mr-2">Inserir</button></a>
                            <a href="<?=base_url()?>app_gerencial/vendedores/"><button type="button" class="btn btn-secondary">Voltar</button></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="tab-pane fade" id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Produtos do vendedor
                </h3>
            </div>
            <div style="padding: 0 0 0 25px;">
                <table  id="listaProdutos">
                    <tr>
                        <th>Produto</th>
                        <th>Preço de venda</th>
                        <th>% comissão</th>
                    </tr>
                    <tr style="margin-top: 10px">
                        <td style="width: 200px;">
                            <select style="height: 40px; width: 180px;">
                                <option>Produto A</option>
                            </select>
                        </td>
                        <td style="    width: 200px;">
                            <input class="form-control" type="text" value="" name="vrPreco" id="vrPreco" style="width: 180px;"/>
                        </td>
                        <td style="    width: 200px;">
                            <input class="form-control" type="text" value="" name="vrComissao" id="vrComissao" style="width: 180px;"/>
                        </td>
                    </tr>
                </table>

                <div style="width: 600px; margin-top: 20px">
                    <button type="button" class="btn btn-primary btn-lg btn-block" id="botaoAdicionar">Adicionar</button>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="col-2">
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/vendedores/ajax_salvar",
            data: $("#formCliente").serializeArray(),
            success : function(text){
                if (text == "success"){
                    formSuccess();
                }
            }
        });
    }

    function formSuccess(){
        $( "#msgSubmit" ).removeClass( "hidden" );
    }

    jQuery(function() {
        $("#formVendedor").submit(function(event){
            event.preventDefault();
            submitForm();
        });

        $("#botaoAdicionar").click(function(event){
            jQuery("#listaProdutos").append(
                '<tr style="margin-top: 10px">'+
                '<td style="width: 200px;">'+
                            '<select style="height: 40px; width: 180px;">'+
                                '<option>Produto A</option>'+
                            '</select>'+
                        '</td>'+
                        '<td style="    width: 200px;">'+
                            '<input class="form-control" type="text" value="" name="vrPreco" id="vrPreco" style="width: 180px;"/>'+
                        '</td>'+
                        '<td style="    width: 200px;">'+
                            '<input class="form-control" type="text" value="" name="vrComissao" id="vrComissao" style="width: 180px;"/>'+
                        '</td>'+
                        '</tr>'
            );
        });

        
    });
</script>