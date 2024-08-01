@extends('layouts.layout')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="row">

                <div class="card">
                    <div class="card-body p-0">
                        <div class="container">
                            <div class="py-5 table-responsive">
                                <table id="kt_table_data"
                                    class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300">
                                    <thead class="text-center">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Kapal</th>
                                            <th>Costumer</th>
                                            <th>Deskripsi Muatan</th>
                                            <th>Alamat Pengirim</th>
                                            <th>Alamat Tujuan</th>
                                            <th>QTY</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            <th>Terbayarkan</th>
                                            <th>Ket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot class="bg-primary rounded">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <td style="text-align: left !important;" colspan="10">Total Invoice</td>
                                            <td style="text-align: left !important;" colspan="3" id="total-invoice">
                                                Rp 0
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection
@section('script')
    <script>
        let control = new Control();

        $(document).on('keyup', '#search_', function(e) {
            e.preventDefault();
            control.searchTable(this.value);
        })

        const initDatatable = async () => {
            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('#kt_table_data')) {
                $('#kt_table_data').DataTable().clear().destroy();
            }

            // Initialize DataTable
            $('#kt_table_data').DataTable({
                responsive: true,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ],
                processing: true,
                ajax: '/owner/get-invoice',
                columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: 'tanggal',
                    className: 'text-center',
                }, {
                    data: 'costumer',
                    className: 'text-center',
                }, {
                    data: 'nama_kapal',
                    className: 'text-center',
                }, {
                    data: 'jenis_muatan',
                    render: function(data, type, row, meta) {
                        let item = '<ul>';
                        $.each(data, function(x, y) {
                            item += `<li>${y}</li>`;
                        });
                        item += '</ul>';
                        return item;
                    }
                }, {
                    data: 'alamat_pengirim',
                    className: 'text-center',
                }, {
                    data: 'alamat_tujuan',
                    className: 'text-center',
                }, {
                    data: 'qty',
                    render: function(data, type, row, meta) {
                        let item = '<ul>';
                        $.each(data, function(x, y) {
                            item += `<li>${y}</li>`;
                        });
                        item += '</ul>';
                        return item;
                    }
                }, {
                    data: 'satuan',
                    render: function(data, type, row, meta) {
                        let item = '<ul>';
                        $.each(data, function(x, y) {
                            item += `<li>${y}</li>`;
                        });
                        item += '</ul>';
                        return item;
                    }
                }, {
                    data: 'harga',
                    render: function(data, type, row, meta) {
                        let item = '<ul>';
                        $.each(data, function(x, y) {
                            item += `<li>Rp. ${numeral(y).format(
                            '0,0')}</li>`;
                        });
                        item += '</ul>';
                        return item;
                    }
                }, {
                    data: null,
                    render: function(data, type, row, meta) {
                        // Periksa apakah harga dan qty valid
                        const hargaArray = row.harga ||
                    []; // Gunakan array kosong jika harga tidak ada
                        const qtyArray = row.qty ||
                    []; // Gunakan array kosong jika qty tidak ada

                        // Pastikan harga dan qty memiliki panjang yang sama
                        const length = Math.min(hargaArray.length, qtyArray.length);

                        // Hitung total harga
                        let totalHarga = 0;
                        for (let i = 0; i < length; i++) {
                            const harga = hargaArray[i] ||
                                0; // Gunakan default 0 jika harga tidak ada
                            const qty = qtyArray[i] ||
                                0; // Gunakan default 0 jika qty tidak ada
                            totalHarga += harga * qty; // Tambahkan total harga
                        }

                        // Format total harga menjadi format rupiah
                        return 'Rp ' + numeral(totalHarga).format('0,0');
                    }
                }, {
                    data: 'terbayarkan',
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return data ? 'Rp ' + numeral(data).format(
                            '0,0') : '-';
                    }
                }, {
                    data: 'terbayarkan',
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return data ? 'Terbayar Rp ' + numeral(data).format(
                            '0,0') : 'Belum Terbayar';
                    }
                }],
                rowCallback: function(row, data, index) {
                    var api = this.api();
                    var startIndex = api.context[0]._iDisplayStart;
                    var rowIndex = startIndex + index + 1;
                    $('td', row).eq(0).html(rowIndex);
                },
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    let total = 0;

                    // Calculate total for 'keluar' and 'masuk' columns
                    api.column(10, {
                        search: 'applied'
                    }).data().each(function(value) {
                        // Periksa apakah harga dan qty valid
                        const hargaArray = value.harga ||
                    []; // Gunakan array kosong jika harga tidak ada
                        const qtyArray = value.qty ||
                    []; // Gunakan array kosong jika qty tidak ada

                        // Pastikan harga dan qty memiliki panjang yang sama
                        const length = Math.min(hargaArray.length, qtyArray.length);

                        // Hitung total harga
                        let totalHarga = 0;
                        for (let i = 0; i < length; i++) {
                            const harga = parseFloat(hargaArray[i]) ||
                                0; // Gunakan default 0 jika harga tidak ada
                            const qty = parseFloat(qtyArray[i]) ||
                                0; // Gunakan default 0 jika qty tidak ada
                            totalHarga += harga * qty; // Tambahkan total harga
                        }
                        total += totalHarga; // Tambahkan totalHarga ke total keseluruhan
                    });

                    // Update the total row in the footer
                    $('#total-invoice').html('Rp ' + numeral(total).format('0,0'));
                },
            });
        };

        $(function() {
            initDatatable();
        });
    </script>
@endsection
