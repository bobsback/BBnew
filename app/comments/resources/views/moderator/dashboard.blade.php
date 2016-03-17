@extends('comments::moderator.layout')

@section('title')
    Manage {{ $board->boardname }} board
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
            Messages
        </li>
    </ol>

    <div id="comments" v-show="init" style="display: none;">
        <ul class="status-filter">
            <li class="active">
                <a href="?status=all" class="all">
                    All Recent Messages
                </a>
            </li>
        </ul>

        <form v-on="submit: bulkUpdate">
            <input type="hidden" v-model="page" value="{{ $page }}">
            <input type="hidden" v-model="status" value="{{ $status }}">
            <input type="hidden" v-model="pageId" value="{{ $pageId }}">

            <div class="bulk-actions">
                <select v-model="bulkAction" class="form-control">
                    <option value="0">Bulk Actions</option>
                    <option value="delete">Delete Permanently</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Apply</button>
            </div>

            <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="column-check">
                            <input type="checkbox" v-on="click: markAll" v-model="markedAll" title="Mark all comments">
                        </th>
                        <th class="column-author">Author</th>
                        <th class="column-comment">Comment</th>
                        <th class="column-page">In Response To</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-show="pagination.total" v-repeat="comment: comments" v-class="warning: highlighted(comment)">
                        <td>
                            <input type="checkbox" v-model="comment.mark" v-on="click: mark" title="Mark this comment">
                        </td>
                        <td class="column-author">
                            <div>
                                <img v-attr="src: comment.author.avatar">
                                <b>@{{ comment.author.name }}</b>
                                <small>@{{ comment.user_id ? '(user)' : '' }}</small>
                            </div>
                            <div>
                                <a href="mailto:@{{ comment.author.email }}">
                                    @{{ comment.author.email }}
                                </a>
                            </div>
                            <div v-if="comment.author.url">
                                <a href="@{{ comment.author.url }}" target="_blank">
                                    @{{ comment.author.url }}
                                </a>
                            </div>
                            <a href="http://whatismyipaddress.com/ip/@{{ comment.author.ip }}" target="_blank"
                               data-toggle="tooltip" data-original-title="@{{ comment.user_agent }}">
                                @{{ comment.author.ip }}
                            </a>
                        </td>
                        <td class="column-comment">
                            <div class="submitted-on">
                                Submitted
                                <a href="@{{ comment.permalink }}" title="@{{ comment.created_at.timestamp }}">
                                    @{{ comment.created_at.diff }}
                                </a>
                                <template v-if="comment.parent">
                                    in reply to <a href="@{{ comment.parent.permalink }}">@{{ comment.parent.author.name }}</a>
                                </template>
                            </div>

                            <div class="content">
                                @{{ comment.content }}
                            </div>

                            <div class="row-actions">
                                <span v-if="comment.status !== 'trash' && comment.status !== 'spam'">
                                    <a href="#!edit=@{{ comment.id }}" v-on="click: editComment = comment">Edit</a>
                                </span>

                                <span>
                                    | <a href="#" class="delete" v-on="click: destroy(comment, $event)">Delete Permanently</a>
                                </span>

                                <span>
                                    | <a href="#" class="delete ban-user-toggle" data-board-id="{{ $board->id }}" data-user-ip="@{{ comment.author.ip }}">
                                        Ban User
                                    </a>
                                </span>
                            </div>
                        </td>
                        <td>
                            <a href="?page_id=@{{ comment.page_id }}" class="page-com-count">
                                <span class="label label-primary">
                                    @{{ pageCount[comment.page_id] || 0 }}
                                </span>
                            </a>
                            <a href="@{{ comment.permalink }}">View Page</a>
                        </td>
                    </tr>
                    <tr v-if="!pagination.total">
                        <td colspan="4" class="text-center">
                            <div v-show="loading" class="spinner">Loading...</div>
                            <template v-if="!loading">No comments found.</template>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </form>

        <div class="text-center" v-if="pagination.total && pagination.total > pagination.per_page">
            <div class="pull-left">
                <div class="pull-left">@{{ pagination.total }} comment(s)</div>
            </div>
            <div class="pull-right">
                <ul class="pagination pagination-sm">
                    <li v-if="pagination.current_page !== 1">
                        <a href="?page_id={{ $pageId }}&page=@{{ pagination.prev_page }}">&laquo;</a>
                    </li>
                    <li v-if="pagination.current_page === 1" class="disabled">
                        <span>&laquo;</span>
                    </li>
                    <li v-if="pagination.first_adjacent_page > 1">
                        <a href="?page_id={{ $pageId }}&page=1">1</a>
                    </li>
                    <li v-if="pagination.first_adjacent_page > 2" class="disabled"><a>...</a></li>
                    <template v-repeat="pagination.last_adjacent_page">
                        <li v-if="$index + 1 >= pagination.first_adjacent_page" v-class="active: pagination.current_page == $index + 1">
                            <a href="?page_id={{ $pageId }}&page=@{{ $index + 1 }}">@{{ $index + 1 }}</a>
                        </li>
                    </template>
                    <li v-if="pagination.last_adjacent_page < pagination.last_page - 1" class="disabled"><a>...</a></li>
                    <li v-if="pagination.last_adjacent_page < pagination.last_page">
                        <a href="?page_id={{ $pageId }}&page=@{{ pagination.last_page }}">@{{ pagination.last_page }}</a>
                    </li>
                    <li v-if="pagination.current_page < pagination.last_page">
                        <a href="?page_id={{ $pageId }}&page=@{{ pagination.next_page }}">&raquo;</a>
                    </li>
                    <li v-if="pagination.current_page === pagination.last_page" class="disabled">
                        <span>&raquo;</span>
                    </li>
                </ul>
            </div>
        </div>

        <edit-modal comment="@{{ editComment }}" on-close="@{{ onCloseEdit }}" config="@{{ config }}"></edit-modal>
    </div>

    <script type="text/x-template" id="edit-modal-template">@include('comments::admin/partials/edit-modal')</script>

    {!!Form::open(['method' =>'DELETE','route'=>['board.destroy',$board->boardname]])!!}


    {!! Form::submit('Permanently Delete Board',['class'=> 'btn btn-danger']) !!}


    {!! Form::close() !!}
@stop
