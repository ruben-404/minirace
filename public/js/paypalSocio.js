$(document).ready(function() {
  var url = $('#paypal-button-socio-container').data('url');
  $.ajax({
    url: url,
    method: 'GET',
    success: function(response) {
      paypal.Buttons({
        style:{
          color: 'gold',
          shape: 'pill',
          label: 'pay',
        },
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: response.price
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          actions.order.capture().then(function (details){
            console.log(details)
            document.getElementById('registrar-socio-form').submit();
          });
        },
        onCancel: function(data) {
          alert("Pago cancelado");
          console.log(data);
        },
        fundingSource: paypal.FUNDING.PAYPAL
      }).render('#paypal-button-socio-container');
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
});