<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl space-y-4">

                    @if (auth()->user()->account && !is_null(auth()->user()->account->chat_id))

                        {{-- Chat ID mavjud — faqat xabar chiqadi --}}
                        <div class="bg-green-100 text-green-800 p-4 rounded">
                            <i class="bi bi-check-circle-fill"></i> Akkauntingiz Telegram botga ulangan.
                        </div>


                    @endif
                        {{-- Chat ID yo‘q — telegramga ulanish tugmasi va form chiqadi --}}
                        <a class="btn btn-primary"
                           href="https://t.me/notification_reminder1_bot?start={{ auth()->id() }}">
                            <i class="bi bi-telegram"></i> Telegram botga ulanish
                        </a>

                        {{-- Chat ID qo‘lda kiritish --}}
                        <form method="POST" action="{{route('telegram.account')}}">
                            @csrf
                            <div class="mt-4">
                                <label for="chat_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Chat ID</label>
                                <input type="text" name="chat_id" id="chat_id"
                                       value="{{ old('chat_id') }}"
                                       class="mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded-md shadow-sm">
                            </div>

                            <button type="submit"
                                    class="mt-3 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Saqlash
                            </button>
                        </form>

                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
