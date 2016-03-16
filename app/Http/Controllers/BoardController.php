<?php

namespace App\Http\Controllers;

use Auth;
use App\Board;
use App\Moderator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckIfBanned;
use App\Http\Requests\CreateBoardrequest;
use App\Http\Middleware\CheckIfBoardSaved;

/**
 * Class BoardController
 *
 * @package App\Http\Controllers
 */
class BoardController extends Controller
{

    /**
     * Initialize controller instance.
     *
     * @param Board $board
     */
    public function __construct(Board $board)
    {
        $this->board = $board;



        $this->user = \Auth::user();

        $this->middleware(Authenticate::class, ['only' => ['index', 'create', 'save']]);

        $this->middleware(CheckIfBanned::class, ['except' => ['index', 'update', 'store', 'save']]);

        $this->middleware(CheckIfBoardSaved::class, ['only' => ['show', 'save']]);
    }

    /**
     * Index.
     *
     */
    public function index()
    {
        $boards = $this->user->boards()->get();
        $user = Auth::user();
        return view('board', compact('boards', 'user'));
    }

    /**
     * Show.
     *
     */
    public function show(Board $board)
    {
        $boards = [];
        if ($this->user) {
            $boards = $this->user->boards()->get();
        }
        $user = Auth::user();

        return view('theboard', compact('board', 'boards', 'user'));
    }

    /**
     * Edit.
     *
     */
    public function edit(Board $board)
    {
        return view('boardedit', compact('board'));
    }

    /**
     * Update.
     *
     */
    public function update(Board $board, Request $request)
    {
        $board->fill($request->input())->save();

        return redirect('board');
    }

    /**
     * Create.
     *
     */
    public function create(Board $board, Request $request)
    {
        return view('build');
    }

    /**
     * Store.
     *
     */
    public function store(Board $board, CreateBoardrequest $request)
    {
        $board = $board->create($request->all());

        $board->users()->attach($this->user);

        $board->moderators()->attach(Moderator::findByUserIdOrCreate($this->user->id));

        return redirect('board');
    }

    /**
     * Destroy.
     *
     */
    public function destroy(Board $board)
    {
        $board->delete();

        return redirect('board');
    }

    /**
     * Access via pincode.
     *
     */
    public function accessViaPincode(Request $request)
    {
        if (!($board = Board::where('pincode', '=', $request->input('pincode'))->first())) {

            return redirect('/')->withErrors(['The board pin code you entered does not match any currently in use :(', 'The Message']);
        }

        $this->setAuthorizedBoardSession($board->id);

        return redirect('board/' . $board->boardname);
    }

    /**
     * Get authorize.
     *
     */
    public function getAuthorize(Board $board)
    {
        return view('board.authorize')->with(compact('board'));
    }

    /**
     * Post authorize.
     *
     */
    public function postAuthorize(Request $request, Board $board)
    {
        if ($board->pincode != $request->input('pincode')) {
            return redirect()->route('board.authorize', $board->boardname)->with('error', 'Invalid PIN Code provided');
        }

        $this->setAuthorizedBoardSession($board->id);

        return redirect()->to('board/' . $board->boardname);
    }

    /**
     * Save.
     *
     */
    public function save(Request $request, Board $board)
    {
        if (!$board->users->contains($this->user)) {
            $board->users()->attach($this->user);
        }

        return redirect()->back();
    }

    /**
     * Set authorized board session.
     *
     * @param $boardId
     */
    private function setAuthorizedBoardSession($boardId)
    {
        session()->set('board.' . $boardId . '.authorized', true);
    }
}
