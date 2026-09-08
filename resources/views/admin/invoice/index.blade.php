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
                                            <th>Submit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot class="bg-primary rounded">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <td style="text-align: left !important;" colspan="10">Total Invoice</td>
                                            <td style="text-align: left !important;" colspan="4" id="total-invoice">
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
@section('side-form')
    <div id="side_form" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#side_form_button" data-kt-drawer-close="#side_form_close" data-kt-drawer-width="500px">
        <!--begin::Card-->
        <div class="card w-100">
            <!--begin::Card header-->
            <div class="card-header pe-5">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#"
                            class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1 title_side_form"></a>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="side_form_close">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body hover-scroll-overlay-y">
                <form class="form-data" enctype="multipart/form-data">

                    <input type="hidden" name="id">
                    <input type="hidden" name="uuid">

                    <div class="mb-10">
                        <label class="form-label">Terbayarkan</label>
                        <input type="text" id="terbayarkan" class="form-control" name="terbayarkan">
                        <small class="text-danger terbayarkan_error"></small>
                    </div>

                    <div class="separator separator-dashed mt-8 mb-5"></div>
                    <div class="d-flex gap-5">
                        <button type="submit" class="btn btn-primary btn-sm btn-submit d-flex align-items-center"><i
                                class="bi bi-file-earmark-diff"></i> Simpan</button>
                        <button type="reset" id="side_form_close"
                            class="btn mr-2 btn-light btn-cancel btn-sm d-flex align-items-center"
                            style="background-color: #ea443e65; color: #EA443E"><i class="bi bi-trash-fill"
                                style="color: #EA443E"></i>Batal</button>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
