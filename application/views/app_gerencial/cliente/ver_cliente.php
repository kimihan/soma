<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="dados-tab" data-toggle="tab" href="#dados">
                <span class="nav-icon">
                    <i class="flaticon2-chat-1"></i>
                </span>
            <span class="nav-text">Dados do cliente</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="produtos-tab" data-toggle="tab" href="#produtos" aria-controls="produtos">
            <span class="nav-icon">
                <i class="flaticon2-layers-1"></i>
            </span>
            <span class="nav-text">Produtos do cliente</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="historico-tab" data-toggle="tab" href="#historico" aria-controls="historico">
            <span class="nav-icon">
                <i class="flaticon2-gear"></i>
            </span>
            <span class="nav-text">Histórico de pagamentos</span>
        </a>
    </li>
</ul>
<div class="tab-content mt-5" id="myTabContent" style="margin-top: 0px !important;">
    <div class="tab-pane active show" id="dados" role="tabpanel" aria-labelledby="dados-tab">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    <?=!empty($dadosCliente->descNome)?$dadosCliente->descNome:NULL?>
                </h3>
            </div>
            <!--begin::Form-->
            <div class="card-body col-6">
                <div class="form-group row">
                    <label  class="col-2 col-form-label">ID</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->idCliente)?$dadosCliente->idCliente:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Nome</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descNome)?$dadosCliente->descNome:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-email-input" class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descEmail)?$dadosCliente->descEmail:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-email-input" class="col-2 col-form-label">Senha</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descSenha)?$dadosCliente->descSenha:NULL?>"
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">CPF</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->numCpf)?$dadosCliente->numCpf:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">RG</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descRg)?$dadosCliente->descRg:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Data de nascimento</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->dataNascimento)?formataData($dadosCliente->dataNascimento):NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Tipo pessoa</label>
                    <div class="col-10">
                        <?=empty($dadosCliente->flgTipoPessoa) || $dadosCliente->flgTipoPessoa == "F"?"Física":"Jurídica"?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Sexo</label>
                    <div class="col-10">
                        <?=empty($dadosCliente->flgSexo) || $dadosCliente->flgSexo == "M"?"Masculino":"Feminino"?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Telefone</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->numTelefone)?$dadosCliente->numTelefone:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Whatsapp</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->numWhatsapp)?$dadosCliente->numWhatsapp:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Cep</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->numCep)?$dadosCliente->numCep:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Endereço</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descLogradouro)?$dadosCliente->descLogradouro:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Número</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->numLocal)?$dadosCliente->numLocal:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Complemento</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descComplemento)?$dadosCliente->descComplemento:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Bairro</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descBairro)?$dadosCliente->descBairro:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Cidade</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->descCidade)?$dadosCliente->descCidade:NULL?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Estado</label>
                    <div class="col-10">
                        <?=!empty($dadosCliente->siglaUf)?$dadosCliente->siglaUf:NULL?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <a href="<?=base_url()?>app_gerencial/clientes/editar"><button type="button" class="btn btn-primary  mr-2">Inserir</button></a>
                        <a href="<?=base_url()?>app_gerencial/clientes/"><button type="button" class="btn btn-secondary">Voltar</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="produtos" role="tabpanel" aria-labelledby="produtos-tab">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Produtos do cliente
                </h3>
            </div>
            <div style="padding: 0 0 0 25px;">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Produtos</th>
                        <th>Data da contratação</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produtosCliente as $key => $produto):?>
                            <tr>
                                <td><?=$produto->descNome?></td>
                                <td><?=formataData($produto->dataVenda)?></td>
                                <td>R$ <?=number_format($produto->vrPreco, 2, ",", ".")?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="historico" role="tabpanel" aria-labelledby="historico-tab">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Histórico de pagamentos
                </h3>
            </div>
            <div style="padding: 0 0 0 25px;">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Data do pagamento</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php foreach($pagamentosCliente as $key => $pagamento):?>
                                <td><?=$pagamento->descNome?></td>
                                <td><?=formataData($pagamento->dataPagamento)?></td>
                                <td>R$ <?=number_format($pagamento->vrPreco, 2, ",", ".")?></td>
                            <?php endforeach?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/clientes/ajax_salvar",
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
        $("#formCliente").submit(function(event){
            event.preventDefault();
            submitForm();
        });
    });
</script>