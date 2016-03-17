<div class="navbar navbar-top navbar-fixed-top">
    <div class="container">
        <div class="col-md-11 col-md-offset-1">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="{{ url('/') }}" class="">{!! HTML::image('images/bboard logo v1 white.png', 'Logo', array('width' => 170, 'class' => 'logo'))!!}
                </a>
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Route::is('comments.admin.index') ? 'active' : '' }}">
                        <a class="white" href="{{ route('moderator.boards.index') }}">
                            <span class="glyphicon glyphicon-comment"></span> Your Boards
                        </a>

                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a  href="{{ url('/about') }}">Info</a></li>
                    <li><a  href="{{ url('/Build') }}">Build a New Board</a></li>
                    <li><a  href="/auth/logout">
                        <span class="glyphicon glyphicon-log-out"></span> Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
