$(document).ready(function() {
    var url = $('#paypal-button-pro-novalidado-container').data('url');
    var idRace = $('#idCarrera').val();
    var CIFaseg = $('#aseguradoraElegida').val();
    $.ajax({
      url: url,
      method: 'GET',
      data: {
        //Pasar el id de la carrera y de aseguradora
        idCarrera: idRace,
        CIFaseguradora: CIFaseg,
      },
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
              document.getElementById('inscripcion-pro-novalidado-form').submit();
            });
          },
          onCancel: function(data) {
            alert("Pago cancelado");
            console.log(data);
          },
          fundingSource: paypal.FUNDING.PAYPAL
        }).render('#paypal-button-pro-novalidado-container');
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });