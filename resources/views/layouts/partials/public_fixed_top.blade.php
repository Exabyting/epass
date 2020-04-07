<nav role="navigation" class="header-navbar navbar-expand-sm navbar navbar-with-menu fixed-top navbar-light navbar-shadow navbar-border">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="brand-logo" alt="bard erp logo" src="{{ asset('images/ec.svg') }}">
                        <h3 class="brand-text">EC</h3>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">

                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon ft-maximize"></i></a></li>
                    <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                   data-toggle="dropdown">More</a>
                        <ul class="mega-dropdown-menu dropdown-menu row">
                            <li class="col-md-2">
                                <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-newspaper-o"></i>
                                    News</h6>
                                <div id="mega-menu-carousel-example">
                                    <div>
                                        <img class="rounded img-fluid mb-1"
                                             src="{{ asset('theme/images/slider/slider-2.png') }}"
                                             alt="First slide"><a class="news-title mb-0" href="#">Poster Frame PSD</a>
                                        <p class="news-content">
                                            <span class="font-small-2">January 26, 2018</span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-3">
                                <h6 class="dropdown-menu-header text-uppercase"><i class="la la-random"></i> Drill down
                                    menu</h6>
                                <ul class="drilldown-menu">
                                    <li class="menu-list">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item" href="layout-2-columns.html"><i
                                                            class="ft-file"></i> Page layouts & Templates</a>
                                            </li>
                                            <li><a href="#"><i class="ft-align-left"></i> Multi level menu</a>
                                                <ul>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                    class="la la-bookmark-o"></i> Second level</a></li>
                                                    <li><a href="#"><i class="la la-lemon-o"></i> Second level menu</a>
                                                        <ul>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-heart-o"></i> Third level</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-file-o"></i> Third level</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-trash-o"></i> Third level</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-clock-o"></i> Third level</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><a class="dropdown-item" href="#"><i class="la la-hdd-o"></i>
                                                            Second level, third link</a></li>
                                                    <li><a class="dropdown-item" href="#"><i class="la la-floppy-o"></i>
                                                            Second level, fourth link</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="color-palette-primary.html"><i
                                                            class="ft-camera"></i> Color palette system</a>
                                            </li>
                                            <li><a class="dropdown-item" href="sk-2-columns.html"><i
                                                            class="ft-edit"></i> Page starter kit</a></li>
                                            <li><a class="dropdown-item" href="changelog.html"><i
                                                            class="ft-minimize-2"></i> Change log</a></li>
                                            <li>
                                                <a class="dropdown-item" href="https://pixinvent.ticksy.com/"><i
                                                            class="la la-life-ring"></i> Customer support center</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3">
                                <h6 class="dropdown-menu-header text-uppercase"><i class="la la-list-ul"></i> Accordion
                                </h6>
                                <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                                    <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                        <div class="card-header p-0 pb-2 border-0" id="headingOne" role="tab"><a
                                                    data-toggle="collapse" data-parent="#accordionWrap"
                                                    href="#accordionOne"
                                                    aria-expanded="true" aria-controls="accordionOne">Accordion Item
                                                #1</a></div>
                                        <div class="card-collapse collapse show" id="accordionOne" role="tabpanel"
                                             aria-labelledby="headingOne"
                                             aria-expanded="true">
                                            <div class="card-content">
                                                <p class="accordion-text text-small-3">Caramels dessert chocolate cake
                                                    pastry jujubes bonbon.
                                                    Jelly wafer jelly beans. Caramels chocolate cake liquorice
                                                    cake wafer jelly beans croissant apple pie.</p>
                                            </div>
                                        </div>
                                        <div class="card-header p-0 pb-2 border-0" id="headingTwo" role="tab"><a
                                                    class="collapsed" data-toggle="collapse"
                                                    data-parent="#accordionWrap"
                                                    href="#accordionTwo" aria-expanded="false"
                                                    aria-controls="accordionTwo">Accordion Item #2</a></div>
                                        <div class="card-collapse collapse" id="accordionTwo" role="tabpanel"
                                             aria-labelledby="headingTwo"
                                             aria-expanded="false">
                                            <div class="card-content">
                                                <p class="accordion-text">Sugar plum bear claw oat cake chocolate jelly
                                                    tiramisu
                                                    dessert pie. Tiramisu macaroon muffin jelly marshmallow
                                                    cake. Pastry oat cake chupa chups.</p>
                                            </div>
                                        </div>
                                        <div class="card-header p-0 pb-2 border-0" id="headingThree" role="tab"><a
                                                    class="collapsed" data-toggle="collapse"
                                                    data-parent="#accordionWrap"
                                                    href="#accordionThree" aria-expanded="false"
                                                    aria-controls="accordionThree">Accordion Item #3</a></div>
                                        <div class="card-collapse collapse" id="accordionThree" role="tabpanel"
                                             aria-labelledby="headingThree"
                                             aria-expanded="false">
                                            <div class="card-content">
                                                <p class="accordion-text">Candy cupcake sugar plum oat cake wafer
                                                    marzipan jujubes
                                                    lollipop macaroon. Cake dragée jujubes donut chocolate
                                                    bar chocolate cake cupcake chocolate topping.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-md-4">
                                <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-envelope-o"></i>
                                    Contact Us</h6>
                                <form class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label" for="inputName1">Name</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative has-icon-left">
                                                    <input class="form-control" type="text" id="inputName1"
                                                           placeholder="John Doe">
                                                    <div class="form-control-position pl-1"><i class="la la-user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label" for="inputEmail1">Email</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative has-icon-left">
                                                    <input class="form-control" type="email" id="inputEmail1"
                                                           placeholder="john@example.com">
                                                    <div class="form-control-position pl-1"><i
                                                                class="la la-envelope-o"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 form-control-label"
                                                   for="inputMessage1">Message</label>
                                            <div class="col-sm-9">
                                                <div class="position-relative has-icon-left">
                                                    <textarea class="form-control" id="inputMessage1" rows="2"
                                                              placeholder="Simple Textarea"></textarea>
                                                    <div class="form-control-position pl-1"><i
                                                                class="la la-commenting-o"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mb-1">
                                                <button class="btn btn-info float-right" type="button"><i
                                                            class="la la-paper-plane-o"></i> Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i
                                    class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text" placeholder="Explore BARD...">
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>
