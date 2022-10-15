<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Member;
use App\Models\User;
use App\Swap\Filter\FilterContactsAdmin;
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
    public $notes;
    public $showNotes = false;
    public $scans;
    public $members;
    public $selectMember;
    public $disabled = false;
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
    }

    public function onlyMyScans(){
        if($this->scans){
            $this->scans = false;
        }else {
            $this->scans = true;
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

        //Status select all checkbox
        if($this->user->member){
            $filterAdmin->toggleStatus($this->user->member);
        }

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;

        //Select Contacts from filters
        if (!$this->datepicker) {
            $contacts = $filterContacts->filterNoDate($this->member_ids, $this->name, $this->pagination);
        } else {
            if ($day) {
                $contacts = $filterContacts->filterWithDateDay($this->member_ids, $month, $year, $day, $this->pagination);
            } else {
                $contacts = $filterContacts->filterWithDate($this->member_ids, $month, $year, $this->pagination);
            }
        }

        //Status print checkboxes
        if($contacts){
            foreach ($contacts as $contact){
                $filter->togglePrintAdminStatus($contact, $this->user);
            }
        }
    }


    public function render()
    {
        $member = "";

        if($this->selectMember == null){
            $this->disabled = false;
        }
        if($this->scans) {
            $member = Auth()->user()->member;
        }
        elseif ($this->selectMember) {
            $this->disabled = true;
            $member = Member::where('id', $this->selectMember)->where('archived', 0)->first();
            //Extra team check
            if($member != null && !$member->user->team_id == Auth::user()->team_id){
                $member = "";
            }
        }
        else {
            $team = Auth()->user()->team;
            $users = User::where('team_id', $team->id)->pluck('id');
            $members = Member::whereIn('user_id', $users)->where('archived', 0)->pluck('id');
        }

        //All the swap connections from the admin
        if($member != ""){
            //When there is no filter
            if($this->datepicker == "")
            {
                $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->where('archived', 0)
                    ->where('member_id', $member->id)
                    ->latest()
                    ->where('name', 'LIKE', '%' . $this->name . '%')
                    ->simplePaginate($this->pagination);
                return view('livewire.contact-admin', compact('contacts'));
            }
            //When there is a filter
            else {
                ['datepicker' => $this->datepicker];

                $date = $this->datepicker;
                $dateSub = Carbon::parse($date);

                $year = $dateSub->year;
                $month = $dateSub->month;
                $day = $this->datepicker_day;
                //When we select a day
                if ($day != "") {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->where('member_id', $member->id)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->whereDay('created_at', $day)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                } else {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->where('member_id', $member->id)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                }
            }
        }
        //All the swap connections from the team
        else {
            //When there is no filter
            if($this->datepicker == "")
            {
                $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                    ->where('archived', 0)
                    ->whereIn('member_id', $members)
                    ->latest()
                    ->where('name', 'LIKE', '%' . $this->name . '%')
                    ->simplePaginate($this->pagination);
                return view('livewire.contact-admin', compact('contacts'));
            //When there is a filter
            } else {
                ['datepicker' => $this->datepicker];

                $date = $this->datepicker;
                $dateSub = Carbon::parse($date);

                $year = $dateSub->year;
                $month = $dateSub->month;
                $day = $this->datepicker_day;
                //When we select a day
                if ($day != "") {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->whereIn('member_id', $members)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->whereDay('created_at', $day)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                } else {
                    $contacts = \App\Models\Contact::with(['member', 'contactStatus'])
                        ->where('archived', 0)
                        ->whereIn('member_id', $members)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('name', 'LIKE', '%' . $this->name . '%')
                        ->simplePaginate($this->pagination);
                    return view('livewire.contact-admin', compact('contacts'));
                }
            }
        }
    }
}
