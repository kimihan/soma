<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Cliente <?=!empty($dadosCliente->descNome)?$dadosCliente->descNome:NULL?>
        </h3>
    </div>
    <!--begin::Form-->
    <form id="formCliente" method="post" role="form">
        <div class="card-body col-6">
            <div class="form-group row">
                <label  class="col-2 col-form-label">Nome</label>
                <div class="col-10">
                    <input class="form-control" type="hidden" value="<?=!empty($dadosCliente->idCliente)?$dadosCliente->idCliente:NULL?>" name="idCliente" id="idCliente"/>
                    <input class="form-control" type="hidden" value="<?=!empty($dadosCliente->idUsuario)?$dadosCliente->idUsuario:NULL?>" name="idUsuario" id="idUsuario"/>
                    <input class="form-control" type="hidden" value="<?=!empty($dadosCliente->idEndereco)?$dadosCliente->idEndereco:NULL?>" name="idEndereco" id="idEndereco"/>
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->descNome)?$dadosCliente->descNome:NULL?>" name="descNome" id="descNome"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control" type="email" value="<?=!empty($dadosCliente->descEmail)?$dadosCliente->descEmail:NULL?>" name="descEmail" id="descEmail"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Senha</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->descSenha)?$dadosCliente->descSenha:NULL?>" name="descSenha" id="descSenha"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">CPF</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->numCpf)?$dadosCliente->numCpf:NULL?>" name="numCpf" id="numCpf"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">RG</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->descRg)?$dadosCliente->descRg:NULL?>" name="descRg" id="descRg"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Data de nascimento</label>
                <div class="col-10">
                    <input class="form-control" type="date" value="<?=!empty($dadosCliente->dataNascimento)?$dadosCliente->dataNascimento:NULL?>" name="dataNascimento" id="dataNascimento"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Tipo pessoa</label>
                <div class="col-10">
                    <select class="form-control form-control-lg" name="flgTipoPessoa" id="flgTipoPessoa">
                        <option value="M" <?=empty($dadosCliente->flgTipoPessoa) || $dadosCliente->flgTipoPessoa == "F"?"selected":NULL?>>Física</option>
                        <option value="F"<?=!empty($dadosCliente->flgTipoPessoa) && $dadosCliente->flgTipoPessoa == "J"?"selected":NULL?>>Jurídica</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Sexo</label>
                <div class="col-10">
                    <select class="form-control form-control-lg" name="flgSexo" id="flgSexo">
                        <option value="M" <?=empty($dadosCliente->flgSexo) || $dadosCliente->flgSexo == "M"?"selected":NULL?>>Masculino</option>
                        <option value="F"<?=!empty($dadosCliente->flgSexo) && $dadosCliente->flgSexo == "F"?"selected":NULL?>>Femininno</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Telefone</label>
                <div class="col-10">
                    <input class="form-control" type="tel" value="<?=!empty($dadosCliente->numTelefone)?$dadosCliente->numTelefone:NULL?>" name="numTelefone" id="numTelefone"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Whatsapp</label>
                <div class="col-10">
                    <input class="form-control" type="tel" value="<?=!empty($dadosCliente->numWhatsapp)?$dadosCliente->numWhatsapp:NULL?>" name="numWhatsapp" id="numWhatsapp"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Cep</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->numCep)?$dadosCliente->numCep:NULL?>" name="numCep" id="numCep" />
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Endereço</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->descLogradouro)?$dadosCliente->descLogradouro:NULL?>" name="descLogradouro" id="descLogradouro"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Número</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->numLocal)?$dadosCliente->numLocal:NULL?>" name="numLocal" id="numLocal"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Complemento</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->descComplemento)?$dadosCliente->descComplemento:NULL?>" name="descComplemento" id="descComplemento"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Bairro</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->descBairro)?$dadosCliente->descBairro:NULL?>" name="descBairro" id="descBairro"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-2 col-form-label">Cidade</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?=!empty($dadosCliente->descCidade)?$dadosCliente->descCidade:NULL?>" name="descCidade" id="descCidade"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="example-date-input" class="col-2 col-form-label">Estado</label>
                <div class="col-10">
                    <select class="form-control form-control-lg" name="siglaUf" id="siglaUf">
                        <option value="AC" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "AC"?"selected":NULL?>>Acre</option>
                        <option value="AL" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "AL"?"selected":NULL?>>Alagoas</option>
                        <option value="AP" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "AP"?"selected":NULL?>>Amapá</option>
                        <option value="AM" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "AM"?"selected":NULL?>>Amazonas</option>
                        <option value="BA" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "BA"?"selected":NULL?>>Bahia</option>
                        <option value="CE" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "CE"?"selected":NULL?>>Ceará</option>
                        <option value="DF" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "DF"?"selected":NULL?>>Distrito Federal</option>
                        <option value="ES" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "ES"?"selected":NULL?>>Espírito Santo</option>
                        <option value="GO" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "GO"?"selected":NULL?>>Goiás</option>
                        <option value="MA" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "MA"?"selected":NULL?>>Maranhão</option>
                        <option value="MT" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "MT"?"selected":NULL?>>Mato Grosso</option>
                        <option value="MS" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "MS"?"selected":NULL?>>Mato Grosso do Sul</option>
                        <option value="MG" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "MG"?"selected":NULL?>>Minas Gerais</option>
                        <option value="PA" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "PA"?"selected":NULL?>>Pará</option>
                        <option value="PB" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "PB"?"selected":NULL?>>Paraíba</option>
                        <option value="PR" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "PR"?"selected":NULL?>>Paraná</option>
                        <option value="PE" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "PE"?"selected":NULL?>>Pernambuco</option>
                        <option value="PI" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "PI"?"selected":NULL?>>Piauí</option>
                        <option value="RJ" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "RJ"?"selected":NULL?>>Rio de Janeiro</option>
                        <option value="RN" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "RN"?"selected":NULL?>>Rio Grande do Norte</option>
                        <option value="RS" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "RS"?"selected":NULL?>>Rio Grande do Sul</option>
                        <option value="RO" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "RO"?"selected":NULL?>>Rondônia</option>
                        <option value="RR" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "RR"?"selected":NULL?>>Roraima</option>
                        <option value="SC" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "SC"?"selected":NULL?>>Santa Catarina</option>
                        <option value="SP" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "SP"?"selected":NULL?>>São Paulo</option>
                        <option value="SE" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "SE"?"selected":NULL?>>Sergipe</option>
                        <option value="TO" <?=!empty($dadosCliente->siglaUf) && $dadosCliente->siglaUf == "TO"?"selected":NULL?>>Tocantins</option>
                    </select>
                </div>
            </div>
        </div>
        <?php if(!empty($dadosCliente->flgLigacao)):?>
            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Realizar Ligação?</label>
                <div class="col-2">
                    <input class="form-control" type="checkbox" value="<?=!empty($dadosCliente->flgLigacao)?$dadosCliente->flgLigacao:NULL?>" name="flgLigacao" id="flgLigacao"/>
                </div>
            </div>
        <?php endif?>
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success mr-2">Salvar</button>
                    <a href="<?=base_url()?>app_gerencial/clientes/"><button type="button" class="btn btn-secondary">Voltar</button></a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function submitForm(){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/clientes/ajax_salvar",
            data: $("#formCliente").serializeArray(),
            success : function(text){
                alert("Registro salvo com sucesso!");
            }
        });
    }

    function retornaCEP(cep){
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>app_gerencial/geral/consulta_cep/"+cep,
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
            submitForm();
        });

        $("#numCep").blur(function(event){
            retornaCEP($(this).val());
        });
    });
</script>