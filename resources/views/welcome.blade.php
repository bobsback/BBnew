@extends('app')

@section('content')
        <!DOCTYPE html>
<html>
<head>
    <title>Bubble Board</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">


    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Exo:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic","Roboto:300,regular","Roboto Condensed:regular","Amaranth:regular,italic,700"]
            }
        });
    </script>
    <script type="text/javascript" src="js/modernizr.js"></script>

</head>
<body>
<div id="PinSearch" class="w-section section hero">
    <div class="w-container container">
        <div class="h12">
            Go beyond
            <div class="para">
                <span class="word white ">suggestion-boxes.</span>
                <span class="word belize">surveys.</span>
                <span class="word pomegranate">emails.</span>
                <span class="word wisteria">water-coolers.</span>
                <span class="word midnight">feedback.</span>
            </div>
        </div>
        <div data-ix="slowload" class="findaboartd">Join a board by entering its password:</div>
        <div class="w-form sign-up-form">
            <form name="wf-form-signup-form" data-name="Signup Form" action="{{ URL::route('board.access-via-pincode') }}" method="POST" class="w-clearfix">
                {{ csrf_field() }}

                <input id="Board-Search" type="text" placeholder="Insert board pin code" name="pincode" data-name="Board Search" required="required" data-ix="load-from-left" class="w-input field">
                <input type="submit" value="Find your board" data-wait="Please wait..." data-ix="load-from-right" class="w-button button">
            </form>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    {{$errors->first()}}
                </div>
            @endif
        </div>
    </div>
</div>

<div id="WhatnWhy" data-anchor="slide1" class="section grey">
    <div class="w-container">
        <div class="w-row">
            <div data-ix="load-from-left" class="w-col w-col-6">
                <h1>What?</h1>
                <div class="desctext">A flexible anonymous private discussion platform for feedback, strategy and ideas.
                </div>
                <div style="padding-top: 56.17021276595745%;" class="w-embed w-video video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/IkUKFdacHvo" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div data-ix="load-from-right" class="w-col w-col-6">
                <h1>Why?</h1>
                <div class="desctext">
                    Find out what your smartest employee and your quietest customer really thinks.
                </div>
                <div style="padding-top: 56.17021276595745%;" class="w-embed w-video video">

                    <iframe width="560" height="315" src="https://www.youtube.com/embed/fPzAABMozs0" frameborder="0" allowfullscreen></iframe>

                </div>
            </div>
        </div>
    </div><img width="874" src="images/front page pic.png" class="board-image">
</div>
<div id="HowitWorks" class="section">
    <div class="w-container">
        <h2 class="grey-heading">How it works</h2>
        <div class="w-row">
            <div data-ix="scrollin" class="w-col w-col-3 howcol1">
                <div class="howtitle">1 Build a Board</div>
                <div class="howdesc">Simply choose a board name and the board blurb.</div><img src="images/Board page v21.jpg">
            </div>
            <div data-ix="scrollin" class="w-col w-col-3 colum2">
                <div class="howtitle">2 Choose your bubble password</div>
                <div class="howdesc">People access your board using the bubble password. So just choose your password.&nbsp;</div><img width="108" src="images/pin code icon.png" class="pincodeicon">
            </div>
            <div data-ix="scrollin-2" class="w-col w-col-3">
                <div class="howtitle">3 Spread the word</div>
                <div class="howdesc">Hey presto you have your bubble board. Now distribute the password to the intended users, we have guides on the best ways to do this.</div><img width="85" src="images/shout icon.png" class="shouticopn">
            </div>
            <div data-ix="scrollin-2" class="w-col w-col-3">
                <div class="howtitle">4 Watch the genius flow</div>
                <div class="howdesc">Sit back and watch the power of collective intelligence.</div><a href="{{ url('/Build') }}" class="w-button buildabb">Build a Bubble Board!</a>
            </div>
        </div>
    </div>
