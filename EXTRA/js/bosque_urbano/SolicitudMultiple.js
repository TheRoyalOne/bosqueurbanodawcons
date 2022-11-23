function fechas(){
	if ($('#chkEvento').is(':checked') == true){
		document.getElementById("fechafin").disabled = false
		document.getElementById("fechaInicio").disabled = false
		
	}else{
		document.getElementById("fechaInicio").disabled = true
		document.getElementById("fechafin").disabled = true
	}
}

$("#btnAgregar").click(function () {
	$('#agregarModificar').show();	
	var posicion = $("#agregarModificar").offset().top;
    $("html, body").animate({
        scrollTop: posicion
    }, 2000)
});

$("#btnAgregar1").click(function () {
	$('#agregarModificar').show();	
	var posicion = $("#agregarModificar").offset().top;
    $("html, body").animate({
        scrollTop: posicion
    }, 2000)
});

$("#btnRegresar").click(function () {
	$('#agregarModificar').hide();
	var posicion = "0px";
    $("html, body").animate({
        scrollTop: posicion
    }, 0000)
});

$(".nav-tabs a").click(function () {
	$(this).tab('show');
});