@endsection
@section('script')
    <script>
        let control = new Control();

        $('#terbayarkan').on('input', function() {
            let value = $(this).val();
            if (value !== "") {
                value = numeral(value).format('0,0'); // Format to rupiah
                $(this).val('Rp ' + value);
            }
        });

        $(document).on('submit', ".form-data", function(e) {
            e.preventDefault();
            let type = $(this).attr('data-type');
            if (type == 'update') {
                let uuid = $("input[name='uuid']").val();
                control.submitFormMultipartData('/admin/update-invoice/' + uuid,
                    'Update',
                    'Invoice', 'POST');
            }
        });

        $(document).on('click', '.button-update', function(e) {
            e.preventDefault();
            let url = '/admin/show-invoice/' + $(this).attr('data-uuid');
            control.overlay_form('Update', 'Invoice', url);
        })

        $(document).on('click', '#button-cetak', function(e) {
            e.preventDefault();

            // Ambil UUID
            var uuid = $(this).attr('data-uuid');
            window.open(`/admin/print-invoice/` + uuid);
        });

        $(document).on('keyup', '#search_', function(e) {
            e.preventDefault();
            control.searchTable(this.value);
        })

        function renderList(data) {
            if (!data) {
                return '-';
            }

            // Decode HTML entity (&quot; menjadi ")
            const textarea = document.createElement('textarea');
            textarea.innerHTML = data;
            data = textarea.value;

            // Parse JSON
            try {
                data = JSON.parse(data);
            } catch (e) {
                data = [data];
            }

            if (!Array.isArray(data)) {
                data = [data];
            }

            let html = '<ul class="mb-0 ps-4">';

            data.forEach(function(item) {

                // Pecah string berdasarkan koma
                const items = String(item)
                    .split(',')
                    .map(value => value.trim())
                    .filter(value => value !== '');

                items.forEach(function(value) {
                    html += `<li>${value}</li>`;
                });

            });

            html += '</ul>';

            return html;
        }

        const initDatatable = async () => {
            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('#kt_table_data')) {
                $('#kt_table_data').DataTable().clear().destroy();
            }

            // Initialize DataTable
            $('#kt_table_data').DataTable({
                responsive: true,

                processing: true,
                serverSide: true,

                pageLength: 10,

                ajax: {
                    url: '/admin/get-invoice',
                    type: 'GET'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'tanggal',
                        name: 'rc.tanggal',
                        className: 'text-center',
                    }, {
                        data: 'costumer',
                        name: 'dc.nama',
                        className: 'text-center',
                    }, {
                        data: 'nama_kapal',
                        name: 'rc.nama_kapal',
                        className: 'text-center',
                    }, {
                        data: 'jenis_muatan',
                        name: 'rc.jenis_muatan',
                        render: function(data) {
                            return renderList(data);
                        }
                    }, {
                        data: 'alamat_tujuan',
                        name: 'rc.alamat_tujuan',
                        className: 'text-center',
                    }, {
                        data: 'alamat_pengirim',
                        name: 'rc.alamat_pengirim',
                        className: 'text-center',
                    }, {
                        data: 'qty',
                        name: 'rc.qty',
                        render: function(data) {
                            return renderList(data);
                        }
                    },
                    {
                        data: 'satuan',
                        name: 'rc.satuan',
                        render: function(data) {
                            return renderList(data);
                        }
                    },
                    {
                        data: 'harga',
                        name: 'rc.harga',
                        render: function(data) {

                            if (data === null || data === undefined || data === '') {
                                return '-';
                            }

                            if (typeof data === 'string') {
                                try {
                                    data = JSON.parse(data);
                                } catch (e) {
                                    data = [data];
                                }
                            }

                            if (!Array.isArray(data)) {
                                data = [data];
                            }

                            return `
            <ul class="mb-0 ps-4">
                ${data.map(item =>
                    `<li>Rp. ${numeral(item).format('0,0')}</li>`
                ).join('')}
            </ul>
        `;
                        }
                    }, {
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',

                        render: function(data, type, row, meta) {

                            /**
                             * Convert data menjadi array
                             */
                            function parseArray(value) {

                                if (value === null || value === undefined || value === '') {
                                    return [];
                                }

                                // Jika sudah berupa array
                                if (Array.isArray(value)) {
                                    return value;
                                }

                                // Decode HTML entity seperti &quot;
                                const textarea = document.createElement('textarea');
                                textarea.innerHTML = value;

                                const decoded = textarea.value;

                                // Coba parse JSON
                                try {
                                    const parsed = JSON.parse(decoded);

                                    return Array.isArray(parsed) ?
                                        parsed : [parsed];

                                } catch (e) {
                                    return [];
                                }
                            }

                            // Parse harga dan qty
                            const hargaArray = parseArray(row.harga);
                            const qtyArray = parseArray(row.qty);

                            // Pastikan jumlah item sama
                            const length = Math.min(
                                hargaArray.length,
                                qtyArray.length
                            );

                            let totalHarga = 0;

                            for (let i = 0; i < length; i++) {

                                // Hilangkan karakter non angka
                                const harga = Number(
                                    String(hargaArray[i])
                                    .replace(/\D/g, '')
                                ) || 0;

                                const qty = Number(qtyArray[i]) || 0;

                                totalHarga += harga * qty;
                            }

                            // Jika tidak ada total
                            if (totalHarga <= 0) {
                                return '-';
                            }

                            // Format Rupiah
                            return 'Rp ' + numeral(totalHarga).format('0,0');
                        }

                    }, {
                        data: 'terbayarkan',
                        name: 'rc.terbayarkan',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            const nominal = Number(data) || 0;

                            return nominal > 0 ?
                                'Rp ' + numeral(nominal).format('0,0') :
                                '-';
                        }
                    },
                    {
                        data: 'terbayarkan',
                        name: 'rc.terbayarkan',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            const nominal = Number(data) || 0;

                            if (nominal > 0) {
                                return `
                <span class="badge badge-light-success">
                    Terbayar Rp ${numeral(nominal).format('0,0')}
                </span>
            `;
                            }

                            return `
            <span class="badge badge-light-danger">
                Belum Terbayar
            </span>
        `;
                        }
                    },
                    {
                        data: 'uuid',
                        name: 'rc.uuid',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (row.terbayarkan) {
                                return `
                            <a href="javascript:;" type="button" data-uuid="${data}" data-label="Invoice" id="button-cetak" class="btn btn-warning btn-icon btn-sm">
                                <svg width="25" height="24" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                            </a>
                        `;
                            } else {
                                return `
                            <a href="javascript:;" type="button" data-uuid="${data}" data-kt-drawer-show="true" data-kt-drawer-target="#side_form" class="btn btn-primary button-update btn-icon btn-sm">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.5 16.2738C3.5 17.8891 4.80945 19.1986 6.42474 19.1986H10.8479L11.1681 17.9178C11.3139 17.3347 11.6155 16.8022 12.0405 16.3771L17.3522 11.0655C17.9947 10.423 18.8591 10.138 19.6986 10.2103V5.92474C19.6986 4.30945 18.3891 3 16.7738 3H10.6994V7.27463C10.6994 8.88992 9.38992 10.1994 7.77463 10.1994H3.5V16.2738ZM9.34949 3.39597L3.89597 8.84949H7.77463C8.6444 8.84949 9.34949 8.1444 9.34949 7.27463V3.39597ZM17.9886 11.7018L12.6769 17.0135C12.3672 17.3231 12.1475 17.7112 12.0412 18.1361L11.6293 19.7836C11.4503 20.5 12.0993 21.1491 12.8157 20.9699L14.4632 20.558C14.8881 20.4518 15.2761 20.2321 15.5859 19.9224L20.8975 14.6107C21.7008 13.8074 21.7008 12.5051 20.8975 11.7018C20.0943 10.8984 18.7919 10.8984 17.9886 11.7018Z" fill="white"/>
                                <mask id="mask0_1953_23043" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="3" y="3" width="19" height="18">
                                <path d="M3.5 16.2738C3.5 17.8891 4.80945 19.1986 6.42474 19.1986H10.8479L11.1681 17.9178C11.3139 17.3347 11.6155 16.8022 12.0405 16.3771L17.3522 11.0655C17.9947 10.423 18.8591 10.138 19.6986 10.2103V5.92474C19.6986 4.30945 18.3891 3 16.7738 3H10.6994V7.27463C10.6994 8.88992 9.38992 10.1994 7.77463 10.1994H3.5V16.2738ZM9.34949 3.39597L3.89597 8.84949H7.77463C8.6444 8.84949 9.34949 8.1444 9.34949 7.27463V3.39597ZM17.9886 11.7018L12.6769 17.0135C12.3672 17.3231 12.1475 17.7112 12.0412 18.1361L11.6293 19.7836C11.4503 20.5 12.0993 21.1491 12.8157 20.9699L14.4632 20.558C14.8881 20.4518 15.2761 20.2321 15.5859 19.9224L20.8975 14.6107C21.7008 13.8074 21.7008 12.5051 20.8975 11.7018C20.0943 10.8984 18.7919 10.8984 17.9886 11.7018Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_1953_23043)">
                                <rect x="0.5" width="24" height="24" fill="white"/>
                                </g>
                                </svg>
                            </a>

                            <a href="javascript:;" type="button" data-uuid="${data}" data-label="Invoice" id="button-cetak" class="btn btn-warning btn-icon btn-sm">
                                <svg width="25" height="24" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
                            </a>
                        `;
                            }
                        }
                    }
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    let total = 0;

                    api.column(10, {
                        search: 'applied'
                    }).data().each(function(value) {

                        console.log('Data column:', value);

                        // Fungsi untuk mengubah HTML entity menjadi karakter normal
                        function decodeHtml(html) {
                            const textarea = document.createElement('textarea');
                            textarea.innerHTML = html;
                            return textarea.value;
                        }

                        // Fungsi untuk memastikan data menjadi array
                        function parseArray(value) {
                            if (Array.isArray(value)) {
                                return value;
                            }

                            if (typeof value !== 'string') {
                                return [];
                            }

                            try {
                                // Decode &quot; menjadi "
                                const decoded = decodeHtml(value);

                                const parsed = JSON.parse(decoded);

                                return Array.isArray(parsed) ? parsed : [];
                            } catch (error) {
                                console.error('Gagal parse array:', value, error);
                                return [];
                            }
                        }

                        const hargaArray = parseArray(value.harga);
                        const qtyArray = parseArray(value.qty);

                        console.log('Harga:', hargaArray);
                        console.log('Qty:', qtyArray);

                        // Pastikan harga dan qty memiliki panjang yang sama
                        const length = Math.min(
                            hargaArray.length,
                            qtyArray.length
                        );

                        let totalHarga = 0;

                        for (let i = 0; i < length; i++) {

                            const harga = parseFloat(
                                String(hargaArray[i]).replace(/[^\d.-]/g, '')
                            ) || 0;

                            const qty = parseFloat(
                                String(qtyArray[i]).replace(/[^\d.-]/g, '')
                            ) || 0;

                            totalHarga += harga * qty;
                        }

                        total += totalHarga;
                    });

                    // Tampilkan total
                    $('#total-invoice').html(
                        'Rp ' + numeral(total).format('0,0')
                    );
                },
            });
        };

        $(function() {
            initDatatable();
        });
    </script>
@endsection
