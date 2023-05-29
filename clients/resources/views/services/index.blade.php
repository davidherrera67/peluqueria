@include('layouts.header')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.semanticui.min.css">


    
    <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.uikit.min.js"></script>
    
    



    <title>servicios</title>
</head>
<body>

@include('layouts.navigation')
     <div class="container p-2 text-dark" style="margin-top:200px;">
        <h1 class="text-center">Información de los servicios</h1>
        
        @if(session('msg'))
            <div><small style="color: red;">{{ session('msg') }}</small></div>
        @endif

        @if($servicios)

        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="">
                <thead>
                    <tr>
                        <th>PRECIO</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>DURACION</th>
                    </tr>
                </thead>
                
                    @foreach($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->precio }}€</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->descripcion }}</td>
                            <td>{{ $servicio->duracion }} min</td>
                        </tr>
                    @endforeach
                
            </table>
            @else
            <div> No hay ningún servicio</div>
            @endif

            <script>
                    $(document).ready(function () {
                        $('#example').DataTable();
                    });
            </script>

        </body>
    </div>
    
</html>


@include('layouts.footer')


