<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $module }} {{ $startDateStr }} sampai {{ $endDateStr }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 18px;
            color: #666;
        }

        .header p {
            font-size: 14px;
            color: #888;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #5a7eff;
            color: #fff;
            text-align: center;
        }

        td:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tfoot tr.total td {
            background-color: #5a7eff;
            color: #fff;
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                background-color: #fff;
            }

            .container {
                width: 80%;
                box-shadow: none;
                background-color: #fff;
            }

            th,
            td {
                border: 1px solid #000;
            }

            th {
                background-color: #5a7eff !important;
                -webkit-print-color-adjust: exact;
            }

            td:nth-child(odd) {
                background-color: #f2f2f2 !important;
                -webkit-print-color-adjust: exact;
            }

            tfoot tr.total td {
                background-color: #5a7eff !important;
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
    <div class="container">
        <div class="header">
            <h1>PT. DUNIA LINTAS MANDIRI</h1>
            <h2>Neraca Saldo</h2>
            <p>{{ $startDateStr }} sampai {{ $endDateStr }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Nama Akun</th>
                    <th colspan="2">Neraca Saldo</th>
                </tr>
                <tr>
                    <th>Debit</th>
                    <th>Kredit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kas</td>
                    <td>{{ 'Rp ' . number_format($result['kas'], 0, ',', '.') }}</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Piutang</td>
                    <td>{{ 'Rp ' . number_format($result['piutang'], 0, ',', '.') }}</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Operasional</td>
                    <td>-</td>
                    <td>{{ 'Rp ' . number_format($result['operasional'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Inventaris</td>
                    <td>-</td>
                    <td>{{ 'Rp ' . number_format($result['inventaris'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Biaya Lain</td>
                    <td>-</td>
                    <td>{{ 'Rp ' . number_format($result['biaya_lain'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                @php
                    $totalDebit = $result['kas'] + $result['piutang'];
                    $totalKredit = $result['operasional'] + $result['inventaris'] + $result['biaya_lain'];
                @endphp
                <tr class="total">
                    <td>Total</td>
                    <td>{{ 'Rp ' . number_format($totalDebit, 0, ',', '.') }}</td>
                    <td>{{ 'Rp ' . number_format($totalKredit, 0, ',', '.') }}</td>
                </tr>
                <tr class="total">
                    <td>Profit</td>
                    <td colspan="2" style="text-align: center">
                        {{ 'Rp ' . number_format($totalDebit - $totalKredit, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

    </div>
</body>

</html>
