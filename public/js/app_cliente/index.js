$(() => {
    $("#btnFormVoltar").click(() => {
        window.history.go(-1);

        return false;
    });

    $("#fmrIdCliente").submit((e) => {
        let dados = $(e.currentTarget).serialize();

        $.post(`${baseUrl}app_cliente/cliente/buscar_cliente`, dados, function (resp) {
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
        let formaPagamento;
        let url = "";
        $("#vencimento").mask("99/9999");

        $("#nCartao").bind("keyup change", (e) => {
            let handler = $(e.currentTarget);
            let cardNumber = handler.val();

            if (cardNumber.length > 16) {
                cardNumber = cardNumber.slice(0, 16);
                handler.val(cardNumber);
            }

            if (cardNumber.length > 6) {
                getBrand(cardNumber.substring(0, 6));
            }

            if (cardNumber.length <= 5) {
                brand = null;
            }
        });

        $("[name=formaPagamento]").change((e) => {
            let handler = $(e.currentTarget);
            let aInputs = ["nCartao", "vencimento", "cvv", "nomeCartao"];
            formaPagamento = removeAcento(handler.find(":selected").text().toLowerCase());

            if (formaPagamento == "cartao de credito") {
                $("#divCartaoCredito").show("fast", () => {
                    aInputs.forEach((value) => {
                       $(`[name=${value}]`).attr("required", true);
                    });
                    $("[name=divPeriodo]").show();
                    onSenderHashReady();
                });

                url = "pre_approvals_pagseguro";
            } else {
                $("#divCartaoCredito").hide("fast", () => {
                    aInputs.forEach((value) => {
                       $(`[name=${value}]`).attr("required", false);
                    });
                    
                    $("[name=divPeriodo]").hide();
                });

                url = "cria_boletos_paghiper";
            }
        });

        $("#fmrCadastroClientePagamento").submit((e) => {
            let handler = $(e.currentTarget);
            let dados = handler.serialize();

            handler.find("input").each((k, e) => $(e).attr('disabled', true));
            handler.find("select").each((k, e) => $(e).attr('disabled', true));
            handler.find("button").each((k, e) => $(e).attr('disabled', true));

            $("#divCarregandoPagamento").show("fast", () => {
                createCardToken();
            });

            var interval = setInterval(function () {
                if (token !== null || formaPagamento != "cartao de credito") {
                    clearInterval(interval);
                    $.ajax({
                        type: "POST",
                        url: `${handler.attr("action")}/${url}`,
                        data: {"dados": dados, "hashReady": hashReady, "token": token, "sessionIdPagSeguro": sessionIdPagSeguro},
                        success: function (resp) {
                            let retorno = JSON.parse(resp);

                            if (retorno.error) {
                                showModalErro("Erro ao gerar pagamento!");
                            } else {
                                if(formaPagamento != "cartao de credito") {
                                    document.location = `${baseUrl}app_cliente/pagamento/baixarBoleto`;
                                }
                                $("#modalPagamentoSucesso").modal("show");
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            showModalErro("Erro ao gerar pagamento!");
                        }
                    });
                }
            }, 3000);

            return false;
        });

        applyMask();
    }
});

function showModalErro(msg, backdrop, keyboard) {
    $("#msgErroModal").text(msg);

    if (backdrop) {
        $("#divBtnErroModal").hide();
        $("#erroModal").modal({backdrop: backdrop, keyboard: keyboard, show: true});
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
        onKeyPress: function (cpf, ev, el, op) {
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
            $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
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

function removeAcento(text)
{
    text = text.toLowerCase();
    text = text.replace(new RegExp('[ÁÀÂÃ]', 'gi'), 'a');
    text = text.replace(new RegExp('[ÉÈÊ]', 'gi'), 'e');
    text = text.replace(new RegExp('[ÍÌÎ]', 'gi'), 'i');
    text = text.replace(new RegExp('[ÓÒÔÕ]', 'gi'), 'o');
    text = text.replace(new RegExp('[ÚÙÛ]', 'gi'), 'u');
    text = text.replace(new RegExp('[Ç]', 'gi'), 'c');
    return text;
}