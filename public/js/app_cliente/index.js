$(() => {
    $("#btnFormVoltar").click(() => {
        window.history.go(-1);

        return false;
    });

    $("#fmrIdCliente").submit((e) => {
        let dados = $(e.currentTarget).serialize();

        $.post("cliente/buscar_cliente", dados, function(resp) {
            let retorno = JSON.parse(resp);

            console.log(retorno);

            if (retorno.erro) {
                showModalErro(retorno.erro);
            }
        });

        return false;
    });
});

function showModalErro(msg) {
    $("#msgErroModal").text(msg);

    $("#erroModal").modal("show");
}