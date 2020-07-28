$(() => {
    $("#btnFormVoltar").click(() => {
        window.history.go(-1);

        return false;
    });

    $("#fmrIdCliente").submit((e) => {
        let dados = $(e.currentTarget).serialize();

        $.post(`${baseUrl}app_cliente/cliente/buscar_cliente`, dados, function(resp) {
            let retorno = JSON.parse(resp);

            if (retorno.erro) {
                showModalErro(retorno.erro);
                return false;
            }
        });
    });

    if ($("#fmrCadastroClienteDados").length > 0) {
        preencherFormCadastroCliente();
    }

    if ($("#fmrCadastroClienteDadosEndereco").length > 0) {
        applyMask();
        findCep();
    }

    if ($("#fmrCadastroClientePagamento").length > 0) {
        applyMask();
    }
});

function showModalErro(msg, backdrop, keyboard) {
    $("#msgErroModal").text(msg);

    if (backdrop) {
        $("#divBtnErroModal").hide();
        $("#erroModal").modal({ backdrop: backdrop, keyboard: keyboard, show: true });
        return false;
    }

    $("#erroModal").modal("show");
}

function preencherFormCadastroCliente() {
    let dados = JSON.parse($("#dadosCliente").val());
    let valor

    Object.keys(dados).forEach(value => {
        try {
            if (value != "descNome" && value != "descEmail" && value != "dataNascimento") {
                valor = dados[value].replace(/\D/g, '');
            } else if (value == "dataNascimento") {
                valor = dados[value].split("-");
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
    $("#dadosCliente").remove();
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

function findCep() {
    $("#cep").keyup((e) => {
        let handler = $(e.currentTarget);
        let tam = handler.val().length;
        let cep = handler.val().replace(/\D/g, '');

        if (tam === 10) {
            handler.attr("readonly", true);
            $("#divCarregandoCep").show("fast");

            //Consulta o webservice viacep.com.br/
            $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#logradouro").val(dados.logradouro);
                    $("#bairro").val(dados.bairro);
                    $("#localidade").val(dados.localidade);
                    $("#uf").val(dados.uf);

                    $("#isCall").attr("disabled", true);
                } else {
                    //CEP pesquisado não foi encontrado.
                    showModalErro("CEP não encontrado!");
                }

                $("#divCarregandoCep").hide("fast", () => {
                    $("#fmrCadastroClienteDadosEndereco").find("input").each((k, e) => $(e).removeAttr('readonly'));
                    $("#divFormEndereco").show("fast");
                });
            });
        }

        if (cep == "") {
            $("#isCall").removeAttr("disabled", true);
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#localidade").val("");
            $("#uf").val("");
        }
    });
}