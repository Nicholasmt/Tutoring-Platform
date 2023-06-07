<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\TutorRequest;

class TutorRequests extends Component
{
    public $categories;
    public $price,$level,$subject,$full_name,$email,$phone,$often,$day,$time,$goal,$note,$gender;
    protected $rules=[
                    'subject'=>'required',
                    'level'=>'required',
                    'price'=>'required',
                    'often'=>'required',
                    'note'=>'required',
                    'day'=>'required',
                    'time'=>'required',
                    'full_name'=>'required',
                    'email'=>'required',
                    'phone'=>'required',
                    'gender'=>'required',
                    'goal'=>'required',
                  ];
    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.tutor-requests');
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function store()
    {
         $this->validate();
            TutorRequest::create([
                                'subject'=>$this->subject,
                                'level'=>$this->level,
                                'price'=>$this->price,
                                'often'=>$this->often,
                                'note'=>$this->note,
                                'date'=>$this->day,
                                'time'=>$this->time,
                                'full_name'=>$this->full_name,
                                'email'=>$this->email,
                                'phone'=>$this->phone,
                                'gender'=>$this->gender,
                                'goal'=>$this->goal,
                               ]);
                               
         session()->flash('message','Request Submited.');
         $this->emit('alert_remove');
         $this->reset();

    }
}
