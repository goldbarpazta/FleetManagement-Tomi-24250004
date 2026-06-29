@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])

<div class="dropdown" x-data="{ open: false }" @click.outside="open = false">
    <span @click="open = ! open">
        {{ $trigger }}
    </span>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="dropdown-menu dropdown-menu-{{ $align === 'right' ? 'end' : 'start' }} show"
         @click="open = false"
         style="display: block;">
        {{ $content }}
    </div>
</div>
