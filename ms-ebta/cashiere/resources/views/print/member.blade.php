<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @media print {
            @page { margin: 0; }
            /* body { margin: 1.6cm; } */
            
            body {
                margin: 0;
                color: #000;
                background-color: #fff;
            }
            .d-none {
                display: none;
            }
        }
    </style>
    @if ($total == 1)
        <style>
            table {
                width: 50%;
            }
        </style>
    @endif
    <style>
        body, html {
            margin: 0;
            padding: 0;
        }
        section {
            padding: 0.5rem;
        }
        .bground {
            width: 100%;
        }
        .box {
            position: relative;
            color: #fff;
        }
        .logoname {
            position: absolute;
            top: 0.5rem;
            right: 3.8rem;
            /* font-size: 18px; */
            text-align: center;
            font-size: 1.5rem;
        }
        .logoimg {
            position: absolute;
            right: 3rem;
            top: 25%;
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }
        .phone {
            position: absolute;
            top: 18px;
            left: 16px;
            font-size: 18px;
        }
        .name {
            position: absolute;
            bottom: 2rem;
            right: 3rem;
            font-size: 1.5rem;
            display: inline;
        }
        .barcode {
            position: absolute;
            bottom: 18px;
            left: 16px;
            font-size: 18px;
            display: inline;
            color: goldenrod;
        }
        header button {
            width: 98%;
            margin: 1%;
            height: 2rem;
        }
        header {
            margin-bottom: 1rem;
            padding-top: 1rem;
            padding-bottom: 1rem;
            background-color: rgb(245, 242, 242);
        }
    </style>
</head>
<body>
  <header class="d-none">
    <button onclick="window.print()">Print</button>
  </header>
  <section style="border: 1px solid #fff">
    <table width="100%">
    @foreach ($datamember as $key => $item)
        @if ( $key == 0 )
        <tr>
        @endif
            <td  class="text-center" width="50%">
              <div class="box">
                <img src="{{ asset('/img/member.jpg') }}" alt="card" class="bground">
                <P class="logoname">{{ config('app.name') }}</P>
                <img src="{{ asset('/img/logo.png') }}" alt="logo" class="logoimg">
                <div class="name">{{ $item->name }}</div>
                <div class="phone">{{ $item->phone }}</div>
                <div class="barcode text-left">
                    {{-- {!! DNS2D::getBarcodeSVG($item->code, 'QRCODE') !!} --}}
                    {!! DNS2D::getBarcodeHTML($item->code, 'QRCODE', 4,4, 'goldenrod') !!}
                </div>
              </div>
            </td>
        @if ( ($key+1) %2 == 0 )
        </tr><tr>
        @endif
        @if ( ($key+1) %2 != 0 && $key == $total )
        </tr>
        @endif
     @endforeach
    </table>
  </section>
</body>
</html>