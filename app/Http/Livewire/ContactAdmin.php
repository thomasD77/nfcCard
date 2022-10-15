<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use App\Swap\Filter\AllCleanPrintAdmin;
use App\Swap\Filter\FilterContactsAdmin;
use App\Swap\Filter\getIds;
use App\Swap\Filter\ReloadContacts;
use App\Swap\Filter\TogglePrintAdmin;
use App\Swap\Filter\ToggleStatusAdmin;
use App\Swap\Members\TeamMembers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactAdmin extends Component
{
    use WithPagination;
    public string $datepicker = "";
    public int $pagination = 25;
    public string $datepicker_day = "";
    public $name;
    public $scans;
    public $members;
    public $selectMember;
    public $myScansDisabled = false;
    public $selectedMemberDisabled = false;
    public $member_ids;
    public $print_ids = [];

    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
        $members = new TeamMembers();
        $this->members = $members->getTeamMembers($this->user);
        $this->member_ids =  $members->getTeamMembersInArrayPluckId($this->user);
    }

    public function dateALL()
    {
        $this->datepicker = "";
        $this->datepicker_day = "";
        $this->name = "";
        $this->selectMember = "";
        $this->scans = "";

        $clean = new AllCleanPrintAdmin();
        $clean->cleanPrint($this->user);
    }

    public function onlyMyScans(){
        if($this->scans){
            $this->scans = false;
            $this->selectedMemberDisabled = false;
        }else {
            $this->scans = true;
            $this->selectedMemberDisabled = true;
        }
    }

    //Select individual checkbox Admin
    public function select(Contact $contact)
    {
        $filter = new TogglePrintAdmin();
        $filter->togglePrintAdminStatus($contact, $this->user);
    }

    //Select all checkboxes
    public function selectAll()
    {
        $filter = new TogglePrintAdmin();
        $filterAdmin = new ToggleStatusAdmin();
        $filterContacts = new FilterContactsAdmin();
        $clean = new AllCleanPrintAdmin();
        $reload = new ReloadContacts();
        $member = Member::where('id', $this->user->member_id)->first();

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;
        $ids = new getIds();

        //Search for your own scans
//        if($this->scans && $this->user->member) {
//            $filterAdmin->toggleStatus($this->user->member);
//            $clean->cleanPrint($this->user);
//        }
//        elseif ($this->selectMember) {
//            $this->disabled = true;
//            $member = Member::where('id', $this->selectMember)->where('archived', 0)->first();
//            //Extra team check
//            if($member != null && !$member->user->team_id == Auth::user()->team_id){
//                $member = "";
//            }
//        }

        //Select Contacts from filters
        if (!$this->datepicker) {
            $contacts = $filterContacts->filterNoDateArray($this->member_ids, $this->name);
            $filterAdmin->toggleStatus($this->user->member, $contacts);
        } else {
            if ($day) {
                $contacts = $filterContacts->filterWithDateDayArray($this->member_ids, $month, $year, $day, $this->name);
                $filterAdmin->toggleStatus($this->user->member, $contacts);
            } else {
                $contacts = $filterContacts->filterWithDateArray($this->member_ids, $month, $year, $this->name);
                $filterAdmin->toggleStatus($this->user->member, $contacts);
            }
        }
    }


    public function render()
    {
        $member = "";
        $filter = new FilterContactsAdmin();

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;


        //Search for swaps Teammember
        if($this->selectMember == null){
            $this->myScansDisabled = false;
        }

        //Search for your own scans
        if($this->scans) {
            $member = Auth()->user()->member;
        }
        elseif ($this->selectMember) {
            $this->myScansDisabled = true;
            $member = Member::where('id', $this->selectMember)->where('archived', 0)->first();
            //Extra team check
            if($member != null && !$member->user->team_id == Auth::user()->team_id){
                $member = "";
            }
        }
        else {
            $members = new TeamMembers();
            $members = $members->getTeamMembersInArrayPluckId($this->user);
        }


        //All the swap connections from the admin
        if($member != ""){
            //When there is no filter
            if(!$this->datepicker)
            {
                $contacts = $filter->filterNoDate($member, $this->name, $this->pagination);
                return view('livewire.contact-admin', compact('contacts'));
            }
            //When there is a filter
            else {
                if ($day != "") {
                    $contacts = $filter->filterWithDateDay($this->user->member, $month, $year, $day, $this->pagination, $this->name);
                    return view('livewire.contact-admin', compact('contacts'));
                } else {
                    $contacts = $filter->filterWithDate($this->user->member, $month, $year, $this->pagination, $this->name);
                    return view('livewire.contact-admin', compact('contacts'));
                }
            }
        }
        //All the swap connections from the team
        else {
            //When there is no filter
            if(!$this->datepicker)
            {
                $contacts = $filter->filterNoDatePaginate($members, $this->name, $this->pagination);
                return view('livewire.contact-admin', compact('contacts'));
            //When there is a filter
            } else {
                //When we select a day
                if ($day != "") {
                    $contacts = $filter->filterWithDateDayPaginate($members, $month, $year, $day, $this->pagination, $this->name);
                    return view('livewire.contact-admin', compact('contacts'));
                } else {
                    $contacts = $filter->filterWithDatePaginate($members, $month, $year, $this->pagination, $this->name);
                    return view('livewire.contact-admin', compact('contacts'));
                }
            }
        }
    }
}
