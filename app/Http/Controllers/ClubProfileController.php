<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClubProfileRequest;
use App\Http\Requests\UpdateClubProfileRequest;
use App\Models\ClubProfile;

class ClubProfileController extends Controller
{
    public function index() { return view('club-profiles.index', ['profiles' => ClubProfile::latest()->paginate(10)]); }
    public function create() { return view('club-profiles.create'); }
    public function store(StoreClubProfileRequest $request)
    {
        ClubProfile::create($request->validated() + ['user_id' => auth()->id()]);
        return redirect()->route('club-profiles.index')->with('success', 'Club profile created.');
    }
    public function show(ClubProfile $clubProfile) { return view('club-profiles.show', compact('clubProfile')); }
    public function edit(ClubProfile $clubProfile) { return view('club-profiles.edit', compact('clubProfile')); }
    public function update(UpdateClubProfileRequest $request, ClubProfile $clubProfile)
    {
        $clubProfile->update($request->validated());
        return redirect()->route('club-profiles.index')->with('success', 'Club profile updated.');
    }
    public function destroy(ClubProfile $clubProfile)
    {
        $clubProfile->delete();
        return redirect()->route('club-profiles.index')->with('success', 'Club profile deleted.');
    }
}
