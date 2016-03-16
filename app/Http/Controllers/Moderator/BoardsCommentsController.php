<?php

namespace Hazzard\Comments\Http\Controllers\Moderator;

use App\Board;
use Illuminate\Http\Request;
use Hazzard\Comments\Comments\Comment;
use Hazzard\Comments\Jobs\DeleteComment;
use Hazzard\Comments\Jobs\UpdateComment;
use Hazzard\Comments\Jobs\BulkCommentUpdate;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Hazzard\Comments\Jobs\FetchCommentsModerator;
use Hazzard\Comments\Http\Middleware\BoardModerator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Hazzard\Comments\Http\Controllers\BaseDashboardController;

/**
 * Class BoardsCommentsController
 *
 * @package Hazzard\Comments\Http\Controllers\Moderator
 */
class BoardsCommentsController extends BaseDashboardController
{

    use DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        app('comments');

        Comment::$admin = true;

        $this->middleware(BoardModerator::class);
    }

    /**
     * Index.
     *
     */
    public function index(Request $request, $boardId)
    {
        $board = Board::findOrFail($boardId);

        $args = [
            'page' => (int) $request->input('page', 1),
            'status' => $request->input('status', 'all'),
            'pageId' => $request->input('page_id'),
            'board' => $board
        ];

        if ($request->ajax()) {
            return \Response::json($this->dispatch(new FetchCommentsModerator($args)));
        }

        return view('comments::moderator.dashboard', $args);
    }

    /**
     * Edit.
     *
     */
    public function edit($boardId, $id)
    {
        return \Response::json(Comment::findOrFail($id));
    }

    /**
     * Update.
     *
     */
    public function update(Request $request, $boardId, $id = null)
    {
        if ($ids = $request->input('ids')) {
            return $this->dispatch(new BulkCommentUpdate($ids, $request->input('status')));
        }

        $input = $request->only('author_name', 'author_email', 'author_url', 'content', 'status');
        $input['author_name'] = e($input['author_name']);

        $validator = $this->validateForUpdate($input);

        if ($validator->fails()) {
            $errors = $validator->errors();

            foreach ($input as $key => $value) {
                if ($errors->has($key)) {
                    unset($input[$key]);
                }
            }
        }

        $comment = Comment::findOrFail($id);

        $this->dispatch(new UpdateComment($comment, $input));

        return \Response::json($comment);
    }

    /**
     * Destroy.
     *
     */
    public function destroy(Request $request, $boardId, $id)
    {
        $this->dispatch(new DeleteComment($id));

        return \Response::json(null, 204);
    }
}
