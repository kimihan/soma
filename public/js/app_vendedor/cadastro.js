$(() => {
    $("#fmrCadastroVendedor").submit(() => {
        if (!validName()) return false;
    });


    function validName() {
        return true;
        let name = $("[name=nomeVendedor]").val();
        let split = name.split(" ");

        if (split.length < 2) {
            showModalErro("Nome invalido!");

            return false;
        }
    }

    $("[name=isBanca]").click((e) => {
        let element = $(e.target);

        if(element[0].checked) {
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

    $('#cpfOuCnpj').length > 11 ? $('#cpfOuCnpj').mask('00.000.000/0000-00', options) : $('#cpfOuCnpj').mask('000.000.000-00#', options);

});