$(() => {
    $("#btnFormVoltar").click(() => {
        window.history.go(-1);

        return false;
    });

    $("#fmrIdCliente").submit((e) => {
        let dados = $(e.currentTarget).serialize();

        $.post("cliente/buscarCliente", dados, function (resp) {
            let retorno = JSON.parse(resp);

            console.log(retorno);

            if (retorno.erro) {
                $("#msgErroModal").text(retorno.erro);

                $("#erroModal").modal("show");
            }
        });

        return false;
    });
});

function showModalErro(msg) {
    $("#msgErroModal").text(msg);

    $("#erroModal").modal("show");
}