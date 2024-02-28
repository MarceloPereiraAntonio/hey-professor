<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea label="Question" name="question"></x-textarea>
                <x-btn.primary type="submit"> Save </x-btn.primary>
                <x-btn.reset type="reset"> Cancel </x-btn.reset>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4">

        {{-- listagem --}}
        <h1 class="dark:text-gray-500 uppercase font-bold mb-1">List of questions</h1>
        <div class="dark:text-gray-400 space-y-4">
            @foreach ( $questions as $item )
                <x-question :question="$item"/>

            @endforeach
        </div>
    </x-container>
</x-app-layout>
