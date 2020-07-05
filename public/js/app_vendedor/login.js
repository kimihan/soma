$(() => {
    let hashSenha;

    $("#senha").keyup((e) => {
        let handler = $(e.currentTarget);

        hashSenha = CryptoJS.MD5(handler.val());
    });

    $("#fmrLoginVendedor").submit((e) => {
        let handler = $(e.currentTarget);
        try {
            $("#senha").val(hashSenha.toString());

            $.ajax({
                type: "POST",
                url: handler.attr("action"),
                data: { "dadosLogin": handler.serialize() },
                success: function(resp) {
                    if (resp == "sucesso") {
                        window.location.href = base_url + "app_vendedor/venda";
                    } else {
                        showModalErro("Erro ao tentar realizar o login!");
                    }
                }
            });
        } catch (error) {
            console.log(error);

            return false;
        }

        return false;
    });
});