</div>
<div class="w-section section grey">
    <h1>Pricing&nbsp;Table</h1>
    <div class="w-container">
        <div class="w-row">
            <div class="w-col w-col-4 pricetable">
                <h2 class="pricetable">Free&nbsp;</h2>
                <h4>Simple yet&nbsp;Brilliant</h4>
                <div class="featureinfo">1&nbsp;Board</div>
                <div class="featureinfo">Pin&nbsp;Code&nbsp;Access</div>
                <div class="featureinfo">1&nbsp;Admin</div>
                <div class="featureinfo">Basic&nbsp;User&nbsp;Tracking</div>
                <div class="featureinfo">No&nbsp;pinned&nbsp;posts</div>
                <div class="featureinfo final">Chat&nbsp;Only</div><a href="{{ url('/Build') }}" class="w-button buildabb pricei">Build&nbsp;Your&nbsp;Board</a>
            </div>
            <div class="w-col w-col-4">
                <div class="pricetable adv">
                    <h2 class="pricetable">?Better</h2>
                    <h4>Feature Packed</h4>
                    <div class="featureinfo">Unlimmited&nbsp;Subboards</div>
                    <div class="featureinfo">Pin&nbsp;Code&nbsp;+&nbsp;Domain&nbsp;Access</div>
                    <div class="featureinfo">Timed&nbsp;&amp;&nbsp;Permission based Pins</div>
                    <div class="featureinfo">Unlimited&nbsp;Admins</div>
                    <div class="featureinfo">Advance&nbsp;User&nbsp;Tracking</div>
                    <div class="featureinfo">Pinned&nbsp;Posts</div>
                    <div class="featureinfo final">Chat&nbsp;Only</div><a href="{{ url('/about') }}" class="w-button buildabb pricei">Register&nbsp;Interest</a>
                </div>
            </div>
            <div class="w-col w-col-4">
                <div class="pricetable adv">
                    <h2 class="pricetable">Enterprise</h2>
                    <h4>?The&nbsp;Ultimate&nbsp;Tool</h4>
                    <div class="featureinfo">Feature&nbsp;Info</div>
                    <div class="featureinfo">Active&nbsp;Directory&nbsp;Sync</div>
                    <div class="featureinfo">GPS&nbsp;Location&nbsp;Access</div>
                    <div class="featureinfo">Feature&nbsp;Info</div>
                    <div class="featureinfo">Advance&nbsp;User&nbsp;Tracking</div>
                    <div class="featureinfo">Pulse&nbsp;Polls</div>
                    <div class="featureinfo">Advance&nbsp;Analytics</div>
                    <div class="featureinfo final">?Image&nbsp;+&nbsp;Document&nbsp;uploads</div><a href="{{ url('/about') }}" class="w-button buildabb pricei">Register&nbsp;Interest</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Email" class="w-section social-section">
    <div class="w-container convo">
        <h2>Refer your Boss</h2>
        <p>Suggest&nbsp;Bubble&nbsp;Board&nbsp;to&nbsp;someone</p>
        @include ('about.refer')

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/webflow.js"></script>
        <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
        <!-- Hero text JS -->
        <script>
            var words = document.getElementsByClassName('word');
            var wordArray = [];
            var currentWord = 0;

            words[currentWord].style.opacity = 1;
            for (var i = 0; i < words.length; i++) {
                splitLetters(words[i]);
            }

            function changeWord() {
                var cw = wordArray[currentWord];
                var nw = currentWord == words.length-1 ? wordArray[0] : wordArray[currentWord+1];
                for (var i = 0; i < cw.length; i++) {
                    animateLetterOut(cw, i);
                }

                for (var i = 0; i < nw.length; i++) {
                    nw[i].className = 'letter behind';
                    nw[0].parentElement.style.opacity = 1;
                    animateLetterIn(nw, i);
                }

                currentWord = (currentWord == wordArray.length-1) ? 0 : currentWord+1;
            }

            function animateLetterOut(cw, i) {
                setTimeout(function() {
                    cw[i].className = 'letter out';
                }, i*80);
            }

            function animateLetterIn(nw, i) {
                setTimeout(function() {
                    nw[i].className = 'letter in';
                }, 340+(i*80));
            }

            function splitLetters(word) {
                var content = word.innerHTML;
                word.innerHTML = '';
                var letters = [];
                for (var i = 0; i < content.length; i++) {
                    var letter = document.createElement('span');
                    letter.className = 'letter';
                    letter.innerHTML = content.charAt(i);
                    word.appendChild(letter);
                    letters.push(letter);
                }

                wordArray.push(letters);
            }

            changeWord();
            setInterval(changeWord, 4000);





        </script>

    </div>
</div>
</body>
</html>

@endsection
