<?php

namespace Hazzard\Comments\Http\Controllers\Moderator;

use App\Board;
use Illuminate\Http\Request;
use Hazzard\Comments\Http\Middleware\Moderator;
use Hazzard\Comments\Http\Controllers\BaseDashboardController;

/**
 * Class BoardsController
 *
 * @package Hazzard\Comments\Http\Controllers\Moderator
 */
class BoardsController extends BaseDashboardController
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware(Moderator::class);
    }

    /**
     * Index.
     *
     */
    public function index(Request $request)
    {
        $boards = \Auth::user()->moderator->boards;

        return view('comments::moderator.boards.index')->with(compact('boards'));
    }

    /**
     * Edit.
     *
     */
    public function edit(Request $request)
    {
        $board = Board::findOrFail($request->boards);

        return view('comments::moderator.boards.edit')->with(compact('board'));
    }

    /**
     * Update.
     *
     */
    public function update(Request $request)
    {
        $board = Board::findOrFail($request->boards);

        $board->fill($request->input())->save();

        return redirect()->route('moderator.boards.index');
    }

}
