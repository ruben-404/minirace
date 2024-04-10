paypal.Buttons({
    style:{
      color: 'blue',
      shape: 'pill',
      label: 'pay',
    },
    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: 10
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
    }
  }).render('#paypal-button-container');