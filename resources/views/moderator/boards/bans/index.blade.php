@extends('comments::moderator.layout')

@section('title')
    Manage board "{{ $board->boardname }}" bans
@stop

@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{ URL::to('/') }}">
                Home
            </a>
        </li>
        <li>
            <a href="{{ URL::route('moderator.boards.index') }}">
                Boards
            </a>
        </li>
        <li class="active">
            Bans
        </li>
    </ol>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th class="column-author">IP Address</th>
                <th class="column-comment">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($board->bans->count())
                @foreach($board->bans as $ban)
                    <tr>
                        <td>
                            {{ $ban->id }}
                        </td>
                        <td>
                            {{ long2ip($ban->ip_address) }}
                        </td>
                        <td>
                            <a class="btn btn-danger delete-ban-toggle" href="{{ URL::route('moderator.boards.bans.destroy', [$board->id, $ban->id]) }}">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">
                        No board bans found.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@stop
