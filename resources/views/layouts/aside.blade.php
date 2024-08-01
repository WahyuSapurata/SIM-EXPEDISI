@php
    $path = explode('/', Request::path());
    $role = auth()->user()->role;

    $dashboardRoutes = [
        'admin' => 'admin.dashboard-admin',
        'owner' => 'owner.dashboard-owner',
    ];

    $isActive = in_array($role, array_keys($dashboardRoutes)) && isset($path[1]) && $path[1] === 'dashboard-' . $role;
    $activeColor = $isActive ? 'color: #F4BE2A' : 'color: #FFFFFF';
@endphp

<div class="aside-menu flex-column-fluid" style="background: linear-gradient(to bottom, #15a3a3, #133b4e);">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y mb-5 mb-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <script>
            // Ambil elemen menu menggunakan JavaScript
            var menu = document.getElementById('kt_aside_menu_wrapper');

            // Set tinggi maksimum dan penanganan overflow menggunakan JavaScript
            if (menu) {
                menu.style.maxHeight = '88vh'; // Set tinggi maksimum
            }
        </script>
        <!--begin::Menu-->
        <div class="menu menu-column mt-2 menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="kt_aside_menu" data-kt-menu="true" style="gap: 3px;">

            <div class="menu-item">
                <a class="menu-link {{ $isActive ? 'active' : '' }}" href="{{ route($dashboardRoutes[$role]) }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $isActive ? url('admin/assets/media/icons/aside/dashboardact.svg') : url('admin/assets/media/icons/aside/dashboarddef.svg') }}"
                                alt="">
                        </span>
                    </span>
                    <span class="menu-title" style="{{ $activeColor }}">Dashboard</span>
                </a>
            </div>

            @if ($role === 'admin')
                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'customer' ? 'active' : '' }}"
                        href="{{ route('admin.customer') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'customer' ? url('admin/assets/media/icons/aside/dataclientact.svg') : url('/admin/assets/media/icons/aside/dataclientdef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'customer' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Data
                            Customer</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'realcost' ? 'active' : '' }}"
                        href="{{ route('admin.realcost') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'realcost' ? url('admin/assets/media/icons/aside/pajakact.svg') : url('/admin/assets/media/icons/aside/pajakdef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'realcost' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Input
                            Data</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'invoice' ? 'active' : '' }}"
                        href="{{ route('admin.invoice') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'invoice' ? url('admin/assets/media/icons/aside/invoiceact.svg') : url('/admin/assets/media/icons/aside/invoicedef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'invoice' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Invoice</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'piutang' ? 'active' : '' }}"
                        href="{{ route('admin.piutang') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'piutang' ? url('admin/assets/media/icons/aside/piutangact.svg') : url('/admin/assets/media/icons/aside/piutangdef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'piutang' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Piutang</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'penawaran' ? 'active' : '' }}"
                        href="{{ route('admin.penawaran') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'penawaran' ? url('admin/assets/media/icons/aside/penawaranact.svg') : url('/admin/assets/media/icons/aside/penawarandef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'penawaran' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Penawaran</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <div class="menu-item menu-link-indention menu-accordion {{ $path[1] == 'biaya-operasional' ? 'show' : '' }}"
                    data-kt-menu-trigger="click">
                    <!--begin::Menu link-->
                    <a href="#" class="menu-link py-3 {{ $path[1] == 'biaya-operasional' ? 'active' : '' }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] == 'biaya-operasional' ? url('admin/assets/media/icons/aside/masterdataact.svg') : url('/admin/assets/media/icons/aside/masterdatadef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] == 'biaya-operasional' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Cashflow</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu link-->

                    <!--begin::Menu sub-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">

                        <!--begin::Menu item-->
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'operasional' ? 'active' : '' }}"
                                href="{{ route('admin.operasional') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'operasional' ? url('admin/assets/media/icons/aside/masterdataact.svg') : url('/admin/assets/media/icons/aside/masterdatadef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'operasional' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Biaya
                                    Operasional</span>
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'invetaris' ? 'active' : '' }}"
                                href="{{ route('admin.invetaris') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'invetaris' ? url('admin/assets/media/icons/aside/masterdataact.svg') : url('/admin/assets/media/icons/aside/masterdatadef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'invetaris' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">By
                                    Inventaris</span>
                            </a>
                        </div>
                        <!--end::Menu item-->

                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'biaya' ? 'active' : '' }}"
                                href="{{ route('admin.biaya') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'biaya' ? url('admin/assets/media/icons/aside/masterdataact.svg') : url('/admin/assets/media/icons/aside/masterdatadef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'biaya' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Biaya
                                    Lain</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu sub-->

                </div>

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'laporan' ? 'active' : '' }}"
                        href="{{ route('admin.laporan') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'laporan' ? url('admin/assets/media/icons/aside/laporanact.svg') : url('/admin/assets/media/icons/aside/laporandef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'laporan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Laporan</span>
                    </a>
                </div>
                <!--end::Menu item-->
            @endif

            @if ($role === 'owner')
                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'customer' ? 'active' : '' }}"
                        href="{{ route('owner.customer') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'customer' ? url('admin/assets/media/icons/aside/dataclientact.svg') : url('/admin/assets/media/icons/aside/dataclientdef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'customer' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Data
                            Customer</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'invoice' ? 'active' : '' }}"
                        href="{{ route('owner.invoice') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'invoice' ? url('admin/assets/media/icons/aside/invoiceact.svg') : url('/admin/assets/media/icons/aside/invoicedef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'invoice' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Invoice</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'piutang' ? 'active' : '' }}"
                        href="{{ route('owner.piutang') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'piutang' ? url('admin/assets/media/icons/aside/piutangact.svg') : url('/admin/assets/media/icons/aside/piutangdef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'piutang' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Piutang</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'laporan' ? 'active' : '' }}"
                        href="{{ route('owner.laporan') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'laporan' ? url('admin/assets/media/icons/aside/laporanact.svg') : url('/admin/assets/media/icons/aside/laporandef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'laporan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Laporan</span>
                    </a>
                </div>
                <!--end::Menu item-->
            @endif

            {{-- <div class="menu-item">
                <a class="menu-link  {{ $path[0] === 'ubahpassword' ? 'active' : '' }}"
                    href="{{ route('ubahpassword') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[0] === 'ubahpassword' ? url('admin/assets/media/icons/aside/ubahpasswordact.svg') : url('/admin/assets/media/icons/aside/ubahpassworddef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[0] === 'ubahpassword' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Ubah
                        Password</span>
                </a>
            </div> --}}

        </div>
        <!--end::Menu-->
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            // $(".menu-link").hover(function(){
            //     $(this).css("background", "#282EAD");
            // }, function(){
            //     $(this).css("background", "none");
            // });
        });
    </script>
@endsection
