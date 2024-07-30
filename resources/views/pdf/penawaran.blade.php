@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penawaran-{{ $penawaran->nama_costumer }}-{{ $penawaran->no_surat }}</title>
    <style>
        * {
            font-family: "Times New Roman", Times, serif;
            box-sizing: border-box;
        }

        .penawaran-box {
            max-width: 800px;
            margin: auto;
            padding: 50px;
            font-size: 15px;
            line-height: 15px;
            color: #131212;
        }

        .penawaran-header {
            display: grid;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid #141414;
            padding-bottom: 5px;
        }

        .logo {
            position: absolute;
        }

        .logo img {
            max-width: 105px;
        }

        .company-info {
            text-align: center;
            margin-bottom: 10px;
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

        .penawaran-info {
            display: flex;
            justify-content: space-between;
            margin: 3px 0;
        }

        .customer-info,
        .penawaran-details {
            width: 45%;
        }

        .subject,
        .body-text {
            margin-bottom: 20px;
        }

        .subject p {
            font-weight: bold;
            text-decoration: underline;
        }

        .details table {
            margin: 5px 0;
            padding-left: 30px;
        }

        .notes ul {
            list-style: disc;
            padding-left: 20px;
        }

        .notes ul li {
            margin-bottom: 5px;
        }

        .signature-space {
            height: 100px;
        }

        .invoice-signature {
            width: max-content;
            float: right;
            margin-top: 10px;
        }

        .invoice-signature div {
            text-align: center;
        }

        .invoice-signature .signature-space {
            border-bottom: 1px solid #eee;
            width: 200px;
            margin: 0 0 0 auto;
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
    <div class="penawaran-box">
        <header class="penawaran-header">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="Company Logo">
            </div>
            <div class="company-info">
                <h1 style="color: red">PT. DUNIA LINTAS MANDIRI</h1>
                <p style="font-weight: bold">Shipping, Freight Forwarding & Domestic Cargo</p>
                <p>Office: Jl. Raya Kelapa Hibrida I Blok GI No. 3, Kelapa Gading, Jakarta Utara 14240</p>
                <p>Email: dunialintasmandiri@gmail.com | Website: dunialintasmandiri.my.id</p>
                <p>Phone: 08111252547 | 0811425254</p>
                <p>Telp: 021-2422 3333</p>
            </div>
        </header>
        <section class="penawaran-info">
            <div class="penawaran-details">
                <p><strong>{{ $penawaran->nama_costumer }}</strong></p>
                <p>{{ $penawaran->alamat }}</p>
            </div>
            <div class="customer-info">
                <p style="text-align: end">{{ $penawaran->no_surat }}</p>
            </div>
        </section>
        <div class="subject">
            <p><strong>Perihal: {{ $penawaran->perihal }}</strong></p>
        </div>
        <div class="body-text">
            <p>Dengan Hormat,</p>
            <p>
                Dengan ini kami dari <strong>PT DUNIA LINTAS MANDIRI</strong> yang bergerak di bidang transportasi,
                pengiriman barang
                (Cargo), Unit kendaraan Serta Alat Berat keseluruh Indonesia bermaksud untuk mengajukan penawaran harga
                untuk uraian pekerjaan berikut sbb :
            </p>
            <div class="details">
                <table>
                    <tr>
                        <td>Nama / Jenis barang</td>
                        <td>: {{ $penawaran->jenis_barang }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>: {{ $penawaran->jumlah }}</td>
                    </tr>
                    <tr>
                        <td>Kondisi pengiriman</td>
                        <td>: {{ $penawaran->kondisi }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi muat</td>
                        <td>: {{ $penawaran->lokasi_muat }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi Tujuan</td>
                        <td>: {{ $penawaran->lokasi_tujuan }}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>: {{ 'Rp ' . number_format($penawaran->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Pembayaran</td>
                        <td>: {{ $penawaran->pembayaran }}</td>
                    </tr>
                </table>
            </div>
            <div class="notes">
                <p><strong>Keterangan:</strong></p>
                <ul style="margin-left: 10px">
                    <li>Harga Di atas Belum Include Asuransi</li>
                    <li>Harga belum termasuk PPN/PPh</li>
                    <li>BANK BNI 1784986058 A/N PT Dunia Lintas Mandiri</li>
                    <li>BANK BCA 0696252577 A/N Pt Dunia Lintas Mandiri</li>
                </ul>
            </div>
            <p>
                Demikian penawaran ini kami sampaikan dan terimakasih atas perhatian serta Kerjasamanya.
            </p>
            <section class="invoice-signature">
                <div style="text-align: left">{{ $penawaran->lokasi }},
                    {{ \Carbon\Carbon::parse($penawaran->tanggal)->translatedFormat('d F Y') }}</div>
                <div style="text-align: left">Hormat Kami,</div>
                <div style="text-align: start">PT. Dunia Lintas Mandiri</div>
                <div class="signature-space"></div>
                <div style="border-top: 2px solid;"></div>
            </section>
        </div>
    </div>
</body>

</html>
