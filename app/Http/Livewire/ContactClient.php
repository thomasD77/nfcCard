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
    public User $user;

    public $selected_members = [];
    public $set_contacts;

    public $check_print = false;

    public function mount()
    {
        $this->member = Auth::user()->member;
        $this->user = Auth::user();
        $this->check_print = $this->member->check_all_print_client;
    }

    public function dateALL()
    {
        $filter = new TogglePrint();
        $filterClient = new ToggleStatusClient();

        $this->datepicker = "";
        $this->datepicker_day = "";
        $this->name = "";

        //Status print checkboxes
        if($this->set_contacts){
            foreach ($this->set_contacts as $contact){
                $filter->togglePrintStatus($contact);
            }
        }

        //Status select all checkbox
        if($this->member){
            $filterClient->toggleStatus($this->member);
        }

        $this->check_print = $this->member->check_all_print_client;
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

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;

        //Select Contacts from filters
        if (!$this->datepicker) {
            $this->set_contacts = $filterContacts->filterNoDate($this->member, $this->name);
        } else {
            if ($day) {
                $this->set_contacts = $filterContacts->filterWithDateDay($this->member, $month, $year, $day, $this->name);
            } else {
                $this->set_contacts = $filterContacts->filterWithDate($this->member, $month, $year, $this->name);
            }
        }

        //Status print checkboxes
        if($this->set_contacts){
            foreach ($this->set_contacts as $contact){
                $filter->togglePrintStatus($contact);
            }
        }

        //Status select all checkbox
        if($this->member){
            $filterClient->toggleStatus($this->member);
        }

        $this->check_print = $this->member->check_all_print_client;
    }

    public function render()
    {
        //Declare all classes
        $filter = new FilterContactsClient();

        //Declare all variables for dates
        $date = $this->datepicker;
        $dateSub = Carbon::parse($date);
        $year = $dateSub->year;
        $month = $dateSub->month;
        $day = $this->datepicker_day;

        $this->check_print = $this->member->check_all_print_client;

        if (!$this->datepicker) {
            $contacts = $filter->filterNoDatePaginate($this->member, $this->name, $this->pagination);
            return view('livewire.contact-client', compact('contacts'));

        } else {
            if ($day) {
                $contacts = $filter->filterWithDateDayPaginate($this->member, $month, $year, $day, $this->pagination, $this->name);
            } else {
                $contacts = $filter->filterWithDatePaginate($this->member, $month, $year, $this->pagination, $this->name);
            }
            return view('livewire.contact-client', compact('contacts'));
        }
    }
}
