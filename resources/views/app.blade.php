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
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

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

<div class="w-section navbar">
    <div class="w-container">
        <div class="w-row containersss">
            <div class="w-col w-col-4 w-col-small-6 w-col-tiny-6 left-nav">
                <a href="{{ url('/') }}" class="w-inline-block">{!! Html::image('images/bboard logo v1 white.png', 'Logo', array('width' => 264, 'class' => 'logo'))!!}
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

                                        <a class="link3" href="{{ url('/logout') }}">Logout</a>

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



	@yield('content')
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
            <div class="w-col w-col-4">{!! Html::image('images/appscomingsoon.png', 'Logo', array('width' => 150))!!}

            </div>
        </div>
    </div>
</div>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<!-- This must be included before the closing </body> tag! -->
	<script src="/vendor/comments/js/comments.js"></script>
	<!-- Search form -->
	<script> document.addEventListener("touchstart", function(){}, true);</script>


</body>
</html>
