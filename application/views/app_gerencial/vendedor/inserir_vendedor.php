<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Vendedor <?=!empty($dadosVendedor->descNome)?$dadosVendedor->descNome:NULL?>
        </h3>
    </div>
    <!--begin::Form-->
    <form id="formCliente" method="post" role="form">
        <div class="card-body col-6">
            <div class="form-group row">
                <label  class="col-2 col-form-label">Nome</label>
                <div class="col-10">
                    <input class="form-control" type="hidden" value="<?=!empty($dadosVendedor->idCliente)?$dadosVendedor->idCliente:NULL?>" name="idCliente" id="idCliente"/>
                    <input class="form-control" type="hidden" value="<?=!empty($dadosVendedor->idUsuario)?$dadosVendedor->idUsuario:NULL?>" name="idUsuario" id="idUsuario"/>
                    <input class="form-control" type="hidden" value="<?=!empty($dadosVendedor->idEndereco)?$dadosVendedor->idEndereco:NULL?>" name="idEndereco" id="idEndereco"/>
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->descNome)?$dadosVendedor->descNome:NULL?>" name="descNome" id="descNome"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control required" type="email" value="<?=!empty($dadosVendedor->descEmail)?$dadosVendedor->descEmail:NULL?>" name="descEmail" id="descEmail"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Senha</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->descSenha)?$dadosVendedor->descSenha:NULL?>" name="descSenha" id="descSenha"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">CPF</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->numCpf)?$dadosVendedor->numCpf:NULL?>" name="numCpf" id="numCpf"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">RG</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->descRg)?$dadosVendedor->descRg:NULL?>" name="descRg" id="descRg"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Data de nascimento</label>
                <div class="col-10">
                    <input class="form-control required" type="date" value="<?=!empty($dadosVendedor->dataNascimento)?$dadosVendedor->dataNascimento:NULL?>" name="dataNascimento" id="dataNascimento"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Tipo pessoa</label>
                <div class="col-10">
                    <select class="form-control form-control-lg" name="flgTipoPessoa" id="flgTipoPessoa">
                        <option value="F" <?=empty($dadosVendedor->flgTipoPessoa) || $dadosVendedor->flgTipoPessoa == "F"?"selected":NULL?>>Física</option>
                        <option value="J"<?=!empty($dadosVendedor->flgTipoPessoa) && $dadosVendedor->flgTipoPessoa == "J"?"selected":NULL?>>Jurídica</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Sexo</label>
                <div class="col-10">
                    <select class="form-control form-control-lg" name="flgSexo" id="flgSexo">
                        <option value="M" <?=empty($dadosVendedor->flgSexo) || $dadosVendedor->flgSexo == "M"?"selected":NULL?>>Masculino</option>
                        <option value="F"<?=!empty($dadosVendedor->flgSexo) && $dadosVendedor->flgSexo == "F"?"selected":NULL?>>Femininno</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Telefone</label>
                <div class="col-10">
                    <input class="form-control required" type="tel" value="<?=!empty($dadosVendedor->numTelefone)?$dadosVendedor->numTelefone:NULL?>" name="numTelefone" id="numTelefone"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Whatsapp</label>
                <div class="col-10">
                    <input class="form-control" type="tel" value="<?=!empty($dadosVendedor->numWhatsapp)?$dadosVendedor->numWhatsapp:NULL?>" name="numWhatsapp" id="numWhatsapp"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Cep</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->numCep)?$dadosVendedor->numCep:NULL?>" name="numCep" id="numCep" />
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Endereço</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->descLogradouro)?$dadosVendedor->descLogradouro:NULL?>" name="descLogradouro" id="descLogradouro"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Número</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->numLocal)?$dadosVendedor->numLocal:NULL?>" name="numLocal" id="numLocal"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Complemento</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosVendedor->descComplemento)?$dadosVendedor->descComplemento:NULL?>" name="descComplemento" id="descComplemento"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Bairro</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->descBairro)?$dadosVendedor->descBairro:NULL?>" name="descBairro" id="descBairro"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Cidade</label>
                <div class="col-10">
                    <input class="form-control required" type="text" value="<?=!empty($dadosVendedor->descCidade)?$dadosVendedor->descCidade:NULL?>" name="descCidade" id="descCidade"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Estado</label>
                <div class="col-10">
                    <select class="form-control form-control-lg" name="siglaUf" id="siglaUf">
                        <option value="AC" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "AC"?"selected":NULL?>>Acre</option>
                        <option value="AL" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "AL"?"selected":NULL?>>Alagoas</option>
                        <option value="AP" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "AP"?"selected":NULL?>>Amapá</option>
                        <option value="AM" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "AM"?"selected":NULL?>>Amazonas</option>
                        <option value="BA" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "BA"?"selected":NULL?>>Bahia</option>
                        <option value="CE" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "CE"?"selected":NULL?>>Ceará</option>
                        <option value="DF" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "DF"?"selected":NULL?>>Distrito Federal</option>
                        <option value="ES" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "ES"?"selected":NULL?>>Espírito Santo</option>
                        <option value="GO" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "GO"?"selected":NULL?>>Goiás</option>
                        <option value="MA" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "MA"?"selected":NULL?>>Maranhão</option>
                        <option value="MT" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "MT"?"selected":NULL?>>Mato Grosso</option>
                        <option value="MS" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "MS"?"selected":NULL?>>Mato Grosso do Sul</option>
                        <option value="MG" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "MG"?"selected":NULL?>>Minas Gerais</option>
                        <option value="PA" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "PA"?"selected":NULL?>>Pará</option>
                        <option value="PB" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "PB"?"selected":NULL?>>Paraíba</option>
                        <option value="PR" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "PR"?"selected":NULL?>>Paraná</option>
                        <option value="PE" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "PE"?"selected":NULL?>>Pernambuco</option>
                        <option value="PI" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "PI"?"selected":NULL?>>Piauí</option>
                        <option value="RJ" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "RJ"?"selected":NULL?>>Rio de Janeiro</option>
                        <option value="RN" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "RN"?"selected":NULL?>>Rio Grande do Norte</option>
                        <option value="RS" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "RS"?"selected":NULL?>>Rio Grande do Sul</option>
                        <option value="RO" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "RO"?"selected":NULL?>>Rondônia</option>
                        <option value="RR" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "RR"?"selected":NULL?>>Roraima</option>
                        <option value="SC" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "SC"?"selected":NULL?>>Santa Catarina</option>
                        <option value="SP" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "SP"?"selected":NULL?>>São Paulo</option>
                        <option value="SE" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "SE"?"selected":NULL?>>Sergipe</option>
                        <option value="TO" <?=!empty($dadosVendedor->siglaUf) && $dadosVendedor->siglaUf == "TO"?"selected":NULL?>>Tocantins</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                    <a href="<?=base_url()?>app_gerencial_vendedores/"><button type="button" class="btn btn-secondary">Voltar</button></a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial_vendedores/ajax_salvar",
            data: $("#formCliente").serializeArray(),
            success : function(text){
                if(text == "success") {
                    alert("Registro salvo com sucesso!");
                    window.location.href = "<?=base_url()?>app_gerencial_vendedores";
                }
            }
        });
    }

    function retornaCEP(cep){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial_geral/consulta_cep/"+cep,
            data: $("#formCliente").serializeArray(),
            dataType: "json",
            success : function(resp){
                jQuery("#descLogradouro").val(resp.logradouro);
                jQuery("#descBairro").val(resp.bairro);
                jQuery("#descCidade").val(resp.localidade);
                jQuery("#siglaUf").val(resp.uf);
            }
        });
    }

    function formSuccess(){
        $( "#msgSubmit" ).removeClass( "hidden" );
    }

    jQuery(function() {
        $("#formCliente").submit(function(event){
            event.preventDefault();
            if($(this).valid()) {
                submitForm();
            }
        });

        $("#numCep").blur(function(event){
            retornaCEP($(this).val());
        });

        jQuery("#numCpf").mask("999.999.999-99");
        jQuery("#numTelefone").mask("(99)99999-9999");
        jQuery("#numWhatsapp").mask("(99)99999-9999");
    });
</script>