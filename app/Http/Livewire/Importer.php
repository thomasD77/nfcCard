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

    public $email;
    public $password;
    public $password_confirmation;

    public string $datepicker = "";
    public string $datepicker_day = "";

    public Team $team;

    public function mount(Team $team)
    {
        $this->team = Team::findOrFail(Auth()->user()->team_id);
    }

    protected $rules = [
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users','email:rfc,dns'],
        'password' => ['required'],
        'password_confirmation' => 'required|same:password'
    ];


    public function dateALL()
    {
        $this->datepicker = "";
        $this->datepicker_day = "";
    }

    public function selectAll()
    {
        if($this->checkbox_active) {
            if($this->ids == []){
                $urls = listUrl::where('team_id', $this->team->id)->select('id', 'check_import')->get();
            }else {
                $urls = listUrl::whereIn('id', $this->ids)->where('team_id', $this->team->id)->select('id', 'check_import')->get();
                $this->ids = [];
            }
            foreach ($urls as $url) {
                $url->check_import = 0;
                $url->update();
            }
            $this->checkbox_active = false;
            $this->ids = [];
        }else {
            if($this->ids == []){
                $urls = listUrl::where('team_id', $this->team->id)->select('id', 'check_import')->get();
            }else {
                $urls = listUrl::whereIn('id', $this->ids)->where('team_id', $this->team->id)->select('id', 'check_import')->get();
                $this->ids = [];
            }

            foreach ($urls as $url) {
                $url->check_import = 1;
                $url->update();
            }
            $this->checkbox_active = true;
        }
    }

    public function select($id)
    {
        $url = listUrl::findOrFail($id);

        if($url->check_import == 1)
        {
            $url->check_import = 0;
            $url->update();
        }
        else
        {
            $url->check_import = 1;
            $url->update();
        }
    }

    public function generateAccounts()
    {
        //$this->validate();
        $urls = listUrl::where('check_import', 1)
            ->where('team_id', $this->team->id)
            ->whereNotNull('is_admin_generated')
            ->get();

        foreach ($urls as $url){

            $url_browser = URL::first()->url;

            $user = User::create([
                'name' => $this->team->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            DB::table('user_role')->insert([
                'user_id' => $user->id,
                'role_id' => $url->role_id,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),]);

            $member = new Member();
            $faker = Factory::create();
            //Save member settings
            $member->user_id = $user->id;
            $member->email = $user->email;
            $member->card_id = $url->card_id;
            $member->memberURL = $url_browser . '/?' . $url->card_id;
            $member->memberQRcode = $url_browser . '/QRcode'. '/' . $url->card_id;
            $member->material_id = $url->material_id;
            $member->package_id = $url->package_id;
            $member->titleMessage = "Thank you for this amazing SWAP";
            $member->referral = '#' . $faker->unique()->numberBetween($min = 10, $max = 100) . '-' . $faker->unique()->numberBetween($min = 10000, $max = 100000);
            $member->save();

            //Make card state connection
            DB::table('states')->insert([
                'member_id'=> $member->id,
            ]);

            //Make card setting connection
            DB::table('settings')->insert([
                'member_id'=> $member->id,
            ]);

            //Connect User with member
            $user->member_id = $member->id;
            $user->team_id = $url->team_id;
            $user->business = $url->business;
            $user->is_company = $url->is_company;
            $user->is_importer = $url->is_importer;
            $user->email_verified_at = now();
            $user->save();

            //Connect ListURl with Member
            $url->member_id = $member->id;
            $url->check_import = 0;
            $url->is_admin_generated = 1;
            $url->save();



        }
    }

    public function render()
    {
        $value = $this->filter;
        if(isset($value)){
            $urls = listUrl::query()
                ->with(['package', 'material', 'member', 'listRole', 'listType'])
                ->where('team_id', $this->team->id)
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
