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
    });
</script>