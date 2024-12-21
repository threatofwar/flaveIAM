<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('New IAM User Created') }}
                </h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Username: <strong>{{ $username }}</strong>
                </p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Policy: <strong>{{ $policy }}</strong>
                </p>

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
