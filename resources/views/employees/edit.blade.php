<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('app.Edit Employee') }}
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

                        {{'employee : ' . $empname->name}}


                    </h1>
                    <form method="POST" action="{{ route('employees.update', $employee->id) }}"
                        class="border rounded-2xl p-2">
                        @csrf
                        @method('PATCH')




                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for='job_title'>job title</x-input-label>
                                <x-text-input value="{{ old('job_title', $employee->job_title) }}" class="w-full"
                                    name='job_title'></x-text-input>
                                @error('name')
                                    <x-input-label for='job_title'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='location'>salary</x-input-label>
                                <x-text-input value="{{ old('salary', $employee->salary) }}" class="w-full"
                                    name='salary'></x-text-input>
                                @error('salary')
                                    <x-input-label for='salary'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='hire_date'>hire date</x-input-label>
                                <x-text-input value="{{ old('hire_date', $employee->hire_date) }}" class="w-full"
                                    name='hire_date'></x-text-input>
                                @error('hire_date')
                                    <x-input-label for='hire_date'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>

                            <div class=" text-center">
                                <x-input-label for='branch_id'>branch</x-input-label>
                                <select name="branch_id">
                                    <option selected disabled value="">Select Item</option>

                                    @foreach ($branches as $branch)
                                    <option {{ $branch->id == $employee->branch_id  ? 'selected' :''}} value="{{ $branch->id }}">{{ $branch->name . ' --->' . $branch->location  }}</option>
                                        {{-- <option class="text-green-800 font-bold" value="{{ $branch->id }}"> {{ $branch->name . ' --->' . $branch->location }}</option> --}}
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <x-input-label for='branch_id'
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
