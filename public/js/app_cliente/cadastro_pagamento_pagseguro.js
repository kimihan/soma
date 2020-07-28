let brand = null;
$(() => {
    //https://dev.pagseguro.uol.com.br/reference/checkout-transparente

    PagSeguroDirectPayment.setSessionId(sessionIdPagSeguro);

    PagSeguroDirectPayment.getPaymentMethods({
        amount: 500.00,
        success: function(response) {
            if (!response.paymentMethods.CREDIT_CARD) {
                showModalErro("Erro nas formas de pagamento, favor entrar em contato com o suporte!", "static", false);
            }
        },
        error: function(response) {
            showModalErro("Erro nas formas de pagamento, favor entrar em contato com o suporte!", "static", false);
        },
        complete: function(response) {
            //console.log(response);
        }
    });

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
        let option = handler.find(":selected").text();

        if (option == "Cartão de crédito") {
            $("#divCartaoCredito").show("fast");
        } else {
            $("#divCartaoCredito").hide("fast");
        }
    });
});

function onSenderHashReady() {
    PagSeguroDirectPayment.onSenderHashReady(function(response) {
        if (response.status == 'error') {
            console.log(response.message);
            return false;
        }
        var hash = response.senderHash; //Hash estará disponível nesta variável.
    });
}

function getBrand(cardNumber) {
    if (brand == null) {
        PagSeguroDirectPayment.getBrand({
            cardBin: cardNumber,
            success: function(response) {
                brand = response;
            },
            error: function(response) {
                showModalErro("Cartão invalido!");
            },
            complete: function(response) {
                //console.log(response);
            }
        });
    }
}

function createCardToken() {
    if (brand.error) return false;

    PagSeguroDirectPayment.createCardToken({
        cardNumber: '4111111111111111', // Número do cartão de crédito
        brand: 'visa', // Bandeira do cartão
        cvv: '013', // CVV do cartão
        expirationMonth: '12', // Mês da expiração do cartão
        expirationYear: '2026', // Ano da expiração do cartão, é necessário os 4 dígitos.
        success: function(response) {
            // Retorna o cartão tokenizado.
        },
        error: function(response) {
            // Callback para chamadas que falharam.
        },
        complete: function(response) {
            // Callback para todas chamadas.
        }
    });
}