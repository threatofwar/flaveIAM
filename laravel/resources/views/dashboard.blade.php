<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('AWS IAM User Create') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Input the desired AWS IAM User") }}
                            </p>
                        </header>

                        <!-- Display success or error messages -->
                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold text-green-600">{{ session('success') }}</strong>
                            </div>
                        @elseif (session('error'))
                            <div class="bg-red-100 border border-red-400 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold text-red-600">{{ session('error') }}</strong>
                            </div>
                        @endif

                        <form method="post" action="{{ route('awsiamuser.store') }}" class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="username" :value="__('Username')" />
                                <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" required autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('username')" />
                            </div>

                            <div>
                                <x-input-label for="policy" :value="__('IAM Policy')" />
                                <x-text-input id="policy" name="policy" type="text" class="mt-1 block w-full" required />
                                <x-input-error class="mt-2" :messages="$errors->get('policy')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
