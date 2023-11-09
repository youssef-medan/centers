<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Employee
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

                    <h1 class="text-center font-bold text-2xl mb-5">

                        {{'manager : ' . $manager->name}}


                    </h1>
                    <form method="POST" action="{{ route('managers.update', $manager->id) }}"
                        class="border rounded-2xl p-2">
                        @csrf
                        @method('PATCH')




                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for='name'>name</x-input-label>
                                <x-text-input value="{{ old('name', $manager->name) }}" class="w-full"
                                    name='name'></x-text-input>
                                @error('name')
                                    <x-input-label for='name'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>


                            <div class=" text-center">
                                <x-input-label for='company'>company</x-input-label>
                                <select name="company">
                                    <option selected value="{{ $oldcompany->id }}">{{ $oldcompany->name }}</option>


                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        {{-- <option class="text-green-800 font-bold" value="{{ $company->id }}">{{ $company->name }}</option> --}}
                                    @endforeach
                                </select>
                                @error('company')
                                    <x-input-label for='company'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
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
