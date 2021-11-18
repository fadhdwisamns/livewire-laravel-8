<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;

class Contacts extends Component
{
    public $contacts, $title, $content, $contact_id;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;


    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function render()
    {
        $this->contacts = Contact::all();
        return view('livewire.contacts');
    }
    private function resetInputFields(){
        $this->title = '';
        $this->content = '';
    }
    public function store()
    {
        $validatedDate = $this->validate([
                'title.0' => 'required',
                'content.0' => 'required',
                'title.*' => 'required',
                'content.*' => 'required',
            ],
            [
                'title.0.required' => 'title field is required',
                'content.0.required' => 'content field is required',
                'title.*.required' => 'title field is required',
                'content.*.required' => 'content field is required',
            ]
        );

        foreach ($this->title as $key => $value) {
            Contact::create(['title' => $this->title[$key], 'content' => $this->phone[$key]]);
        }

        $this->inputs = [];

        $this->resetInputFields();

        session()->flash('message', 'Contact Has Been Created Successfully.');
    }
}
