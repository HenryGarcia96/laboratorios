<html>
<head>
    <style>
        /* Cambiar las propiedades para alinearse con el generador de pdf */
        @page { 
            margin: 180px 35px; 
        }
        /* Estilos globales */
        .header { 
            position: fixed; 
            left: 0px; 
            top: -180px; 
            right: 0px; 
            height: 165px; 
            /* background-color: orange;  */
            /* text-align: center;  */
        }
        .footer { 
            position: fixed; 
            left: 0px; 
            bottom: -180px; 
            right: 0px; 
            height: 165px; 
            background-color: lightblue; 
        }
        .footer .page:after { 
            content: counter(page, upper-roman); 
        }

        /* Saltar a nueva pagina */
        .break {
            page-break-after: avoid;
        }

        /* Contenido */
        .invoice-content {
			/* background-color: #fff; */
			/* border: 1px solid #f0f0f0; */
			border-radius: 4px;
			padding-bottom: 10px;
			padding-right: 20px;
            padding-left: 20px;
        }
        /* Separador, solo borde inferior */
        .separador-bottom{
            border-style: none none solid none;
        }

        /* tabla */
        table{
            width: 100%;
        }
        /* Para divisiones de 3 */
        .col-left{
            width: 25%; 
            text-align: left;
            font-size: 12px;
        }
        .col-center{
            width: 50%; 
            text-align: center;
            font-size: 12px;
        }
        .col-right{
            width: 25%; 
            text-align: right;
            font-size: 12px;
        }
        /* Para divisiones de dos con un div mas grande lado izquierdo con miras al centro de la hoja (segun largo)*/
        .col-resize-max{
            width: 75%;
            text-align: right;
            font-size: 16px;
        }
        .col-resize-min{
            width: 25%;
            text-align: left;
        }
    </style>
    <body>
        {{-- Encabezado y pie de página --}}
        @include('layout.partials.resultados.headerPDF')
        @include('layout.partials.resultados.footerPDF')

        {{-- Contenido --}}
        <div class="invoice-content">
            @forelse ($estudios as $estudio)
            <div class="break">
                <p>
                    {{$estudio->clave}} - {{$estudio->descripcion}}
                </p>
                <br>
                                
                @foreach ($estudio['analitos'] as $analito)
                    <table>
                        <tr>
                            <td class="col-left">
                                {{$analito ->clave}} 
                            </td>
                            <td class="col-center">
                                {{$analito->descripcion}}
                            </td>
                            <td class="col-right"></td>
                        </tr>        
                    </table>
                @endforeach

            </div>
            @empty
            @endforelse
            {{-- Segunda página --}}
            {{-- <p class="break">the second page</p> --}}

        </div>
        
    </body>
</html>