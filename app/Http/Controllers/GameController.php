<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoveGameRequest;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    protected GameService $gameService;

    public function __construct()
    {
        $this->gameService = new GameService();
    }

    public function index()
    {
        return view('game.games')->with('games', $this->gameService->games());
    }

    public function create()
    {
        return view('game.create');
    }

    public function store(StoreGameRequest $request)
    {

        $res = $this->gameService->create($request->validated());

        return redirect()->route('games.create')->with('msg', $res['message']);
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        $game = $this->gameService->find($id);

        if (!$game) {
            abort(404);
        }

        return view('game.edit')->with('game', $game);
    }

    public function update(UpdateGameRequest $request, $id)
    {
        $res = $this->gameService->update($request->validated(), $id);

        return redirect()->route('games.edit', $id)->with('msg', $res['message']);
    }

    public function destroy(RemoveGameRequest $request, $id)
    {
        $res = $this->gameService->delete($id);
        return redirect()->route('games.index')->with('msg', $res['message']);
    }

    public function changeImage(Request $request, int $id)
    {
        $image = $request->file('image');
        $res = $this->gameService->changeImage($image, $id);
        return redirect()->route('games.edit', $id)->with('msg', $res['message']);
    }
}
