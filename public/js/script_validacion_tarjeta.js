var owner = $('#owner'),
    cardNumber = $('#cardNumber'),
    cardNumberField = $('#card-number-field'),
    CVV = $("#cvv"),
    expiry= $("#expiry");
    mastercard = $("#mastercard"),
    confirmButton = $('#confirm-purchase'),
    visa = $("#visa"),
    amex = $("#amex");

cardNumber.payform('formatCardNumber');
CVV.payform('formatCardCVC');
expiry.payform('formatCardExpiry');

cardNumber.keyup(function() {
    if ($.payform.validateCardNumber(cardNumber.val()) == false) {
        cardNumber.css("box-shadow","0px 0px 2px 2px rgba(235,14,14,0.1)");
        cardNumber.css("border-color","rgba(235,14,14,0.4)");
        $("#validez-numero").html("<input type='text' style='display: none;' value='0' name='validez_numero' readonly>");
    } else {
        cardNumber.css("box-shadow","0px 0px 2px 2px rgba(0,120,2,0.1)");
        cardNumber.css("border-color","rgba(0,120,2,0.4)");
        $("#validez-numero").html("<input type='text' style='display: none;' value='1' name='validez_numero' readonly>");
    }

    if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
        visa.css('display', 'block');
        amex.css('display', 'none');
        mastercard.css('display', 'none');
    } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
        visa.css('display', 'none');
        amex.css('display', 'block');
        mastercard.css('display', 'none');
    } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
        visa.css('display', 'none');
        amex.css('display', 'none');
        mastercard.css('display', 'block');
    }
});

CVV.keyup(function() {
    var isCvvValid = $.payform.validateCardCVC(CVV.val());
    if (!isCvvValid) {
        CVV.css("box-shadow","0px 0px 2px 2px rgba(235,14,14,0.1)");
        CVV.css("border-color","rgba(235,14,14,0.4)");
        $("#validez-cvv").html("<input type='text' style='display: none;' value=0 name='validez_cvv' readonly>");
    } else {
        CVV.css("box-shadow","0px 0px 2px 2px rgba(0,120,2,0.1)");
        CVV.css("border-color","rgba(0,120,2,0.4)");
        $("#validez-cvv").html("<input type='text' style='display: none;' value=1 name='validez_cvv' readonly>");
    }
});

owner.keyup(function() {
    if (owner.val().length < 5) {
        owner.css("box-shadow","0px 0px 2px 2px rgba(235,14,14,0.1)");
        owner.css("border-color","rgba(235,14,14,0.4)");
        $("#validez-nombre").html("<input type='text' style='display: none;' value=0 name='validez_nombre' readonly>");
    } else {
        owner.css("box-shadow","0px 0px 2px 2px rgba(0,120,2,0.1)");
        owner.css("border-color","rgba(0,120,2,0.4)");
        $("#validez-nombre").html("<input type='text' style='display: none;' value=1 name='validez_nombre' readonly>");
    }
});

expiry.keyup(function() {
    var month =$.payform.parseCardExpiry(expiry.val()).month;
    var year =$.payform.parseCardExpiry(expiry.val()).year;

    if ($.payform.validateCardExpiry(month, year) == false) {
        expiry.css("box-shadow","0px 0px 2px 2px rgba(235,14,14,0.1)");
        expiry.css("border-color","rgba(235,14,14,0.4)");
        $("#validez-fecha").html("<input type='text' style='display: none;' value=0 name='validez_fecha' readonly>");
    } else {
        expiry.css("box-shadow","0px 0px 2px 2px rgba(0,120,2,0.1)");
        expiry.css("border-color","rgba(0,120,2,0.4)");
        $("#validez-fecha").html("<input type='text' style='display: none;' value=1 name='validez_fecha' readonly>");
        $("#mes").html("<input type='text' style='display: none;' value='"+month+"' name='mes' readonly>");
        $("#año").html("<input type='text' style='display: none;' value='"+year+"' name='año' readonly>");
    }
});



confirmButton.click(function(e) {
    e.preventDefault();

    var isCardValid = $.payform.validateCardNumber(cardNumber.val());
    var isCvvValid = $.payform.validateCardCVC(CVV.val());

    if(!isCardValid){
        alert("Ingrese un número válido");
    } else if (!isCvvValid) {
        alert("Ingrese un CVV válido");
    } else if (owner.val().length < 5) {
        alert("Ingrese un nombre válido");
    } else {
        document.getElementById("form-pago").submit();
    }
});