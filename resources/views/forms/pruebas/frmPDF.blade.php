<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>Laravel y data en PDF | Rimorsoft Online</title>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                	<h1 class="page-header">Listado de productos</h1>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Stock</th>
                                </tr>                            
                            </thead>
                            <tbody>
                                @foreach($clientes as $datos)
                                <tr>
                                    <td>{{ $datos->idcliente }}</td>
                                    <td>{{ $datos->nombres }}</td>
                                    <td>{{ $datos->estado }}</td>
                                    <td class="text-right">{{ $datos->apaterno }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <p>
                            <a href="{{ route('products.pdf') }}" class="btn btn-sm btn-primary">
                                Descargar productos en PDF
                            </a>
                        </p>
                </div>
            </div>
        </div>
    </body>
</html>