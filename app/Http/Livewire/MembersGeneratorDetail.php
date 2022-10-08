<?php

namespace App\Http\Livewire;

use App\Models\listUrl;
use App\Models\Material;
use App\Models\Package;
use App\Models\Role;
use App\Models\Team;
use App\Models\Type;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class MembersGeneratorDetail extends Component
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

    public function mount(Team $team)
    {
        $this->team = $team;
    }

    public function toggleBulk()
    {
        if($this->bulk){
            $this->bulk = false;
        } else {
            $this->bulk = true;
        }
    }

    public function dateALL()
    {
        $this->datepicker = "";
        $this->datepicker_day = "";
    }

    public function selectAll()
    {

        if($this->checkbox_active) {
            if($this->ids == []){
                $urls = listUrl::where('team_id', $this->team->id)->select('id', 'print')->get();
            }else {
                $urls = listUrl::whereIn('id', $this->ids)->where('team_id', $this->team->id)->select('id', 'print')->get();
                $this->ids = [];
            }
            foreach ($urls as $url) {
                $url->print = 0;
                $url->update();
            }
            $this->checkbox_active = false;
            $this->ids = [];
        }else {
            if($this->ids == []){
                $urls = listUrl::where('team_id', $this->team->id)->select('id', 'print')->get();
            }else {
                $urls = listUrl::whereIn('id', $this->ids)->where('team_id', $this->team->id)->select('id', 'print')->get();
                $this->ids = [];
            }

            foreach ($urls as $url) {
                $url->print = 1;
                $url->update();
            }
            $this->checkbox_active = true;
        }
    }

    public function select($id)
    {
        $url = listUrl::findOrFail($id);

        if($url->print == 1)
        {
            $url->print = 0;
            $url->update();
        }
        else
        {
            $url->print = 1;
            $url->update();
        }
    }

    public function render()
    {
        $value = $this->filter;
        if(isset($value)){
            $urls = listUrl::query()
                ->with(['package', 'material', 'member', 'listRole', 'listType'])
                ->where(function ($q) use ($value) {
                $q->where('webshop_order_id', 'LIKE', '%' . $value . '%')
                    ->Orwhere('type_id', 'LIKE', '%' . $value . '%')
                    ->Orwhere('reservation', 'LIKE', '%' . $value . '%')
                    ->Orwhere('card_id', 'LIKE', '%' . $value . '%');
            })->latest()->simplePaginate($this->pagination);

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


        $materials = Material::pluck('name', 'id');
        $QRcode = \App\Models\QRCODE::first();

        $roles = Role::where('id', '!=', 1)->pluck('name','id');

        $materials = Material::pluck('name', 'id');

        $types = Type::pluck('name', 'id');

        return view('livewire.members-generator-detail', compact('urls',  'materials', 'QRcode', 'roles', 'materials', 'types'));
    }
}
