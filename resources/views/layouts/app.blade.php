<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins  " rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: rgb(185 188 191 / 20%) 0px 0px 24px 5px;
            border-radius: 5px;
            font-family: arial;
            overflow: auto;
        }

        thead {
            th {
                padding: 10px 16px;
                text-align: left;
                background-color: #f3f3f5;
            }
        }

        tbody {
            tr {
                td {
                    padding: 10px 16px;
                    border-bottom: 1px solid #eee;
                }

                .action {
                    display: flex;

                    button {
                        margin-right: 10px;
                        cursor: pointer;
                        background-color: #f3f3f5;
                        border: none;
                        padding: 5px 10px;
                        border-radius: 2px;

                        &:last-child {
                            margin-right: 0;
                        }
                    }
                }
            }
        }

        .res-head {
            display: none;
        }

        @media screen and (max-width: 767px) {
            /* Aturan gaya untuk tampilan responsif */
            background-color: transparent;
            box-shadow: none;

            thead {
                display: none;
            }

            tbody {
                tr {
                    display: flex;
                    flex-wrap: wrap;
                    margin-bottom: 10px;
                    background-color: #fff;
                    padding: 50px 10px 10px 10px;
                    position: relative;
                    background-color: #fff;
                    box-shadow: rgb(185 188 191 / 20%) 0px 0px 24px 5px;

                    td {
                        display: flex;
                        background-color: transparent;
                        padding: 0;
                        margin-bottom: 5px;
                        margin-right: 16px;
                        border: none;
                        flex-wrap: wrap;

                        .res-head {
                            display: block;
                            font-weight: 700;
                            margin-right: 5px;
                        }

                        &:first-child {
                            position: absolute;
                            top: 10px;
                            left: 10px;
                        }
                    }

                    .action {
                        position: absolute;
                        top: 10px;
                        right: 10px;
                    }
                }
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/products') }}">
                    {{ config('app.name', 'Penjualan') }} App
                </a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto" style="width: 80%; justify-content: center;">
                        @if (Request::is('products') ||
                                Request::is('category') ||
                                Request::is('customer') ||
                                Request::is('order') ||
                                Request::is('orderdetail'))
                            <li class="nav-item p-2">
                                <a class="nav-link" href="{{ route('products.index') }}">
                                    <span class="nav-link-title">
                                        Dashboard
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link " href="{{ route('category.index') }}">
                                    <span class="nav-link-title">
                                        Category
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link" href="{{ route('customer.index') }}">
                                    <span class="nav-link-title">
                                        Customer
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link" href="{{ route('order.index') }}">
                                    <span class="nav-link-title">
                                        Order
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a class="nav-link " href="{{ route('orderdetail.index') }}">
                                    <span class="nav-link-title">
                                        Order Detail
                                    </span>
                                </a>
                            </li>
                        @else
                        @endif

                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- Javascript untuk convert format kerupiah --}}
    <script>
        /* Dengan Rupiah */
        var dengan_rupiah = document.getElementById('format_rupiah');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }



        var dengan_rupiah = document.getElementById('format_rupiah3');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

    <script>
        var dengan_rupiah = document.getElementById('format_rupiah2');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

    <script>
        function editOrder(orderId) {
            // Set nilai id_kategori sesuai dengan order yang dipilih
            document.getElementById('id_kategori').value = orderId;
        }
    </script>

</body>

</html>
