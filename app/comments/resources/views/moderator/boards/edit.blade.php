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
        <li>
            <a href="{{ URL::route('moderator.boards.index') }}">
                Boards
            </a>
        </li>
        <li class="active">
            Edit
        </li>
    </ol>

    <h2>
        Edit {{ $board->boardname }}
    </h2>

    <form action="{{ URL::route('moderator.boards.update', $board->id) }}" method="POST">
        {{ csrf_field() }}

        <input name="_method" type="hidden" value="PUT">

        <div class="form-group">
            {!! Form::label('boardblurb', 'Board Blurb', ['class' => 'w-form-label checkboxtext']) !!} <br>

            {!! Form::textarea('boardblurb', $board->boardblurb, ['class' => 'h100']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('pincode', 'Pincode', ['class' => 'w-form-label checkboxtext']) !!}

            {!! Form::text('pincode', $board->pincode, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Update Board', ['class' => 'btn btn-primary']) !!}
    </form>
@stop
