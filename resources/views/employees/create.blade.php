<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Add New Employee
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
                    <form method="POST" action="{{ route('employees.store') }}" class="border rounded-2xl p-2">
                        @csrf
                        <div class="w-full text-center mb-10">
                            <x-input-label for='user_id'>user</x-input-label>
                            <select name="user_id">
                                <option selected disabled value=null >Select Item</option>
                                @foreach ($users as $user)
                                    <option class="font-bold" value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <x-input-label for='user_id'
                                    class="text-red-800 font-bold">{{ $message }}</x-input-label>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <x-input-label for='job_title'>job title</x-input-label>
                                <x-text-input value="{{ old('job_title') }}" class="w-full" name='job_title'></x-text-input>
                                @error('job_title')
                                    <x-input-label for='job_title'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for='salary'>salary</x-input-label>
                                <x-text-input  value="{{ old('salary') }}" class="w-full"
                                    name='salary'></x-text-input>
                                @error('salary')
                                    <x-input-label for='salary'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>

                            <div>
                                <x-input-label for='hire_date'>hire date</x-input-label>

                                <x-text-input  type="date" value="{{ old('hire_date') }} " class="w-full"
                                    name='hire_date'></x-text-input>
                                @error('hire_date')
                                    <x-input-label for='hire_date'
                                        class="text-red-800 font-bold">{{ $message }}</x-input-label>
                                @enderror
                            </div>
                            <div class="">
                                <x-input-label class="w-full" for='branch_id'>branch</x-input-label>
                                <select name="branch_id">
                                    <option selected disabled value="">Select Item</option>
                                    @foreach ($branches as $branch)
                                        <option class="text-green-800 font-bold" value="{{ $branch->id }}">{{ $branch->name. ' ---> ' .$branch->location}}</option>
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
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
