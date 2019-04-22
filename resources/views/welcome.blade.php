<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="main">
                    <div class="col-md-12">

                        <h4 class="text-center home-content-h1">LINKABILITY</h4>
                        <div class="home-top-content ml-5 mr-5">
                            <p>Linkability is designed to provide a cost-effective and simple solution for any business by focusing on the following:</p>
                            <ul>
                                <li>linkability <b>simplifies</b> access to people with disabilities</li>
                                <li>linkability <b>matches</b> people with disabilities to job and skills development opportunities</li>
                                <li>linkability <b>assesses</b> skill, qualifications and experience against job and training requirements</li>
                                <li>linkability <b>recommends</b> suitable candidates for interviewing</li>
                                <li>linkability <b>tracks</b> the recruitment and selection process</li>
                                <li>linkability <b>improves</b> awareness of disability related matters</li>
                                <li>linkability <b>teaches</b> employers how to become an “employer of choice”</li>
                            </ul>
                            <p>
                                Linkability is a Siyakha Implementation Partners product. For the past 20 years, Siyakha has driven transformation
                                initiatives across various industries in South Africa. Our goal is about more than just ticking the compliance box, but
                                rather about sustainable transformation which ultimately makes your business more successful and an “employer of
                                choice”.
                            </p>
                        </div>
                        <div class="col-md-12">
                            <div class="home-job-search">
                                <div class="search-content">
                                    <span id="color-white">SEARCH JOBS</span>
                                    <form class="form-inline ">
                                        <div class="breath-down">
                                            <input type="text"  id="inputPassword2" placeholder="Job title. Skill or Company">
                                        </div>
                                        <div class="breath-left breath-down">

                                            <input type="text"  id="inputPassword2" placeholder="Pretoria or City">
                                        </div>
                                        <div class="breath-left breath-down">
                                            <input type="submit"  value="GO !">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-8 offset-2">
                    <h2>quick links</h2>
                </div>
            </div>
            <div class="row rows">
                <div class="col">
                    <p class="p-top">
                        <img src="http://recruitment.siyakha.io/images/linkability/Linkability_icon_9.png">
                    </p>
                    <p class="p-bottom">
                        COMMERCIAL RECRUITMENT
                    </p>

                </div>
                <div class="col with-borders">
                    <p class="p-top">
                        <img src="http://recruitment.siyakha.io/images/linkability/Linkability_icon_8.pngg">
                    </p>
                    <p class="p-bot">FINANCIAL SECTOR RECRUITMENT</p>
                </div>
                <div class="col">
                    <p class="p-top">
                        <img src="http://recruitment.siyakha.io/images/linkability/Linkability_icon_7.png">
                    </p>
                    <p class="p-bot">ENGINEERING RECRUITMENT</p>
                </div>
                <div class="col">
                    <p class="p-top">
                        <img src="http://recruitment.siyakha.io/images/linkability/Linkability_icon_6.png">
                    </p>
                    <p class="p-bot">IT & TELECOMS RECRUITMENT</p>
                </div>
                <div class="col">
                    <p class="p-top">
                        <img src="http://recruitment.siyakha.io/images/linkability/Linkability_icon_5.png">
                    </p>
                    <p class="p-bot">EXECUTIVE RECRUITMENT</p>
                </div>

            </div>
            <div class="row">
                <div class="col-8 offset-2">
                    <h2 class="black">tips and tricks for your next interview</h2>
                </div>

            </div>

        </div>
    </body>
</html>
