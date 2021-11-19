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
                <input type="text" class="form-control" placeholder="Enter Title" wire:model="title.0">
                        @error('title.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    
                                            </td>
                    <td class="border px-4 py-2">
                    <input type="email" class="form-control" wire:model="content.0" placeholder="Enter Content ">
                        @error('content.0') <span class="text-danger error">{{ $message }}</span>@enderror
                         </td>
                    <td class="border px-4 py-2">
                        <button wire:click='store' class="bg-blue-500  font-bold py-2 px-4 rounded">Save</button>
                    </td> 
                </tr>
                @foreach($posts as $key => $value)
                    <tr>
                        <td class="border px-4 py-2">
                        <input type="text" class="form-control" placeholder="Enter Title" wire:model="title.{{ $value }}"  >
                            @error('title.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </td>
                        <td class="border px-4 py-2">
                        <input type="text" class="form-control" wire:model="content.{{ $value }}" placeholder="Enter Content" >
                            @error('content.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </td>
                        <td class="border px-4 py-2">
                            <button wire:click="store"
                                class="bg-blue-500   font-bold py-2 px-4 rounded">Save</button>
                                <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">DELETE</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>