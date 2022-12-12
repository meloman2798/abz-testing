@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-blue-500']) }}>
        <div id="alert-2"
             class="flex p-4 mb-4 bg-blue-100 rounded-lg dark:bg-green shadow sm:rounded-md sm:overflow-hidden"
             role="alert">
            <div class="ml-3 text-sm font-medium text-blue-700 dark:text-blue-800">
                {{ $status }}
            </div>
        </div>
    </div>
@endif
