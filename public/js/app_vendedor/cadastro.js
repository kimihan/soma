$(() => {
    let dadosVendedor;
    let hashSenha;
    let hashConfirmarSenha;
    let CPF;

    $("#fmrCadastroVendedor").submit((e) => {
        try {
            if (!validName()) return false;
            if (!validSenha()) return false;
            if (CPF.length === 11 && !validCPF(CPF)) return false;

            $("#senha").val(hashSenha.toString());

            setCookie("dadosVendedor", $(e.currentTarget).serialize(), 0.0208333);
        } catch (error) {
            console.log(error);

            return false;
        }
    });

    $("#fmrCadastroVendedorEndereco").submit((e) => {
        let handler = $(e.currentTarget);
        dadosVendedor = getCookie("dadosVendedor");
        $("#cep").val($("#cep").val().replace(/\D/g, ''));

        $.ajax({
            type: "POST",
            url: handler.attr("action"),
            data: { "dadosVendedor": dadosVendedor, "dadosVendedorEndereco": handler.serialize() },
            success: function (resp) {
                if(resp == "sucesso") {
                    setCookie("dadosVendedor", null);
                } else {
                    showModalErro("Erro ao tentar cadastrar!");
                }
            }
        });

        return false;
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

    $("#senha").keyup((e) => {
        let handler = $(e.currentTarget);

        hashSenha = CryptoJS.MD5(handler.val());
    });

    $("#confirmaSenha").keyup((e) => {
        let handler = $(e.currentTarget);

        hashConfirmarSenha = CryptoJS.MD5(handler.val());
    });

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
                } else {
                    //CEP pesquisado não foi encontrado.
                    showModalErro("CEP não encontrado!");
                }

                $("#divCarregandoCep").hide("fast", () => {
                    $("#fmrCadastroVendedorEndereco").find("input").each((k, e) => $(e).removeAttr('readonly'));
                });
            });
        }
    });

    $("#isBanca").click((e) => {
        let element = $(e.target);

        if (element[0].checked) {
            $("#divNomeBanca").show("fast");
        } else {
            $("#divNomeBanca").hide("fast");
        }
    });

    var options = {
        onKeyPress: function (cpf, ev, el, op) {
            var masks = ['000.000.000-000', '00.000.000/0000-00'];
            $('#cpfOuCnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    }

    $("#cep").mask("99.999-999");
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

    function validSenha() {
        if (hashSenha.toString() !== hashConfirmarSenha.toString()) {
            showModalErro("Senhas diferentes, favor digitar senhas novamente");
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

});