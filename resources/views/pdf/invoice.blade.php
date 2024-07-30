@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice-{{ $data_costumer->nama }}-{{ $invoice->no_invoice }}</title>
    <style>
        * {
            font-family: "Times New Roman", Times, serif;
            box-sizing: border-box;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 50px;
            font-size: 15px;
            line-height: 15px;
            color: #131212;
        }

        .invoice-header {
            display: grid;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid #141414;
            padding-bottom: 8px;
        }

        .logo {
            position: absolute;
        }

        .logo img {
            max-width: 105px;
        }

        .company-info {
            text-align: center;
        }

        .company-info h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .company-info p {
            margin: 0;
            font-size: 12px;
            color: #1a1919;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin: 5px 0 0 0;
        }

        .customer-info,
        .invoice-details {
            width: 45%;
        }

        .invoice-items table,
        .invoice-totals table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .invoice-items th,
        .invoice-items td,
        .invoice-totals td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .invoice-items th {
            background: #5a7eff;
            color: #fff;
            font-weight: bold;
        }

        .invoice-items td:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .invoice-totals td {
            font-weight: bold;
        }

        .invoice-totals tr:last-child td {
            border-top: 2px solid #eee;
        }

        .invoice-remarks,
        .invoice-payment,
        .invoice-notes,
        .invoice-signature {
            margin-top: 20px;
        }

        .signature-space {
            height: 100px;
        }

        .invoice-signature {
            width: max-content;
            float: right;
            margin-top: 20px;
        }

        .invoice-signature div {
            text-align: center;
        }

        .invoice-signature .signature-space {
            border-bottom: 1px solid #eee;
            width: 200px;
            margin: 0 0 0 auto;
        }

        @media print {

            .invoice-items th,
            .invoice-totals th {
                background: #5a7eff !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
            }

            .invoice-items td:nth-child(odd) {
                background-color: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @page {
            margin: 0;

            @top-center {
                content: none;
            }

            @bottom-center {
                content: none;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</head>

<body>
    <div class="invoice-box">
        <header class="invoice-header">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="Company Logo">
            </div>
            <div class="company-info">
                <h1 style="color: red">PT. DUNIA LINTAS MANDIRI</h1>
                <p style="font-weight: bold">Shipping, Freight Forwarding & Domestic Cargo</p>
                <p>Office: Jl. Raya Kelapa Hibrida I Blok GI No. 3, Kelapa Gading, Jakarta Utara 14240</p>
                <p>Email: dunialintasmandiri@gmail.com | Website: dunialintasmandiri@gmail.com</p>
                <p>Phone: 08111252547 | 0811425254</p>
                <p>Telp: 021-2422 3333</p>
            </div>
        </header>
        <div style="text-align: center; font-size: 25px; font-weight: bold; margin-top: 10px">INVOICE</div>
        <section class="invoice-info">
            <div class="customer-info" style="display: grid">
                <div>
                    <p style="font-size: 18px"><strong>{{ $data_costumer->nama }}</strong></p>
                    <p>{{ $data_costumer->alamat }}</p>
                </div>
                <p style="margin-bottom: 0; font-weight: bold; font-size: 13px">{{ $invoice->nama_kapal }}</p>
            </div>
            <div class="invoice-details">
                <table>
                    <tr>
                        <td>No. Invoice</td>
                        <td>: {{ $invoice->no_invoice }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Invoice</td>
                        <td>: {{ \Carbon\Carbon::parse($invoice->tanggal)->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Port Load</td>
                        <td>: {{ $invoice->alamat_tujuan }}</td>
                    </tr>
                    <tr>
                        <td>Port Discharge</td>
                        <td>: {{ $invoice->alamat_pengirim }}</td>
                    </tr>
                    <tr>
                        <td>Unit / Party</td>
                        <td>:
                            @if (is_array($invoice->qty) && is_array($invoice->satuan))
                                @foreach ($invoice->qty as $index => $qty)
                                    {{ $qty }} {{ $invoice->satuan[$index] ?? 'N/A' }}@if ($index < count($invoice->qty) - 1)
                                        /
                                    @endif
                                @endforeach
                            @else
                                {{ $invoice->qty }} {{ $invoice->satuan }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Delevery</td>
                        <td>: {{ $invoice->delevery }}</td>
                    </tr>
                </table>
            </div>
        </section>
        <section class="invoice-items">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0; // Untuk menghitung subtotal dan grand total
                    @endphp

                    @foreach ($invoice->harga as $index => $harga)
                        @php
                            $qty = $invoice->qty[$index] ?? 0;
                            $lineTotal = $harga * $qty;
                            $total += $lineTotal;
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $invoice->jenis_muatan[$index] ?? 'N/A' }}</td>
                            <td>{{ 'Rp. ' . number_format($harga, 0, ',', '.') }}</td>
                            <td>{{ $qty }} {{ $invoice->satuan[$index] ?? 'N/A' }}</td>
                            <td>{{ 'Rp. ' . number_format($lineTotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="4">Subtotal</td>
                        <td>{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <td colspan="4">Grand Total</td>
                        <td>{{ 'Rp. ' . number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>

            </table>
        </section>
        <section class="invoice-remarks">
            <p>Terbilang:</p>
            @php
                // Hitung total dari semua harga dan qty
                $total = 0;
                foreach ($invoice->harga as $index => $harga) {
                    $qty = $invoice->qty[$index] ?? 0;
                    $total += $harga * $qty;
                }

                // Format angka ke dalam bentuk terbilang
                $formatter = new NumberFormatter('id', NumberFormatter::SPELLOUT);
                $terbilang = $formatter->format($total);
            @endphp
            <p
                style="text-align: center; font-style: italic; font-weight: bold; padding: 10px 0; background-color: #eee">
                {{ $terbilang }} rupiah</p>
        </section>
        <section class="invoice-payment">
            <p>Pembayaran Transfer Melalui Bank:</p>
            <p style="font-weight: bold;">BANK BNI : 1784986058 A/N Pt Dunia Lintas Mandiri</p>
            <p style="font-weight: bold;">BANK BCA : 0696252577 A/N Pt Dunia Lintas Mandiri</p>
        </section>
        <section class="invoice-notes" style="margin-left: 20px">
            <p style="text-decoration: underline">Noted</p>
            <table>
                <tr>
                    <td>Muat</td>
                    <td>: {{ $invoice->muat }}</td>
                </tr>
                <tr>
                    <td>Bongkar</td>
                    <td>: {{ $invoice->bongkar }}</td>
                </tr>
            </table>
        </section>
        <section class="invoice-signature">
            <div>PT. Dunia Lintas Mandiri</div>
            <div class="signature-space"></div>
            <div style="border-top: 2px solid;">FINANCE</div>
        </section>
    </div>
</body>

</html>
