<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Kecil</title>

    <?php
    $style = '
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm
    ';
    ?>
    <?php 
    $style .= 
        ! empty($_COOKIE['innerHeight'])
                ? $_COOKIE['innerHeight'] .'mm; !important
            }'
            :'}';
    ?>
    <?php
    $style .= '
            html, body {
                width: 70mm;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
    ';
    ?>

    {!! $style !!}
</head>
<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <div class="text-center">
        <h3 style="margin-bottom: 5px;">{{ strtoupper($setting->name_store) }}</h3>
        <p>{{ strtoupper($setting->address) }}</p>
    </div>
    <br>
    <div>
        <p style="float: left;">{{ date('d-m-Y') }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>No: {{ add_nol($sale->id, 6) }}</p>
    <p class="text-center">===================================</p>
    <table width="100%" style="border: 0;">
        @foreach ($detail as $item)
        {{-- {{ $sale }} --}}
            <tr>
                <td colspan="3">{{ $item->product->name }}</td>
            </tr>
            <tr>
                <td>{{ $item->qty }} x {{ money_format($item->selling_price, '.', 'Rp ', ',-') }} (dis: {{ money_format($item->discount, '.', '', '%') }})</td>
                <td></td>
                <td class="text-right">{{ money_format(($item->qty * $item->selling_price)-($item->qty * $item->selling_price)*($item->discount/100), '.', 'Rp ', ',-') }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <table width="100%" style="border: 0;">
        <tr>
            <td>Total Harga:</td>
            <td class="text-right">{{ money_format($sale->pricing_total, '.', 'Rp ', ',-') }}</td>
        </tr>
        <tr>
            <td>Total Item:</td>
            <td class="text-right">{{ $sale->total_item }} pcs</td>
        </tr>
        <tr>
            <td>Diskon:</td>
            <td class="text-right">{{ money_format($sale->discount, '.', '', '%') }}</td>
        </tr>
        <tr>
            <td>Total Bayar:</td>
            <td class="text-right">{{ money_format($sale->subtotal_prices, '.', 'Rp ', ',-') }}</td>
        </tr>
        <tr>
            <td>Diterima:</td>
            <td class="text-right">{{ money_format($sale->customer_money, '.', 'Rp ', ',-') }}</td>
        </tr>
        <tr>
            <td>Kembali:</td>
            <td class="text-right">{{ money_format($sale->customer_money - $sale->subtotal_prices, '.', 'Rp ', ',-') }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">-- TERIMA KASIH --</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        document.cookie = "innerHeight=; expired=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>