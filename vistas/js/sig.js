$(document).ready(function() {
    $("#similares").hide();
    $("#fuente").hide();
    $("#riesgos").hide();
    $("#correccion").hide();


    $("#nc_similar").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#similares").show();
      } else {
        $("#similares").hide();
      }
    });
    $("#fuente_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Otros") {
        $("#fuente").show();
      } else {
        $("#fuente").hide();
      }
    });
    $("#riesgo_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "Si") {
        $("#riesgos").show();
      } else {
        $("#riesgos").hide();
      }
    });
    $("#tipo_acpm").change(function() {
      var seleccion = $(this).val();

      if (seleccion === "AC" || seleccion === "AP") {
        $("#correccion").show();
      } else {
        $("#correccion").hide();
      }
    });
  });