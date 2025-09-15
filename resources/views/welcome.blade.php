<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Parosis Akademi - Geleceğin Teknolojisine Yön Veren Akademi</title>
    <meta name="description"
        content="Parosis Akademi, robotik kodlama, yapay zeka ve STEM eğitimleri ile geleceğin mesleklerine hazırlayan, uygulamalı ve yenilikçi teknoloji eğitim merkezi.">
    <style>
        html {
            height: 100%;
        }

        body {
            color: #000;
            margin: 0;
            height: 100%;
            width: 100%;
            background-color: #fff;
        }

        h1,
        h2,
        h3,
        h4,
        p {
            font-family: 'Poppins', sans-serif;
        }

        .content {
            height: auto;
            min-height: 100%;
            padding-left: 10%;
            padding-right: 10%;

        }

        header {
            width: 100%;
            height: 80px;
            padding-top: 7%;
        }

        .logo {
            width: 200px;
            height: 200px;
        }

        section {
            width: 100%;
            padding-top: 80px;

        }

        section h2 {
            font-size: 3em;
            margin: 10px 0px 15px 0px;
            line-height: 1.4em;
        }

        section h4 {
            margin-top: 30px;
            font-weight: 400;
            font-size: 1.4em;
            line-height: 1.3em;
            letter-spacing: 0.25em;
            margin-bottom: 15px;
        }

        section p {
            font-size: 1empx;
            line-height: 1.4em;
            margin: 0;
        }

        .col-2 {
            float: left;
            width: 50%;
        }

        .contact {
            width: 40%;
            margin-left: 4%;
        }

        footer {
            width: 100%;
            margin: 0;
            padding: 10% 0% 0% 0%;
            text-align: center;
            display: inline-block;
            vertical-align: middle;
        }

        footer a {
            text-decoration: none;
            color: #000;
        }

        .subscribe-from {
            position: relative;
            max-width: 400px;
            margin-top: 40px;
            margin-bottom: 20px;
            width: 100%;
            border-radius: 0px;
            border: 1px solid #000;
        }

        .subscribe-from input {
            width: 100%;
            border: none;
            border-radius: 0px;
            background: transparent;
            color: #000;
            font-size: 14px;
            font-weight: 600;
            padding: 15px 16px;
        }

        .subscribe-from button.button-1 {
            position: absolute;
            top: 0;
            right: 0;
            border: 1px solid #000;
            padding: 10px 24px;
            border-radius: 0px;
            color: #fff;
            background: #000;
            height: 47px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            cursor: pointer;
        }

        button,
        input {
            overflow: visible;
            outline: none;
        }

        .social {
            margin-top: 30px;
        }

        .social p {
            font-size: 12px;
        }

        .social-title {
            line-height: 1.5;
            display: inline-block;
            vertical-align: middle;
        }

        .social-title p {
            line-height: 1.5;
            display: inline-block;
            vertical-align: middle;
        }

        .social-ico {
            line-height: 1.5;
            display: inline-block;
            vertical-align: middle;
        }

        .fa-long-arrow-right {
            padding: 12.5px;
            width: 25px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fa-facebook,
        .fa-instagram,
        .fa-linkedin {
            background: #000;
            color: #fff;
            padding: 12.5px;
            width: 25px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
        }

        .fa-envelope,
        .fa-phone,
        .fa-map {
            border: solid 1px #000;
            color: #000;
            padding: 30px;
            width: 25px;
            text-align: center;
            text-decoration: none;
            margin: 135px 10px;
            border-radius: 5px;
        }


        @media (min-width: 320px) and (max-width: 480px) {

            header {
                height: 60px;
                padding-top: 5%;
            }

            .logo {
                width: 120px;
                height: 120px;
            }

            .content {
                padding-left: 5%;
                padding-right: 5%;
            }

            .col-2 {
                width: 100%;
            }

            section {
                padding-top: 0;
            }

            section h2 {
                font-size: 1.8em;
            }

            section h4 {
                font-size: 0.75em;
                letter-spacing: 0.25em;
            }

            section p {
                font-size: 0.95em;
            }

            .subscribe-from {

                max-width: 310px;
                margin-top: 20px;
                margin-bottom: 10px;

            }

            .social {
                margin-top: 0px;
            }

            .contact {
                width: 100%;
                margin-left: 0%;
            }

            .fa-envelope,
            .fa-phone,
            .fa-map {
                margin: 15px 10px;
            }

            footer {
                padding: 0% 0% 0% 0%;
            }
        }

        @media (min-width: 481px) and (max-width: 767px) {

            header {
                height: 60px;
                padding-top: 5%;
            }

            .logo {
                width: 120px;
                height: 120px;
            }

            .content {
                padding-left: 5%;
                padding-right: 5%;
            }

            .col-2 {
                width: 100%;
            }

            section {
                padding-top: 0;
            }

            section h2 {
                font-size: 1.8em;
            }

            section h4 {
                font-size: 0.75em;
                letter-spacing: 0.25em;
            }

            section p {
                font-size: 0.95em;
            }

            .subscribe-from {

                max-width: 310px;
                margin-top: 20px;
                margin-bottom: 10px;

            }

            .social {
                margin-top: 0px;
            }

            .contact {
                width: 100%;
                margin-left: 0%;
            }

            .fa-envelope,
            .fa-phone,
            .fa-map {
                margin: 15px 10px;
            }

            footer {
                padding: 0% 0% 0% 0%;
            }

        }

        @media (min-width: 768px) and (max-width: 1024px) {

            header {
                padding-top: 10%;
            }

            section {
                padding-top: 10px;
            }

            section h2 {
                font-size: 2.8em;
            }

            section h4 {
                font-size: 1em;
                letter-spacing: 0.25em;
            }

            section p {
                font-size: 1.4em;
            }

            .subscribe-from {
                margin-top: 30px;
                margin-bottom: 20px;
            }

            .fa-envelope,
            .fa-phone,
            .fa-map {
                margin: 0 10px;

            }

            .contact {
                margin-left: 0%;
            }

            .content {
                padding-left: 5%;
                padding-right: 5%;
            }

            .col-2 {
                width: 100%;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {

            header {
                padding-top: 10%;
            }

            section {
                padding-top: 10px;
            }

            section h2 {
                font-size: 1.8em;
            }

            section h4 {
                font-size: 0.75em;
                letter-spacing: 0.25em;
            }

            section p {
                font-size: 0.95em;
            }

            .subscribe-from {
                margin-top: 30px;
                margin-bottom: 20px;
            }

            .fa-envelope,
            .fa-phone,
            .fa-map {
                margin: 25px 10px;
            }

            .content {
                padding-left: 5%;
                padding-right: 5%;
            }

        }

        @media (min-width: 1025px) and (max-width: 1280px) {
            .content {
                padding-left: 5%;
                padding-right: 5%;
            }

        }
    </style>
</head>

<body>
    <div class="content">
        <header>
            <div class="logo">
                <h1>Parosis Akademi</h1>
            </div>
        </header>
        <section>
            <div class="col-2 info">
                <h4>BİLGİLENDİRME!</h4>
                <!-- <h1>Parosis Akademi</h1> -->
                <h2>Yenileniyoruz, Teknolojik yeniliklere bizde katılıyoruz.</h2>
                <p>Parosis Akademi, geleceğin teknolojilerini bugünden öğrenmek isteyenler için profesyonel eğitim
                    programları sunar. Çocuklar, gençler ve yetişkinler için hazırlanan robotik kodlama, yapay zeka,
                    STEM tabanlı eğitimler ve yazılım geliştirme atölyeleri ile teknoloji dünyasına güçlü bir başlangıç
                    yapabilirsiniz.</p>

                <div class="subscribe-from">
                    <form action="#">
                        <input type="email" name="email" placeholder="E-Posta Adresinizi Girin..">
                        <button class="button-1" type="submit">Katıl</button>
                    </form>
                </div>

                <div class="social">
                    <div class="social-title">
                        <p>Bizi Takip Edin</p><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </div>

                    <div class="social-ico">
                        <a href="https://www.instagram.com/parosis.akademi/" target="_blank"
                            class="fa fa-instagram"></a>
                    </div>
                </div>
            </div>
            <div class="col-2 contact">

                <div class="social contact-buttons">
                    <a href="tel:05075632023" class="fa fa-phone"></a>
                    <a href="mailto:info@parosis.com" class="fa fa-envelope"></a>
                    <a href="https://maps.app.goo.gl/pL2ytM3ojxLAbKkW8" target="_blank" class="fa fa-map"></a>
                </div>
            </div>
        </section>
        <footer>
            <p>© 2025 <a href="corwus.com">corwus</a> — Tüm Hakları Saklıdır.</p>
        </footer>
    </div>
</body>

</html>
