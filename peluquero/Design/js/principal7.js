/* ============ datatables bootstrap 5 ============== */
$(document).ready(function () {
    $('#tablabootstrap5').DataTable({
        language: {
            url:'https:////cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    });
});


/* ============ toogle titulo ============== */
	
$(function () 
{
	$('[data-toggle="tooltip"]').tooltip();
});


/*
   cancelar cita del appointments al hacer clikc al boton va aqui y
   de aqui se abre el appointments_ajax donde hace el cancelar cita
*/

$('.btn_cancelar_cita').click(function()
{

    var id_cita = $(this).data('id');
    var motivo_cancelacion = $('#motivo_cancelacion_cita_'+id_cita).val();
    var accion_ = 'Cancelar Cita';


    $.ajax({
        url: "ajax_files/appointments_ajax.php",
        type: "POST",
        data:{accion:accion_,id_cita:id_cita,motivo_cancelacion:motivo_cancelacion},
        success: function (data) 
        {
            //Hide Modal
            $('#cancelar_cita_'+id_cita).modal('hide');
            
            //Show Success Message
            swal("Cancelación de cita","La cita ha sido cancelada exitosamente!", "success").then((value) => 
            {
                window.location.replace("index.php");
            });
            
        },
        error: function(xhr, status, error) 
        {
            alert('ERROR AL MANDAR LA REQUEST');
        }
      });
});


$('.btn_endeudar_cita').click(function()
{

    var id_cita = $(this).data('id');
    var motivo_endeudacion = $('#motivo_endeudacion_cita_'+id_cita).val();
    var accion_ = 'Endeudar Cita';


    $.ajax({
        url: "ajax_files/appointments_ajax.php",
        type: "POST",
        data:{accion:accion_,id_cita:id_cita,motivo_endeudacion:motivo_endeudacion},
        success: function (data) 
        {
            //Hide Modal
            $('#endeudar_cita_'+id_cita).modal('hide');
            
            //Show Success Message
            swal("Endeudación de cita","La cita ha sido endeudada exitosamente!", "success").then((value) => 
            {
                window.location.replace("index.php");
            });
            
        },
        error: function(xhr, status, error) 
        {
            alert('ERROR AL MANDAR LA REQUEST');
        }
      });
});






/*
   agregar categoria nueva
*/


$('#btn_agregar_categoria').click(function()
{
    var nombre_categoria = $("#input_nombre_categoria").val();
    var accion_ = "Agregar";

    if($.trim(nombre_categoria) == "")
    {
        $('#nombre_categoria_necesario').css('display','block');
    }
    else
    {
        $.ajax(
        {
            url:"ajax_files/services_category_ajax.php",
            method:"POST",
            data:{nombre_categoria:nombre_categoria,accion:accion_},
            dataType:"JSON",
            success: function (data) 
            {
                if(data['alerta'] == "Advertencia")
                {
                    swal("Alerta",data['mensaje'], "warning").then((value) => {});
                }
                if(data['alerta'] == "Exito")
                {
                    $('#agregar_nueva_categoria').modal('hide');
                    swal("Nueva categoria",data['mensaje'], "success").then((value) => 
                    {
                        window.location.replace("service-categories.php");
                    });
                }
                
            },
            error: function(xhr, status, error) 
            {
                alert('ERROR AL MANDAR LA REQUEST categoria');
            }
        });
    }
});


/*
 borrar categoria
*/



$('.btn_borrar_categoria').click(function()
{
    var id_categoria = $(this).data('id');
    var accion_ = "Borrar";

    $.ajax(
    {
        url:"ajax_files/services_category_ajax.php",
        method:"POST",
        data:{id_categoria:id_categoria,accion:accion_},
        dataType:"JSON",
        success: function (data) 
        {
            if(data['alerta'] == "Advertencia")
                {
                    swal("Advertencia",data['mensaje'], "warning").then((value) => {});
                }
                if(data['alerta'] == "Exito")
                {
                    swal("Categoría eliminada",data['mensaje'], "success").then((value) => 
                    {
                        window.location.replace("service-categories.php");
                    });
                }     
        },
        error: function(xhr, status, error) 
        {
            alert(error);
        }
      });
});
/*
 editar categoria
*/

$('.btn_editar_categoria').click(function()
{
    var id_categoria = $(this).data('id');
    var nombre_categoria = $("#input_nombre_categoria_"+id_categoria).val();

    var accion_ = "Editar";

    if($.trim(nombre_categoria) == "")
    {
        $('#entrada_incorrecta_'+id_categoria).css('display','block');
    }
    else
    {
        $.ajax(
        {
            url:"ajax_files/services_category_ajax.php",
            method:"POST",
            data:{id_categoria:id_categoria,nombre_categoria:nombre_categoria,accion:accion_},
            dataType:"JSON",
            success: function (data) 
            {
                if(data['alerta'] == "Advertencia")
                {
                    swal("Advertencia!",data['mensaje'], "warning").then((value) => {});
                }
                if(data['alerta'] == "Exito")
                {
                    swal("Categoria Actualizada!",data['mensaje'], "success").then((value) => 
                    {
                        window.location.replace("service-categories.php");
                    });
                }     
            },
            error: function(xhr, status, error) 
            {
                alert(error);
            }
        });
    }
});


/*
   eliminar servicio
*/


$('.borrar_servicio_btn').click(function()
{
    var id_servicio = $(this).data('id');
    var accion_ = "Borrar";

    $.ajax(
    {
        url:"ajax_files/services_ajax.php",
        method:"POST",
        data:{id_servicio:id_servicio,accion:accion_},
        success: function (data) 
        {
            swal("Servicio eliminado!","El servicio ha sido eliminado exitosamente de la base de datos de la peluqueria dacor!", "success").then((value) => {
                window.location.replace("services.php");});     
        },
        error: function(xhr, status, error) 
        {
            alert('ERROR AL LANZAR LA REQUEST');
        }
      });
});



/*
    borrar peluquero
*/


 $('.borrar_peluquero_btn').click(function()
{
    var id_peluquero = $(this).data('id');
    var accion_ = "Borrar";

    $.ajax(
    {
        url:"ajax_files/hairdresser_ajax.php",
        method:"POST",
        data:{id_peluquero:id_peluquero,accion:accion_},
        success: function (data) 
        {
            swal("Borrando Peluquero","El peluquero ha sido eliminado de la base de datos exitosamente!", "success").then((value) => {
                window.location.replace("hairdressers.php");});     
        },
        error: function(xhr, status, error) 
        {
            alert('ERROR AL LANZAR LA REQUEST');
        }
    });
});




/*
    cerrar caja
    cancelar cita del appointments al hacer clikc al boton va aqui y
    de aqui se abre el appointments_ajax donde hace el cancelar cita
*/

$('.btn_cerrar_caja').click(function()
{
    /* pasarle aqui los $_SESSION['saldoFinal'],$_SESSION['caja'])); y meterlos desde aqui como  en el cancelar cita de arriba 
    asi: guardandolo en una variable. recoger esa variable desde el boxs_ajax.php
    var motivo_cancelacion = $('#motivo_cancelacion_cita_'+id_cita).val(); */

    var id_caja = $(this).data('id');
    var saldo_final = $('#cerrar_'+id_caja).val();
    
    var accion_ = 'Cerrar Caja';


    $.ajax({
        url: "ajax_files/boxs_ajax.php",
        type: "POST",
        data:{accion:accion_,id_caja:id_caja,saldo_final:saldo_final},
        success: function (data) 
        {
            //Hide Modal
            $('#cerrar_caja_'+id_caja).modal('hide');
            
            //Show Success Message
            swal("Caja cerrada","La caja ha sido cerrado exitosamente!", "success").then((value) => 
            {
                window.location.replace("boxs.php");
            });
            
        },
        error: function(xhr, status, error) 
        {
            alert('ERROR AL MANDAR LA REQUEST');
        }
      });
});


/*
   check mostrar horario
*/


$(".sb-dia-horario-switch").click(function()
{
    if(!$(this).prop('checked'))
    {
        $(this).closest('div.dia-horario').children(".tiempo_").css('display','none');
    }
    else
        $(this).closest('div.dia-horario').children(".tiempo_").css('display','flex');
});