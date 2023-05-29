

/* información sobre herramientas mediante toogle */
	
$(function () 
{
	$('[data-toggle="tooltip"]').tooltip();
});

/* validar Correo */

function validarCorreo(correo)
{
    if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(correo))
    {
        return (true);
    }
    return (false);
}

/* validar Telefono */

function validarTelefono(texto)
{
    var telefono = /^\d{9}$/;
    if(texto.match(telefono))
    {
        return true;
    }
    else
    {
        return false;
    }
}

                              

/* navegacion mobile mediante toogle*/

$(".mob-menu-toggle").click(function()
{
	$("#menu_mobile").toggleClass("active");
});

$('.mob-close-toggle').click(function() 
{
	$("#menu_mobile").removeClass("active"); 
});

$('.a-mob-menu').click(function()
{
    $("#menu_mobile").removeClass("active"); 
});


/* checkbox checktoggle*/

$('.servicio_label').click(function() 
{
    $(this).button('toggle');
}); 

/* modificado metodo showTab de https://www.w3schools.com/howto/howto_js_form_steps.asp*/

var tabActual = 0;
mostrarTab(tabActual);

function mostrarTab(n) 
{
    var x = document.getElementsByClassName("tab_reserva");

    if(x[0] == null)
    {
        return;
    }
    x[n].style.display = "block";
    
    if (n == 0) 
    {
        document.getElementById("prevBtn").style.display = "none";
    }
    else 
    {
        document.getElementById("prevBtn").style.display = "inline";
    }

    if (n == (x.length - 1)) 
    {
        document.getElementById("nextBtn").innerHTML = "Enviar";
    }
    else 
    {
        document.getElementById("nextBtn").innerHTML = "Siguiente";
    }

    indicadorPaso(n);
}

/* modificado metodo nextPrev de https://www.w3schools.com/howto/howto_js_form_steps.asp */

function nextPrev(n) 
{
    var x = document.getElementsByClassName("tab_reserva");

    if (n == 1 && !validarForm()) return false;
    x[tabActual].style.display = "none";
    tabActual = tabActual + n;

    if (tabActual >= x.length) 
    {
        document.getElementById("form_cita").submit();
        return false;
    }
    
    mostrarTab(tabActual);
}



/* modificado metodo validateForm de https://www.w3schools.com/howto/howto_js_form_steps.asp */

function validarForm() 
{
    var x, id_tab, valid = true;
    x = document.getElementsByClassName("tab_reserva");
    id_tab = x[tabActual].id;

    if(id_tab == "services_tab")
    {
        if(x[tabActual].querySelectorAll('input[type="checkbox"]:checked').length == 0)
        {
            x[tabActual].getElementsByClassName("alert")[0].style.display = "block";
            valid = false;
        }
        else
        {
            x[tabActual].getElementsByClassName("alert")[0].style.display = "none";
        }
    }

    if(id_tab == "hairdresser_tab")
    {
        if(x[tabActual].querySelectorAll('input[type="radio"]:checked').length == 0)
        {
            x[tabActual].getElementsByClassName("alert")[0].style.display = "block";
            valid = false;
        }
        else
        {
            x[tabActual].getElementsByClassName("alert")[0].style.display = "none";

            var servicios_seleccionados = [];

            $("input[name='servicios_seleccionados[]']:checked").each(function(){
                servicios_seleccionados.push($(this).val());
            })


            var peluquero_seleccionado = $("input[name='peluquero_seleccionado']:checked").val();

            $.ajax(
            {

                url:"calendar.php",
                method:"POST",
                data:{servicios_seleccionados:servicios_seleccionados,peluquero_seleccionado:peluquero_seleccionado},
                success: function (data) 
                {
                    $('#calendario_tab_dentro').html(data);
                },
                beforeSend: function()
                {
                    $('#cargando_calendario').show();
                },
                complete: function()
                {
                    $('#cargando_calendario').hide();
                },
                error: function(xhr, status, error) 
                {
                    alert('AN ERROR HAS BEEN ENCOUNTERED WHILE TRYING TO EXECUTE YOUR REQUEST');
                }
            });

        }
    }

    if(id_tab == "calendario_tab")
    {
        if(x[tabActual].querySelectorAll('input[type="radio"]:checked').length == 0)
        {
            x[tabActual].getElementsByClassName("alert")[0].style.display = "block";
            valid = false;
        }
        else
        {
            x[tabActual].getElementsByClassName("alert")[0].style.display = "none";
        }
    }

    if(id_tab == "cliente_tab")
    {
        var cliente_nombre = $('#cliente_nombre').val();
        var cliente_apellido = $('#cliente_apellido').val();
        var cliente_correo = $('#cliente_correo').val();
        var cliente_telefono = $('#cliente_telefono').val();

        if($.trim(cliente_nombre) == "")
        {
            $('#cliente_nombre').css("border", "3px solid #d9b430");
            $("#cliente_nombre ~ span").css("display", "block");
            valid = false;
        }
        else
        {
            $('#cliente_nombre').css("border", "0px");
            $("#cliente_nombre ~ span").css("display", "none");

            if($.trim(cliente_apellido) == "")
            {
                $('#cliente_apellido').css("border", "2px solid #d9b430");
                $("#cliente_apellido ~ span").css("display", "block");
                valid = false;
            }
            else
            {
                $('#cliente_apellido').css("border", "0px");
                $("#cliente_apellido ~ span").css("display", "none");

                if(!validarCorreo(cliente_correo))
                {
                    $('#cliente_correo').css("border", "3px solid #d9b430");
                    $("#cliente_correo ~ span").css("display", "block");
                    valid = false;
                }
                else
                {
                    $('#cliente_correo').css("border", "0px");
                    $("#cliente_correo ~ span").css("display", "none");

                    if(!validarTelefono(cliente_telefono))
                    {
                        $('#cliente_telefono').css("border", "3px solid #d9b430");
                        $("#cliente_telefono ~ span").css("display", "block");
                        valid = false;
                    }
                    else
                    {
                        $('#cliente_telefono').css("border", "0px");
                        $("#cliente_telefono ~ span").css("display", "none");
                    }
                }
            }
        }
    }

    if (valid) 
    {
        document.getElementsByClassName("paso")[tabActual].className += " fin";
    }
    
    return valid;
}
/* modificado metodo fixStepIndicator de https://www.w3schools.com/howto/howto_js_form_steps.asp */
function indicadorPaso(n) 
{
    var i, x = document.getElementsByClassName("paso");
    for (i = 0; i < x.length; i++)
    {
        x[i].className = x[i].className.replace(" active", "");
    }

    x[n].className += " active";
}


