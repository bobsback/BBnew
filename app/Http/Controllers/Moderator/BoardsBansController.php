<?php

namespace Hazzard\Comments\Http\Controllers\Moderator;

use App\Board;
use App\BoardBan;
use Illuminate\Http\Request;
use Hazzard\Comments\Http\Middleware\BoardModerator;
use Hazzard\Comments\Http\Controllers\BaseDashboardController;

/**
 * Class BoardsBansController
 *
 * @package Hazzard\Comments\Http\Controllers\Moderator
 */
class BoardsBansController extends BaseDashboardController
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware(BoardModerator::class);
    }

    /**
     * Index.
     *
     */
    public function index(Request $request, $boardId)
    {
        $board = Board::findOrFail($boardId);

        return view('comments::moderator.boards.bans.index')->with(compact('board'));
    }

    /**
     * Store.
     *
     */
    public function store(Request $request, $boardId)
    {
        $board = Board::findOrFail($boardId);

        $boardBan = new BoardBan([
            'board_id' => $board->id,
            'ip_address' => ip2long(request()->input('ip_address'))
        ]);

        $boardBan->save();
    }

    /**
     * Destroy.
     *
     */
    public function destroy(Request $request, $boardId, $boardBanId)
    {
        Board::findOrFail($boardId);

        $boardBan = BoardBan::findOrFail($boardBanId);

        $boardBan->delete();
    }
}
