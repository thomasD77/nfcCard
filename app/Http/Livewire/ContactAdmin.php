<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Member;
use App\Models\Profile;
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

//        $clean = new AllCleanPrintAdmin();
//        $clean->cleanPrint($this->user);
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
        //Declare all classes
        $filter = new TogglePrintAdmin();
        $filterAdmin = new ToggleStatusAdmin();
        $filterContacts = new FilterContactsAdmin();

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;
        $ids = new getIds();

        //Search for your own scans
        if($this->scans) {
            $this->member_ids = [ $this->user->member->id ];
        }

        //Search for selected team member scans
        if($this->selectMember != null) {
            $this->member_ids = [ $this->selectMember ];
        }

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
        $filterContacts = new FilterContactsAdmin();
        $members = new TeamMembers();
        $member_ids = new \App\Swap\General\getIds();

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;

        //Search for selected team member scans
        if($this->selectMember != null) {
            $this->myScansDisabled = true;
            $this->member_ids = [$this->selectMember];

        }else {
            $this->myScansDisabled = false;
            $this->member_ids =  $members->getTeamMembersInArrayPluckId($this->user);
        }

        //Search for your own scans
        if($this->scans) {
            $this->member_ids = [ $this->user->member->id ];
        }

        //When there is no filter
        if(!$this->datepicker) {
            $contacts = $filterContacts->filterNoDatePaginate($this->member_ids, $this->name, $this->pagination);

            $ids = $member_ids->idArray($contacts, 'member_id');

            $profiles = Profile::with([
                'member',
            ])
                ->where('default', 1)
                ->whereIn('member_id', $ids)
                ->simplePaginate($this->pagination);

            return view('livewire.contact-admin', compact('contacts', 'profiles'));
        //When there is a filter
        } else {
            //When we select a day
            if ($day) {
                $contacts = $filterContacts->filterWithDateDayPaginate($this->member_ids, $month, $year, $day, $this->pagination, $this->name);
                return view('livewire.contact-admin', compact('contacts'));
            } else {
                $contacts = $filterContacts->filterWithDatePaginate($this->member_ids, $month, $year, $this->pagination, $this->name);
                return view('livewire.contact-admin', compact('contacts'));
            }
        }
    }
}
