let FileList = [];
$(() => {
    let dadosVenda;
    let CPF;

    $("#fmrCadastroVenda").submit((e) => {
        try {
            if (!validName()) return false;
            if (CPF.length === 11 && !validCPF(CPF)) return false;

            setCookie("dadosVenda", $(e.currentTarget).serialize(), 0.0208333);
        } catch (error) {
            showModalErro("Erro ao tentar cadastrar!");
            return false;
        }
    });

    $("#fmrCadastroVendaEndereco").submit((e) => {
        let handler = $(e.currentTarget);
        dadosVenda = getCookie("dadosVenda");
        $("#cep").val($("#cep").val().replace(/\D/g, ''));

        $.ajax({
            type: "POST",
            url: handler.attr("action"),
            data: { "dadosVenda": dadosVenda, "dadosVendaEndereco": handler.serialize() },
            success: function(resp) {
                if (resp == "sucesso") {
                    setCookie("dadosVenda", "");
                    //$("#modalSucessoCadastroVendedor").modal("show");
                } else {
                    showModalErro("Erro ao tentar cadastrar!");
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                showModalErro("Erro ao tentar cadastrar, e-mail já utilizado!");
            }
        });

        return false;
    });

    $("#btnUpload").click(() => {
        $("[name=inpFoto]").click();
    });

    $("#cpfOuCnpj").keyup((e) => {
        let handler = $(e.currentTarget);
        let cpf = handler.val();

        if (cpf.length <= 14) {
            CPF = cpf.replace(/\D/g, '');
            $("#tipoPessoa").val("F");
        } else {
            CPF = null;
            $("#tipoPessoa").val("J");
        }
    });

    $("#isCall").click((e) => {
        let element = $(e.target);

        if (element[0].checked) {
            $("#divCall").hide("fast");
        } else {
            $("#divCall").show("fast");
        }
    });

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
                } else {
                    //CEP pesquisado não foi encontrado.
                    showModalErro("CEP não encontrado!");
                }

                $("#divCarregandoCep").hide("fast", () => {
                    $("#fmrCadastroVendaEndereco").find("input").each((k, e) => $(e).removeAttr('readonly'));
                    $("#divFormEndereco").show("fast");
                });
            });
        }
    });

    var options = {
        onKeyPress: function(cpf, ev, el, op) {
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            $('#cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    }

    $("#cep").mask("99.999-999");
    $("#date").mask("99/99/9999");
    $("#telefone, #whatsapp").mask("(99) 99999-9999");
    $('#cpfOuCnpj').length > 11 ? $('#cpfOuCnpj').mask('00.000.000/0000-00', options) : $('#cpfOuCnpj').mask('000.000.000-00#', options);

    function validName() {
        let name = $("[name=descNome]").val();
        let split = name.split(" ");

        if (split.length < 2) {
            showModalErro("Nome invalido!");

            return false;
        }

        return true;
    }

    function validCPF(strCPF) {
        var Soma;
        var Resto;
        Soma = 0;
        if (strCPF == "00000000000") {
            showModalErro("CPF invalido!");
            return false;
        }

        for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(strCPF.substring(9, 10))) {
            showModalErro("CPF invalido!");

            return false;
        }

        Soma = 0;
        for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
        Resto = (Soma * 10) % 11;

        if ((Resto == 10) || (Resto == 11)) Resto = 0;
        if (Resto != parseInt(strCPF.substring(10, 11))) {
            showModalErro("CPF invalido!");
            return false;
        }
        return true;
    }

    $("[name=inpFoto]").change((e) => {
        let handler = $(e.currentTarget);
        let files = handler.get(0).files;
        let ui = $("#listUploadFotos");
        let size = 0;

        if (files.length > 3) {
            showModalErro("Máximo de três fotos por proposta");

            handler.val("");
            $("#divArquivosUpload").hide("fast");
        }

        ui.empty();

        $(files).each((key, value) => {
            ui.append(`<li class="list-group-item" id="liUpload${key}">${value.name}
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="removeUpload(${key});">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </li>`);
            FileList[key] = value;

            size = value.size + size;
        });

        if ((size / 1024 / 1024) > 15) {
            showModalErro("A soma das fotos devem ter no maximo 15 MB");
            ui.empty();

            handler.val("");
            $("#divArquivosUpload").hide("fast");
        }

        $("#divArquivosUpload").show("fast");
    });
});

function removeUpload(key) {
    if (FileList.length > 1) {
        FileList.splice(key, 1);
    } else {
        FileList.splice(-1, 1)
    }

    $(`#liUpload${key}`).hide("fast", () => {
        $(`#liUpload${key}`).remove();
    });

    return (FileList.length === 0) ? $("#divArquivosUpload").hide("fast") : false;
}