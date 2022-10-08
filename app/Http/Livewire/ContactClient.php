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

    public function mount(User $user)
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
        $member = Member::where('user_id', Auth::user()->id)->first();
        $contacts = Contact::where('member_id', $member->id)->get();

        //Status select all checkbox
        if($member){
            $filterClient->toggleStatus($member);
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

        if (!$this->datepicker) {
            $contacts = $filter->filterNoDate($this->member->id, $this->name, $this->pagination);

            return view('livewire.contact-client', compact('contacts'));

        } else {
            $date = $this->datepicker;
            $dateSub = Carbon::parse($date);
            $year = $dateSub->year;
            $month = $dateSub->month;
            $day = $this->datepicker_day;

            if ($day) {
                $contacts = $filter->filterWithDateDay($this->member, $month, $year, $day, $this->pagination);
            } else {
                $contacts = $filter->filterWithDate($this->member, $month, $year, $this->pagination);
            }

            return view('livewire.contact-client', compact('contacts'));
        }
    }
}
