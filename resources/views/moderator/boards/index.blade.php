@extends('comments::moderator.layout')

@section('title')
    Manage boards
@stop

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{ URL::to('/') }}">
                Home
            </a>
        </li>
        <li class="active">
            Boards
        </li>
    </ol>

    <table class="table table-striped">
        <thead>
            <tr>

                <th class="column-author">Your Boards</th>
                <th class="column-comment">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($boards->count())
                @foreach($boards as $board)
                    <tr>
                        <td><a class="btn btn-success" href="{{ URL::to('board/' . $board->boardname) }}">
                            {{ $board->boardname }}
                                    </a>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ URL::route('moderator.boards.edit', $board->id) }}">
                                Invite Users
                            </a>
                            <a class="btn btn-primary" href="{{ URL::route('moderator.boards.edit', $board->id) }}">
                                Edit Details
                            </a>

                            <a class="btn btn-warning" href="{{ URL::route('moderator.boards.comments.index', $board->id) }}">
                                Moderate Comments
                            </a>

                            <a class="btn btn-danger" href="{{ URL::route('moderator.boards.bans.index', $board->id) }}">
                                View Bans
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">
                        No boards found.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@stop
