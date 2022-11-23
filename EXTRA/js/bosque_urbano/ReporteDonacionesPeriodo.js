
function cargarEmpresaAmodificar(cual)
{
	$('#agregarModificar').show();	
	var posicion = $("#agregarModificar").offset().top;
    $("html, body").animate({
        scrollTop: posicion
    }, 2000)
}


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

function abrirModal(){
	$('#modalColonias').modal('show');	
}
