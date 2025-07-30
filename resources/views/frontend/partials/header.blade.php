<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }} - PT Ghaleb Palindo International</title>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0QNDQYXRH1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-0QNDQYXRH1');
    </script>
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WH3NN3FR');
    </script>
    <!-- ======= SEO Meta Tags ======= -->
    <meta name="description"
        content="PT Ghaleb Palindo International adalah perusahaan jasa profesional di bidang pengurusan visa, KITAS, NPWP, izin tinggal, registrasi perusahaan, dan layanan keimigrasian. Layanan cepat, aman, dan terpercaya untuk individu, perusahaan, dan institusi.">
    <meta name="keywords"
        content="PT Ghaleb Palindo International, pengurusan visa, KITAS, NPWP, izin tinggal, jasa keimigrasian, registrasi perusahaan, legalisasi dokumen, layanan publik, jasa dokumen resmi, PT Ghaleb Palindo, alharamain, Alharamain, alharamain services">
    <meta name="author" content="PT Ghaleb Palindo International">

    <!-- ======= Open Graph for Social Media ======= -->
    <meta property="og:title"
        content="PT Ghaleb Palindo International - Jasa Visa, KITAS, dan Keimigrasian Profesional">
    <meta property="og:description"
        content="Layanan pengurusan visa, KITAS, izin tinggal, NPWP, dan dokumen legal oleh tim profesional. Cepat, aman, terpercaya.">
    <meta property="og:image" content="{{ asset('dist/img/logo_1080.png') }}">
    <!-- Ganti dengan URL gambar representatif -->
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    {{-- google console --}}
    <meta name="google-site-verification" content="Zku4aZvFSHotyFN8Rm9eWyDpoDTnanyRnWk4Q6Emc2Q" />

    @php
        $organizationJsonLd = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'PT Ghaleb Palindo International',
            'url' => 'https://alharamainservices.id',
            'logo' => asset('dist/img/logo_1080.png'),
            'sameAs' => ['https://www.instagram.com/palindo.International'],
        ];
    @endphp

    <script type="application/ld+json">
    {!! json_encode($organizationJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>


    <!-- ======= Favicon/Icon ======= -->
    <link rel="icon" href="{{ asset('dist/img/logo.png') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dist/img/logo_1080.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dist/img/logo_1080.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist/img/logo_1080.png') }}">

    <!-- ======= Google Font =======-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet" />
    <!-- End Google Font-->

    <!-- ======= Styles =======-->
    <link href="assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="assets/vendors/glightbox/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="assets/vendors/aos/aos.css" rel="stylesheet" />
    <link href="assets/css/chat.css" rel="stylesheet" />
    <link href="dist/css/timeline.css" rel="stylesheet" />
    <!-- End Styles-->

    <!-- ======= Theme Style =======-->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- End Theme Style-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ======= Apply theme =======-->
    <script>
        // Apply the theme as early as possible to avoid flicker
        (function() {
            const storedTheme = localStorage.getItem("theme") || "light";
            document.documentElement.setAttribute("data-bs-theme", storedTheme);
        })();
    </script>
</head>
