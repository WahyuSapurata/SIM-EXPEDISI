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
                                            <th>Costumer</th>
                                            <th>No Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi Muatan</th>
                                            <th>Piutang</th>
                                            <th>Terbayarkan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot class="bg-primary rounded">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <td style="text-align: left !important;" colspan="5">Total Piutang</td>
                                            <td style="text-align: left !important;" colspan="3" id="total-piutang">
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
                ajax: '/owner/get-piutang',
                columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: 'costumer',
                    className: 'text-center',
                }, {
                    data: 'no_invoice',
                    className: 'text-center',
                }, {
                    data: 'tanggal',
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
                    data: 'piutang',
                    render: function(data, type, row, meta) {
                        return 'Rp ' + numeral(data).format(
                            '0,0');
                    }
                }, {
                    data: 'terbayarkan',
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return data ? 'Rp ' + numeral(data).format(
                            '0,0') : '-';
                    }
                }, {
                    data: 'status',
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return `<div class="btn btn-danger px-2 py-1">${data}</div>`;
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
                    api.column(5, {
                        search: 'applied'
                    }).data().each(function(value) {
                        total += value
                    });

                    // Update the total row in the footer
                    $('#total-piutang').html('Rp ' + numeral(total).format('0,0'));
                },
            });
        };

        $(function() {
            initDatatable();
        });
    </script>
@endsection
