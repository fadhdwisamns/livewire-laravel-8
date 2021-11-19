<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Http\Livewire\Field;
use Illuminate\Http\Request;

class PostCrud extends Component
{
    public $posts, $title, $content , $postId;
    public $isModelOpen = 0;
    public $inputs = [];
    public $i = 1;
    
     
   
    public function render()
    {
        $this->posts = Post::all();
        // dd($this->posts);
        return view('livewire.post-crud');
    }
    public function create(){
        $this->resetCreateForm();
        $this->openModal();
    }
    public function closeModal(){
        $this->isModalOpen = false;
    }
    public function openModal(){
        $this->isModalOpen = true;
    }
    private function resetCreateForm(){
        $this->title = '';
        $this->content = '';
    }
    public function remove($i)
    {
        unset($this->inputs[$i]);
        session()->flash('message', 'Data Has Been Deleted Successfully.');
    }
    public function store(){
        $validateDate = $this->validate([
            'title.0' => 'required',
            'content.0' => 'required',
            'title.*' => 'required',
            'content.*' => 'required',

        ],
        [
            'title.0.required' => 'name field is required',
            'content.0.required' => 'name field is required',
            'title.*.required' => 'ma,e field is required',
            'content.*.required' => 'name field is required',
        ]
    
    );
    
    foreach ($this->title as $key => $value) {
        Post::create(['title' => $this->title[$key], 'content' => $this->content[$key]]);
    }
    $this->inputs = [];

    $this->resetCreateForm();

    session()->flash('message', 'Data Has Been Created Successfully.');
        // $this->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        // ]);
        // Post::updateOrCreate(['id' => $this->postId], [
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);
        // session()->flash('message', $this->postId ? 'Data updated successfully.' : 'Data added successfully.');

        // $this->closeModal();
        // $this->resetCreateForm();
    }
    public function update(){
        $this->validate([
            'title' => 'required',
            'title' => 'required',
        ]);
        Post::update([
            'id' => $this->postId
        ],
            [
                $this->title = $post->title,
                $this->content = $post->content
            ]);
            foreach($this->title as $key => $value){
                Post::create([
                    'title' => $this->title[$key], 
                    'content' => $this->content[$key],
                ]);
                $this->inputs = [];

                $this->resetCreateForm();
            }
            session()->flash('message', 'Data Update successfully.');
    }
    public function add($i){
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->title = $post->title;
        $this->content = $post->content;

        $this->openModal();
    }
    public function delete($id){
        Post::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}
