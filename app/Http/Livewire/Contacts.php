<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;

class Contacts extends Component
{
    // public $contacts, $title, $content, $contact_id;
    // public $updateMode = false;
    // public $inputs = [];
    // public $i = 1;

    public $editContact = null;
    public $contacts = [];
    public $posts, $title, $content , $postId;
    public $designTemplate = 'tailwind';

    protected $rules = [
        'contacts.*.title' => ['required'],
        'contacts.*.content' => ['required'],
    ];

    protected $validationAttributes = [
        'contacts.*.title' => 'title',
        'contacts.*.content' => 'content',
    ];
    
    public function mount() {
        $this->contacts = Contact::all()->toArray();
    }

    private function resetCreateForm(){
        $this->title = '';
        $this->content = '';
    }
    public function create(){
        $this->resetCreateForm();
        $this->openModal();
    }

    public function render()
    {
        $this->contacts = Contact::all()->toArray();
        return view('livewire.contacts');
    }
    // private function resetInputFields(){
    //     $this->title = '';
    //     $this->content = '';
    // }
    // public function store()
    // {
    //     $validatedDate = $this->validate([
    //             'title.0' => 'required',
    //             'content.0' => 'required',
    //             'title.*' => 'required',
    //             'content.*' => 'required',
    //         ],
    //         [
    //             'title.0.required' => 'title field is required',
    //             'content.0.required' => 'content field is required',
    //             'title.*.required' => 'title field is required',
    //             'content.*.required' => 'content field is required',
    //         ]
    //     );

    //     foreach ($this->title as $key => $value) {
    //         Contact::create(['title' => $this->title[$key], 'content' => $this->phone[$key]]);
    //     }

    //     $this->inputs = [];

    //     $this->resetInputFields();

    //     session()->flash('message', 'Contact Has Been Created Successfully.');
    // }
    
        public function editContact($contact_id){
            $this->editedContactIndex = $contact_id; 
        }

        public function saveContact($contact_id){
            $this->validate();
            $contact = $this->contacts[$contact_id] ?? NULL;
            if(!is_null($contact)){
                $editedContact = Contact::find($contact['id']);
                    if($editedContact){
                        $editedContact->update($contact);
                    }
            }
            $this->editContactIndex = null;
            session()->flash('message', 'Data Has Been Update Successfully.');
        }
        public function store(){
             $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        Contact::updateOrCreate(['id' => $this->postId], [
            'title' => $this->title,
            'content' => $this->content,
        ]);
        session()->flash('message', $this->postId ? 'Data updated successfully.' : 'Data added successfully.');
        // $this->closeModal();
        $this->resetCreateForm();

        }
        public function delete($id){
            Contact::find($id)->delete();
            session()->flash('message', 'Data deleted successfully.');
        }
}
