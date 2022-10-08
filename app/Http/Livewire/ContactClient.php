<?php

namespace App\Http\Livewire;

use App\Models\Member;
use App\Models\Contact;
use App\Models\User;
use App\Swap\Filter\FilterContactsClient;
use App\Swap\Filter\TogglePrint;
use App\Swap\Filter\ToggleStatusClient;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ContactClient extends Component
{
    use WithPagination;
    public $pagination = 25;

    public $datepicker = "";
    public $datepicker_day = "";

    public $name;
    public Member $member;

    public $selected_members = [];

    public function mount()
    {
        $this->member = Auth::user()->member;
    }

    public function dateALL()
    {
        $this->datepicker = "";
        $this->datepicker_day = "";
        $this->name = "";
    }

    //Select individual checkbox
    public function select(Contact $contact)
    {
        $filter = new TogglePrint();
        $filter->togglePrintStatus($contact);
    }

    //Select all checkboxes
    public function selectAll()
    {
        $filter = new TogglePrint();
        $filterClient = new ToggleStatusClient();
        $filterContacts = new FilterContactsClient();
        $member = Member::where('user_id', Auth::user()->id)->first();

        //Status select all checkbox
        if($member){
            $filterClient->toggleStatus($member);
        }

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;

        //Select Contacts from filters
        if (!$this->datepicker) {
            $contacts = $filterContacts->filterNoDate($member, $this->name, $this->pagination);
        } else {
            if ($day) {
                $contacts = $filterContacts->filterWithDateDay($member, $month, $year, $day, $this->pagination);
            } else {
                $contacts = $filterContacts->filterWithDate($member, $month, $year, $this->pagination);
            }
        }

        //Status print checkboxes
        if($contacts){
            foreach ($contacts as $contact){
                $filter->togglePrintStatus($contact);
            }
        }
    }

    public function render()
    {
        $filter = new FilterContactsClient();

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;

        if (!$this->datepicker) {
            $contacts = $filter->filterNoDate($this->member, $this->name, $this->pagination);
            return view('livewire.contact-client', compact('contacts'));

        } else {
            if ($day) {
                $contacts = $filter->filterWithDateDay($this->member, $month, $year, $day, $this->pagination);
            } else {
                $contacts = $filter->filterWithDate($this->member, $month, $year, $this->pagination);
            }
            return view('livewire.contact-client', compact('contacts'));
        }
    }
}
