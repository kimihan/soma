let FileList = [];
let formData = new FormData();
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
        try {
            $("[name=divCadastrarVenda]").hide("fast", () => {
                $("button, #isCall, input").attr("disabled", true);
                $("#divCarregandoVenda").show("fast");
            });

            let handler = $(e.currentTarget);
            dadosVenda = getCookie("dadosVenda");
            $("#cep").val($("#cep").val().replace(/\D/g, ''));

            if (FileList.length === 0) {
                showModalErro("Favor anexar foto da proposta!");
                return false;
            }

            FileList.forEach((value, key) => {
                formData.append(`file_${key}`, value);
            });

            formData.append('dadosVenda', dadosVenda);
            formData.append('dadosVendaEndereco', $("#fmrCadastroVendaEndereco").serialize());

            $.ajax({
                url: handler.attr("action"),
                data: formData,
                processData: false,
                contentType: false,
                type: "POST",
                success: function(resp) {
                    let retorno = JSON.parse(resp);
                    if (retorno["sucesso"] == "sucesso") {
                        setCookie("dadosVenda", "");
                        $("#spanIdVenda").text(retorno["idServico"]);
                        $("#modalSucessoCadastroVenda").modal("show");
                    } else {
                        showModalErro("Falha ao tentar cadastrar!");
                        escondeCarregando();
                    }
                },
                xhr: function() { // Custom XMLHttpRequest
                    let myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                        myXhr.upload.addEventListener('progress', function() {
                            //console.log(myXhr);
                        }, false);
                    }
                    return myXhr;
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    showModalErro("Falha ao tentar cadastrar!");
                    escondeCarregando();
                }
            });

            return false;
        } catch (error) {
            showModalErro("Falha ao tentar cadastrar!");
            escondeCarregando();

            return false;
        }
    });

    $("#btnUpload").click(() => {
        $("#inpFoto").click();
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

            $("#divCamposCadastroEnderecoCliente").find("input").removeAttr("required");

        } else {
            $("#divCall").show("fast");

            $("#divCamposCadastroEnderecoCliente").find("input").attr("required", true);
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

                    $("#isCall").attr("disabled", true);
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

        if (cep == "") {
            $("#isCall").removeAttr("disabled", true);
            $("#logradouro").val("");
            $("#bairro").val("");
            $("#localidade").val("");
            $("#uf").val("");
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

    $("#inpFoto").change((e) => {
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
    $(`#liUpload${key}`).hide("fast", () => {
        $(`#liUpload${key}`).remove();
    });

    if (FileList.length > 1) {
        FileList.splice(key, 1);
    } else {
        FileList.splice(-1, 1);
        $("#divArquivosUpload").hide("fast", () => {
            $("#inpFoto").val("");
        });
    }

    return FileList;
}

function escondeCarregando() {
    $("[name=divCadastrarVenda]").show("fast", () => {
        $("button, #isCall, input").attr("disabled", false);
        $("#divCarregandoVenda").hide("fast");
    });
}