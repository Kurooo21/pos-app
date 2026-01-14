<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Sementara</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 16px;
            text-transform: uppercase;
        }
        .header p {
            margin: 2px 0;
        }
        .info {
            margin-bottom: 10px;
        }
        .info table {
            width: 100%;
        }
        .items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
        }
        .items th {
            text-align: left;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }
        .items td {
            padding: 5px 0;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>Warung Pondok Bunga</h2>
        <p>Jl. Contoh No. 123, Kota Wisata</p>
        <p>TAGIHAN SEMENTARA</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>Tanggal</td>
                <td>: {{ date('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Meja</td>
                <td>: ....................</td>
            </tr>
        </table>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Qty</th>
                <th style="text-align: right;">Harga</th>
            </tr>
        </thead>
        <tbody>
            @if(count($cart) > 0)
                @foreach($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>x{{ $item['quantity'] }}</td>
                    <td style="text-align: right;">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" style="text-align: center;">Keranjang Kosong</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="total">
        Total: Rp {{ number_format($total, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Mohon segera lakukan pembayaran.</p>
    </div>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Cetak</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

</body>
</html>
