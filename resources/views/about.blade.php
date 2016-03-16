<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bubble Board</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/vendor/comments/css/prism-okaidia.css"> <!-- Optional -->
    <link rel="stylesheet" href="/vendor/comments/css/comments.css">

    {!! Html::style('css/reset.css') !!}
    {!! Html::style('css/faq.css') !!}
    {!! Html::style('css/normalize.css') !!}
    {!! Html::style('css/webflow.css') !!}
    {!! Html::style('css/bubbl-board-beta.webflow.css') !!}

            <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script type="text/javascript" src="/js/modernizr.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <script src="js/modernizr.js"></script> <!-- Modernizr -->
</head>
<div class="w-section navbar">
    <div class="w-container">
        <div class="w-row containersss">
            <div class="w-col w-col-4 w-col-small-6 w-col-tiny-6 left-nav">
                <a href="{{ url('/') }}" class="w-inline-block">{!! HTML::image('images/bboard logo v1 white.png', 'Logo', array('width' => 264, 'class' => 'logo'))!!}
                </a>

            </div>
            <div class="w-col w-col-8 w-col-small-6 w-col-tiny-6 w-clearfix right-nav">
                <div class="w-hidden-medium w-hidden-small w-hidden-tiny in3min">In 1 min for free!</div>
                <div data-collapse="medium" data-animation="default" data-duration="400" data-contain="1" class="w-nav nav-bar">
                    <div class="w-container navbar2" id="navbar1">
                        <nav role="navigation" class="w-nav-menu">



                            @if(auth()->guest())
                                @if(!Request::is('auth/login'))
                                    <a class="w-nav-link link2"  href="{{ url('/auth/login') }}">Login</a>
                                @endif
                                @if(!Request::is('auth/register'))
                                    <a class="w-nav-link link2" href="{{ url('/auth/register') }}">Register</a>
                                @endif
                            @else

                                <a href="#" class="w-nav-link link2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdownlog" role="menu">

                                    <a class="link3" href="{{ url('/auth/logout') }}">Logout</a>

                                </ul>
                                <a href="{{ url('/board') }}"  class="w-nav-link link2">Your Boards</a>
                            @endif

                            <a href="{{ url('/about') }}" class="w-nav-link link2">Info</a>


                            <a href="{{ url('/Build') }}" class="w-nav-link link">Build a Board!</a>

                        </nav>
                        <div class="w-nav-button menubutton">
                            <div class="w-icon-nav-menu menu-icon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-hidden-tiny just-do-it">Beta (but omg it's going to be good)
        <form class="search-container" data-name="Signup Form" action="{{ URL::route('board.access-via-pincode') }}" method="POST" >
            {{ csrf_field() }}
            <input id="board-search" placeholder="Enter a Board Pin" type="text" class="search-box" name="pincode" data-name="Board Search" required="required" />
            <label for="search-box"><span class="glyphicon glyphicon-search search-icon"></span></label>
            <input type="submit" id="search-submit" />
        </form>
    </div>
</div>




<div class="w-section section hero">
    <div class="w-container container">
        <h2>About & FAQ</h2>
        <p>Where are you</p>
    </div>
</div>

<div class="w-section aboutsection">

    <section class="cd-faq">
        <ul class="cd-faq-categories">
            <li><a href="#Contact">Contact</a></li>
            <li><a href="#basics">About</a></li>
            <li><a href="#mobile">Mobile Apps</a></li>
            <li><a href="#account">Moderator</a></li>
        </ul> <!-- cd-faq-categories -->

        <div class="cd-faq-items">
            <ul id="Contact" class="cd-faq-group">
                <li class="cd-faq-title"><h2>Contact</h2></li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Contact us</a>
                    <div class="cd-faq-content">
                        Any feedback about bubble board use our bubble board password: 'bubble' at <a href="http://bubbleboard.dev/board/bubbleboard"> Bubbles Board</a> or contact us directly:
                        <br>
                            @include ('about.contact')
                        <p>Or hit me up directly at rob@bubbleboard.co.uk</p>
                    </div> <!-- cd-faq-content -->
                </li>
            </ul>
            <ul id="basics" class="cd-faq-group">
                <li class="cd-faq-title"><h2>About</h2></li>
                <li>
                    <a class="cd-faq-trigger" href="#0">About</a>
                    <div class="cd-faq-content"><p>
                       Bubble board is a SaaS start up that aims to revolutionise how people give
                            feedback and communicate ideas (thought bubbles). We want to ultimately be
                            inspirational in facilitating positive change in businesses and organisation through the power of their
                            employees and customers. Why hire consultants to tell you whats wrong when all the answers are already in your grasp.
                            At the moment we are currently testing our beta product and looking for customers.
                        <img width="147" src="images/face.jpg" class="myface">
                        <div class="imagesubhead">BB's brave leader (2010)</div></p>
                    </div> <!-- cd-faq-content -->
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Feature Developement</a>
                    <div class="cd-faq-content"><p>
                        We are looking to include a few more features; advance passwords that time out or have different levels of access, subboards, advance ways to join a board,
                        with more advance user analysis, discussion options and business to customer interactions.</p>
                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">How can people access a bubble board?</a>
                    <div class="cd-faq-content">
                        <p>For the beta each boards password is unique, anyone with a board's password can access that board via the homepage or by visiting the boarsd url.</p>
                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">Do I need an account to access a board?</a>
                    <div class="cd-faq-content">
                        <p>You do not need an account to enter a board and leave some feedback. <br>
                        You do need an account to build a board and you need an account to save boards to revisit them.</p>
                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">How long will the beta be for?</a>
                    <div class="cd-faq-content">
                        <p>The time frame is for the product to be in beta for 2-4 months before the final version.</p>
                    </div> <!-- cd-faq-content -->
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">What can people do on the boards?</a>
                    <div class="cd-faq-content">
                        <p>The discussion system is a multi-level comment system with voting, users can also post images using URLs, we are working to include file uploads and polls.</p>
                    </div> <!-- cd-faq-content -->
                </li>
            </ul> <!-- cd-faq-group -->

            <ul id="mobile" class="cd-faq-group">
                <li class="cd-faq-title"><h2>Mobile Apps</h2></li>
                <li>
                    <a class="cd-faq-trigger" href="#0">When are the mobile apps coming?</a>
                    <div class="cd-faq-content">
                        <p>The first iteration of the mobile apps (android and iphone) will hopefully be available in 1-2 months time.</p>
                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">What will be in the mobile apps?</a>
                    <div class="cd-faq-content">
                        <p>The first iteration of the mobile apps (android and iphone) will just be for users who want to enter the boards and leave comments.</p>
                    </div> <!-- cd-faq-content -->
                </li>

            </ul> <!-- cd-faq-group -->

            <ul id="account" class="cd-faq-group">
                <li class="cd-faq-title"><h2>Moderator</h2></li>
                <li>
                    <a class="cd-faq-trigger" href="#0">How can people access my board?</a>
                    <div class="cd-faq-content">
                        <p>It's very simple, they either enter the password on bubble boards homepage or visit the board url directly and then use the boards password.
                        </p>
                    </div> <!-- cd-faq-content -->

                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">How do I ban users?</a>
                    <div class="cd-faq-content">
                        <p>You can ban users by using the 'Moderate comments' tab, finding the users comment and clicking ban (which appears when you hover over the comment) this bans the users ip address and they wont be able to enter the board. You can unban users by visiting the 'view bans' tab from the moderator control panel.</p>
                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">How should I share my board with people?</a>
                    <div class="cd-faq-content">
                        <p>All people need to enter your board is the password you set, so if you send them that they can access the board from the homepage, you can change the password at any time to prevent people from finding your board but the board will be saved for users who logged in and saved the board.</p>
                    </div> <!-- cd-faq-content -->
                </li>
            </ul> <!-- cd-faq-group -->


        </div> <!-- cd-faq-items -->
        <a href="#0" class="cd-close-panel">Close</a>
    </section>
</div>

    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/jquery.mobile.custom.min.js"></script>
    <script src="js/main.js"></script> <!-- Resource jQuery -->

<div class="w-section section grey">
    <div class="w-container">
        <div class="w-row">
            <div class="w-col w-col-4">
                <div class="w-widget w-widget-twitter">
                    <iframe src="https://platform.twitter.com/widgets/follow_button.html#screen_name=bubbleboardyes&amp;show_count=true&amp;size=m&amp;show_screen_name=true&amp;dnt=true" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 100%; height: 20px;"></iframe>
                </div>
                <div class="w-widget w-widget-facebook">
                    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FBubbleboard%2F&amp;layout=button_count&amp;locale=en_US&amp;action=like&amp;show_faces=false&amp;share=false" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 90px; height: 20px;"></iframe>
                </div>
                <div class="w-widget w-widget-twitter">
                    <iframe src="https://platform.twitter.com/widgets/tweet_button.html#url=http%3A%2F%2Fbubbleboard.co.uk&amp;counturl=bubbleboard.co.uk&amp;text=This%20looks%20a%20touch%20awesome&amp;count=horizontal&amp;size=m&amp;dnt=true" scrolling="no" frameborder="0" allowtransparency="true" style="border: none; overflow: hidden; width: 110px; height: 20px;"></iframe>
                </div>
            </div>
            <div class="w-col w-col-4 footer-central-colum">
                <div class="footerh1">This is the site footer</div><a href="{{ url('/') }}" class="footerlink">Find out about Bubble Board</a><a href="{{ url('/auth/login') }}" class="footerlink">Login - login into your board</a><a href="{{ url('/Build') }}" class="footerlink">Build a bubble board</a>
                <div class="footerh1">Everything here is copyrighted etc etc.&nbsp;</div>
            </div>
            <div class="w-col w-col-4">{!! HTML::image('images/appscomingsoon.png', 'Logo', array('width' => 150))!!}

            </div>
        </div>
    </div>
</div>