
<div id="divCamposCadastroEnderecoCliente">
    <div class="form-row justify-content-center align-self-center">
        <div class="col-12 mb-2" id="divCep">
            <input type="text" class="form-control" name="numCep" value="" required placeholder="CEP" id="cep" maxlength="10" autocomplete="nofill">
        </div>
        <div class="col-12 mb-2" style="display: none;" id="divCarregandoCep">
            <button class="btn btn-primary btn-block btn-not-default" type="button" disabled id="btnCarregando" >
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Carregando...
            </button>
        </div>               
    </div>
    <div id="divFormEndereco" style="display: none;">
        <div class="form-row justify-content-center align-self-center">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" name="descLogradouro" id="logradouro" value="" required placeholder="Logradouro" readonly>
            </div>
        </div>
        <div class="form-row justify-content-center align-self-center">
            <div class="col-12 mb-2">
                <input type="number" class="form-control" name="numLocal" value="" placeholder="Numero" readonly required>
            </div>
        </div>
        <div class="form-row justify-content-center align-self-center">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" name="descComplemento" value="" placeholder="Complemento" readonly autocomplete="off">
            </div>
        </div>
        <div class="form-row justify-content-center align-self-center">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" name="descBairro" id="bairro" value="" required placeholder="Bairro" readonly>
            </div>
        </div>
        <div class="form-row justify-content-center align-self-center">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" name="descCidade" id="localidade" value="" required placeholder="Cidade" readonly>
            </div>
        </div>
        <div class="form-row justify-content-center align-self-center">
            <div class="col-12 mb-2">
                <input type="text" class="form-control" name="siglaUf" id="uf" value="" required placeholder="Estado" maxlength="2" readonly>
            </div>
        </div>
    </div>
</div>