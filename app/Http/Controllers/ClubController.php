<?php

namespace App\Http\Controllers;

use App\Enums\NeedLevel;
use App\Enums\NeedPriority;
use App\Enums\PressingStyle;
use App\Enums\RiskAppetite;
use App\Http\Requests\StoreClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Club;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ClubController extends Controller
{
    public function index(): View
    {
        $clubs = Club::with(['tacticalProfile', 'financialRule'])->latest()->paginate(10);
        return view('clubs.index', compact('clubs'));
    }

    public function create(): View
    {
        return view('clubs.create', $this->formData(new Club()));
    }

    public function store(StoreClubRequest $request): RedirectResponse
    {
        $club = DB::transaction(function () use ($request) {
            $data = $request->validated();
            $club = Club::create(array_merge($this->baseClubData($data), ['created_by' => auth()->id()]));
            $this->upsertRelations($club, $data);
            return $club;
        });

        return redirect()->route('clubs.show', $club)->with('success', 'Club profile setup saved successfully.');
    }

    public function show(Club $club): View
    {
        $club->load(['identity','tacticalProfile','financialRule','recruitmentPolicy','medicalPolicy','squadNeeds','teamMetrics','staff','contractRule','marketStrategy']);
        return view('clubs.show', compact('club'));
    }

    public function edit(Club $club): View
    {
        $club->load(['identity','tacticalProfile','financialRule','recruitmentPolicy','medicalPolicy','squadNeeds','teamMetrics','staff','contractRule','marketStrategy']);
        return view('clubs.edit', $this->formData($club));
    }

    public function update(UpdateClubRequest $request, Club $club): RedirectResponse
    {
        DB::transaction(function () use ($request, $club) {
            $data = $request->validated();
            $club->update($this->baseClubData($data));
            $this->upsertRelations($club, $data);
        });

        return redirect()->route('clubs.show', $club)->with('success', 'Club profile updated successfully.');
    }

    public function destroy(Club $club): RedirectResponse
    {
        $club->delete();
        return redirect()->route('clubs.index')->with('success', 'Club deleted.');
    }

    private function formData(Club $club): array
    {
        return [
            'club' => $club,
            'pressingStyles' => PressingStyle::cases(),
            'riskAppetites' => RiskAppetite::cases(),
            'needLevels' => NeedLevel::cases(),
            'needPriorities' => NeedPriority::cases(),
            'formations' => ['4-3-3', '4-2-3-1', '3-4-2-1', '3-5-2', '4-4-2'],
        ];
    }

    private function baseClubData(array $data): array
    {
        return collect($data)->only(['name','country','league','season','logo','primary_color','secondary_color','currency','club_level'])->all();
    }

    private function upsertRelations(Club $club, array $data): void
    {
        $club->identity()->updateOrCreate([], $data['identity'] ?? []);
        $club->tacticalProfile()->updateOrCreate([], $data['tactical'] ?? []);
        $club->financialRule()->updateOrCreate([], $data['financial'] ?? []);
        $club->recruitmentPolicy()->updateOrCreate([], $data['recruitment'] ?? []);
        $club->medicalPolicy()->updateOrCreate([], $data['medical'] ?? []);
        $club->contractRule()->updateOrCreate([], $data['contract'] ?? []);
        $club->marketStrategy()->updateOrCreate([], $data['market'] ?? []);

        if (isset($data['squad_needs'])) {
            $club->squadNeeds()->delete();
            foreach ($data['squad_needs'] as $need) {
                $club->squadNeeds()->create($need);
            }
        }

        if (isset($data['team_metrics'])) {
            $club->teamMetrics()->delete();
            foreach ($data['team_metrics'] as $metric) {
                $club->teamMetrics()->create($metric);
            }
        }

        if (isset($data['staff'])) {
            $club->staff()->delete();
            foreach ($data['staff'] as $staff) {
                $club->staff()->create($staff);
            }
        }
    }
}
