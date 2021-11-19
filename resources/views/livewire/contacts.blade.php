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
                <input type="text" class="form-control" placeholder="Enter Title" wire:model="title">
                       
                    
                                            </td>
                    <td class="border px-4 py-2">
                    <input type="text" class="form-control" wire:model="content" placeholder="Enter Content ">
                       
                         </td>
                    <td class="border px-4 py-2">
                    <x-jet-secondary-button wire:click.prevent="store">
                                Save
                            </x-jet-secondary-button>
                       
                    </td> 
                </tr>
                @foreach($contacts as $index => $contact)
                    <tr>
                        <td class="border px-4 py-2">
                            
                        <input type="text" class="form-control"  wire:model.defer="contacts.{{ $index }}.title"  >
                          
                        </td>
                        <td class="border px-4 py-2">
                        <input type="text" class="form-control" wire:model.defer="contacts.{{ $index }}.content" >
                            
                        </td>
                        <td class="border px-4 py-2">
                        <x-jet-secondary-button wire:click.prevent="saveContact({{$index}})">
                                Save
                            </x-jet-secondary-button>
                                <x-jet-danger-button class="ml-2" wire:click.prevent="delete({{$contact['id']}})">
                                    Delete
                                </x-jet-danger-button>
                               
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>