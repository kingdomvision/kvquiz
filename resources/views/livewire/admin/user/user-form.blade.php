<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Create User' }}
        </h2>
    </x-slot>

    <x-slot name="title">
        {{ 'Create User' }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form wire:submit.prevent="save">
                        <div>
                            <x-input-label for="name" value="Name" />
                            <x-text-input wire:model.defer="name" id="name" class="block mt-1 w-full"
                                          type="text" name="name"/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" value="Email Address" />
                            <x-text-input wire:model.defer="email" id="email" class="block mt-1 w-full"
                                          type="email" name="email"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password" value="Password" />
                            <x-text-input wire:model.defer="password" id="password" class="block mt-1 w-full"
                                          type="password" name="password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
