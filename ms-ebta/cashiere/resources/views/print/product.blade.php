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
        .barcode-cover>div {
            text-align: center;
            display: inline-block;
        }
        .barcode-cover {
            margin-bottom: 1rem;
        }
        .barcode-cover>p {
            font-size: 0.6rem;
            color: rgb(73, 79, 85);
        }
    </style>
</head>
<body>
    <table width="100%">
        @foreach ($dataProduct as $key => $item)
            @if ( $key == 0 )
            <tr>
            @endif
                <td style="border: 1px solid;">
                    {{ env('APP_NAME') }}
                    <p class="text-center" >{{ $item->name }} - {{ money_format($item->selling_price, '.', 'Rp ', ',-') }}</p>
                    {{-- {!! DNS1D::getBarcodeSVG($item->code, 'C39', 1,40, 'red') !!} --}}
                    <div class="barcode-cover text-center">
                        {!!  DNS1D::getBarcodeHTML($item->code, 'C39', 1,40) !!}
                        <p>{{ $item->code }}</p>
                    </div>
                    
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