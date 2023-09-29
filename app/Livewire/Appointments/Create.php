<?php

namespace App\Livewire\Appointments;

use App\Models\User;
use App\Models\Section;
use Livewire\Component;
use App\Models\Appointment;

class Create extends Component
{
    public $doctors;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $phone;
    public $notes;
    public $message= false;

    public function mount(){

      $this->sections = Section::get();
      $this->doctors = collect();

    }

    public function render()
    {
        return view('livewire.appointments.create',
            [
                'sections' => Section::get()
            ]);
    }

    public function updatedSection($section_id){

       $this->doctors = User::where('section_id',$section_id)->get();
    }

    public function store(){

        $appointments = new Appointment();
        $appointments->user_doctor_id = $this->doctor;
        $appointments->section_id = $this->section;
        $appointments->name = $this->name;
        // $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
        $appointments->save();
        $this->message =true;

    }

    // public function render()
    // {
    //     return view('livewire.appointments.create');
    // }
}
