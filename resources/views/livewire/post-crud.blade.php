<x-slot name="header">
    <h2 class="text-center">Probation Test Livewire</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if(session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
            role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message')}}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()" class="bg-green-700 text-white font-bold py-2 px-4 rounded my-3">Create Posts</button>
           
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                       
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Content</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr wire:ignore>
                <td  class="border px-4 py-2">
                        <input type='text' name='title' wire:model='title' class='form-control' placeholder='Enter Title'>
                                            </td>
                    <td class="border px-4 py-2">
                        <input type='text' wire:model='content' name='content' class='form-control' placeholder='Enter Content'>
                                            </td>
                    <td class="border px-4 py-2">
                        <button wire:click='store' class="bg-blue-500  font-bold py-2 px-4 rounded">Save</button>
                    </td> 
                </tr>
                    @foreach($posts as $post)
                    <tr>
                        <td class="border px-4 py-2">
                            <input type='text' name='title'  value="{{ $post->title }}"class='form-control' placeholder='Enter Title'></td>
                        <td class="border px-4 py-2">{{ $post->content}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="update"
                                class="bg-blue-500   font-bold py-2 px-4 rounded">Save</button>
                            <button wire:click="delete({{ $post->id }})"
                                class="bg-red-500 hover:bg-red-700  font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>