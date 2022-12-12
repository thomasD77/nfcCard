<?php

namespace App\Http\Livewire;

use App\Models\listUrl;
use App\Models\Material;
use App\Models\Member;
use App\Models\Role;
use App\Models\Team;
use App\Models\Type;
use App\Models\URL;
use App\Models\User;
use App\Swap\Filter\getIds;
use App\Swap\Importer\ToggleImporter;
use App\Swap\Importer\ToggleImporterBulk;
use Faker\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithPagination;

class Importer extends Component
{
    use WithPagination;

    public $pagination = 25;
    public $checkbox_active = false;
    public $bulk = false;
    public $filter;
    public $ids = [];

    public string $datepicker = "";
    public string $datepicker_day = "";

    public Team $team;
    public User $user;

    protected $listeners = ['renderImporter' => 'render'];

    public function mount()
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
        $this->user = Auth()->user();
    }

    public function dateALL()
    {
        $this->datepicker = "";
        $this->datepicker_day = "";
    }

    public function selectAll()
    {
        $importer = new ToggleImporterBulk();
        $status = $importer->toggleImporterStatusBulk($this->user, $this->team);
        $this->checkbox_active = $status;
    }

    public function select($id)
    {
        $url = listUrl::findOrFail($id);
        $importer = new ToggleImporter();
        $importer->toggleImporterAdminStatus($url, $this->user);
    }


    public function render()
    {
        $value = $this->filter;

        if(isset($value)){
            $member_ids = User::where(function ($q) use ($value) {
                $q->where('name', 'LIKE', '%' . $value . '%')
                    ->Orwhere('email', 'LIKE', '%' . $value . '%');
            })->select('member_id')->get();

            $urls = listUrl::query()
                ->with(['package', 'material', 'member', 'listRole', 'listType'])
                ->where('team_id', $this->team->id)
                ->whereIn('member_id', $member_ids)
                ->latest()->simplePaginate($this->pagination);
        } elseif($this->datepicker != "") {
            ['datepicker' => $this->datepicker];

            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);

            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $this->datepicker_day;

            if($day != "") {
                $urls = listUrl::query()
                    ->with(['package', 'material', 'member', 'listRole', 'listType'])
                    ->where('team_id', $this->team->id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->whereDay('created_at', $day)
                    ->simplePaginate($this->pagination);

                foreach ($urls as $url){
                    $this->ids [] = $url->id;
                }
            }else {
                $urls = listUrl::query()
                    ->with(['package', 'material', 'member', 'listRole', 'listType'])
                    ->where('team_id', $this->team->id)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->simplePaginate($this->pagination);

                foreach ($urls as $url){
                    $this->ids [] = $url->id;
                }
            }
        } else {
            $urls = listUrl::query()
                ->with(['package', 'material', 'member', 'listRole', 'listType'])
                ->where('team_id', $this->team->id)
                ->latest()
                ->simplePaginate($this->pagination);
        }

        return view('livewire.importer', compact('urls',  ));
    }
}
