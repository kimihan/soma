$(() => {
    $("#btnFormVoltar").click(() => {
        window.history.go(-1);

        return false;
    });

    $("#fmrIdCliente").submit((e) => {
        let dados = $(e.currentTarget).serialize();

        $.post("cliente/buscar_cliente", dados, function(resp) {
            let retorno = JSON.parse(resp);

            if (retorno.erro) {
                showModalErro(retorno.erro);
            } else {
                setCookie("dadosCliente", resp, 1);
                if (retorno.Endereco_idEndereco == null) {
                    window.location = `${baseUrl}app_cliente/cliente/cadastro`;
                }
            }
        });

        return false;
    });

    if ($("#fmrCadastroClienteDados").length > 0) {
        preencherFormCadastroCliente();
    }

    if ($("#fmrCadastroClienteDadosEndereco").length > 0) {
        applyMask();
    }
});

function showModalErro(msg) {
    $("#msgErroModal").text(msg);

    $("#erroModal").modal("show");
}

function preencherFormCadastroCliente() {
    let dados = JSON.parse(getCookie("dadosCliente"));
    let valor

    Object.keys(dados).forEach(value => {
        try {
            if (value != "descNome" && value != "descEmail" && value != "dataNascimento") {
                valor = dados[value].replace(/\D/g, '');
            } else if (value == "dataNascimento") {
                valor = dados[value].split("-");
                console.log(valor);
                valor = valor[2] + valor[1] + valor[0];
            } else {
                valor = dados[value];
            }
            $(`[name=${value}]`).val(valor);
        } catch (error) {
            //console.log(error);
        }
    });

    applyMask();
}

function applyMask() {
    let options = {
        onKeyPress: function(cpf, ev, el, op) {
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            $('#cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    }

    $("#cep").mask("99.999-999");
    $("#telefone, #whatsapp").mask("(99) 99999-9999");
    $('#cpfOuCnpj').length > 11 ? $('#cpfOuCnpj').mask('00.000.000/0000-00', options) : $('#cpfOuCnpj').mask('000.000.000-00#', options);
    $("#date").mask("99/99/9999");
}