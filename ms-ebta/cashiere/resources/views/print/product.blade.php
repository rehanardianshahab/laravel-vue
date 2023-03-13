<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <table width="100%">
        @foreach ($dataProduct as $key => $item)
            @if ( $key == 0 )
            <tr>
            @endif
                <td class="text-center" style="border: 1px solid;">
                    <p>{{ $item->name }} - {{ money_format($item->selling_price, '.', 'Rp ', ',-') }}</p>
                    {!! DNS1D::getBarcodeSVG($item->code, 'C39', 1,40, 'red') !!}
                    {{-- <img src="data:image/png;base64, {!! DNS2D::getBarcodePNG('4', 'PDF417') !!}" alt="barcode" style="min-height: 2rem; min-width:3rem;"/> --}}
                </td>
            @if ( ($key+1) %3 == 0 )
            </tr><tr>
            @endif
            @if ( ($key+1) %3 != 0 && $key == $total )
            </tr>
            @endif
        @endforeach
    </table>
</body>
</html>