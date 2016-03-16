@extends('app')

@section('content')
    <div class="w-section section hero">
        <div class="w-container container">
            <h2>Things about your account</h2>
            <div  class="findaboartd">Go to a new board:</div>
            <div class="w-form sign-up-form">
                <form name="wf-form-signup-form" data-name="Signup Form" action="{{ URL::route('board.access-via-pincode') }}" method="POST" class="w-clearfix">
                    {{ csrf_field() }}

                    <input id="Board-Search" type="text" placeholder="Insert board pin code" name="pincode" data-name="Board Search" required="required"  class="w-input field">
                    <input type="submit" value="Find your board" data-wait="Please wait..."  class="w-button button">
                </form>

            </div>
        </div>
    </div>
    <div class="w-section yourboardinfo">
        <div class="w-container container">

            <div class="">
                <h2 class="white">Your Saved Boards</h2>

                <table class="table">
                    <thead>
                    <tr>
                        <th class="white">Name</th>
                        <th class="white">Blurb</th>
                        <th class="white">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($boards->count())
                        @foreach($boards as $board)
                            <tr>
                                <td>
                                    <a class="w-button link" href="{{ URL::to('board/' . $board->boardname) }}">
                                        {{ $board->boardname }}

                                    </a>
                                </td>
                                <td>
                                    <div class="white ">{{ $board->boardblurb }}
                                </td>
                                <td>

                                        <!-- RE-ADD MODERATORE BUTTON WHEN USER VARABLE WORKS AGAIN -->
                                    @if($user && $user->isModerator($board->id))
                                        <a class="btn btn-primary btn-xs greenbground" href="{{ URL::route('moderator.boards.index', $board->id) }}">
                                            <i class="fa fa-cogs "></i> Manage
                                        </a>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="white" colspan="3">
                                No boards found :(<br>Enter a Bubble Board using the passkey and make sure to click 'save board'!
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>




@endsection