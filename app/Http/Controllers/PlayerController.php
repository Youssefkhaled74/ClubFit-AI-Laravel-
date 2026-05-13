<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;

class PlayerController extends Controller
{
    public function index() { return view('players.index', ['players' => Player::latest()->paginate(10)]); }
    public function create() { return view('players.create'); }
    public function store(StorePlayerRequest $request)
    {
        Player::create($request->validated());
        return redirect()->route('players.index')->with('success', 'Player added.');
    }
    public function show(Player $player) { return view('players.show', compact('player')); }
    public function edit(Player $player) { return view('players.edit', compact('player')); }
    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $player->update($request->validated());
        return redirect()->route('players.index')->with('success', 'Player updated.');
    }
    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('players.index')->with('success', 'Player removed.');
    }
}
