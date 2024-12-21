<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('IAM Users List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('List of IAM Users') }}
                </h3>

                @if(session('error'))
                    <div class="text-red-500">{{ session('error') }}</div>
                @endif

                <ul class="mt-4">
                    @foreach($users as $user)
                        <li class="text-gray-600 dark:text-gray-400">
                            {{ $user['UserName'] }} - Created: {{ $user['CreateDate'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
