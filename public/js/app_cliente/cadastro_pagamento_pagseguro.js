var brand = null;
var hashReady = null;
var token = null;
var codePreApproval = null;
$(() => {
    //https://dev.pagseguro.uol.com.br/reference/api-recorrencia

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
});

function onSenderHashReady() {
    PagSeguroDirectPayment.onSenderHashReady(function(response) {
        if (response.status == 'error') {
            showModalErro("Erro nas formas de pagamento, favor entrar em contato com o suporte!", "static", false);
        } else {
            hashReady = response.senderHash;
        }
        return false;
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

    let split = $("#vencimento").val().split("/");

    PagSeguroDirectPayment.createCardToken({
        cardNumber: $("#nCartao").val(), // Número do cartão de crédito
        brand: brand.name, // Bandeira do cartão
        cvv: $("#cvv").val(), // CVV do cartão
        expirationMonth: split[0], // Mês da expiração do cartão
        expirationYear: split[1], // Ano da expiração do cartão, é necessário os 4 dígitos.
        success: function(response) {
            token = response.card.token;
        },
        error: function(response) {
            showModalErro("Token invalido!");
        },
        complete: function(response) {}
    });
}