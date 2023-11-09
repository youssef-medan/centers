<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Vendor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{--  @if ($errors->any())
                        <div class="p-5 m-2 text-red-700 bg-red-300 border border-red-500 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="font-bold text-red-800">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <form enctype="multipart/form-data" method="POST" action="{{ route('vendors.update', $vendor->id) }}"
                        class="p-2 border rounded-2xl">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <x-input-label for='name'>Name</x-input-label>
                                <x-text-input value="{{ old('name',$vendor->name) }}" class="w-full" name='name'></x-text-input>
                                @error('name')
                                    <x-input-label for='name'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='logo'>logo</x-input-label>
                                <input class="mt-2" type="file" name="logo">
                                @error('logo')
                                    <x-input-label for='logo'
                                        class="font-bold text-red-800">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                @if($vendor->logo)
                                <img class="rounded w-28 h-28"
                                src="{{ asset('storage/' . $vendor->logo) }}"
                                alt="">

                                @endif
                            </div>
                        </div>
                        <div class="flex justify-end mt-3">
                            <x-primary-button>
                                Update
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
