<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Add New Branch
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{--  @if ($errors->any())
                        <div class="bg-red-300 text-red-700 rounded border border-red-500 p-5 m-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-800 font-bold">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <form method="POST" action="{{ route('branches.store') }}" class="border rounded-2xl p-2">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for='name'>Name</x-input-label>
                                <x-text-input value="{{ old('name') }}" class="w-full" name='name'></x-text-input>
                                @error('name')
                                    <x-input-label for='name'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='location'>location</x-input-label>
                                <x-text-input value="{{ old('location') }}" class="w-full"
                                    name='location'></x-text-input>
                                @error('location')
                                    <x-input-label for='location'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='mobile'>mobile</x-input-label>
                                <x-text-input value="{{ old('mobile') }}" class="w-full" name='mobile'></x-text-input>
                                @error('mobile')
                                    <x-input-label for='mobile'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='company_id'>Company</x-input-label>
                                <select name="company_id">
                                    <option selected disabled value="">Select Item</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <x-input-label for='company_id'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end mt-3">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
