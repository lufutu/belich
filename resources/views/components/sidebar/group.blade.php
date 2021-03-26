<a
    href="javascript:;"
    class="flex items-center p-3 border-b border-gray-900 hover:text-orange-400"
    :class="isClose ? 'justify-center' : 'justify-start'"
    @click="toggle=!toggle"
>
    @isset($icon)
        <div class="flex flex-wrap content-center">
            @svg($icon, 'h-5 w-5')
        </div>
    @endisset
    <div
        class="ml-2"
        :class="isClose ? 'hidden-item' : ''"
    >
        {{ $text }}
    </div>
    <i class="hidden-item fas" :class="{'fa-angle-right': toggle, 'fa-angle-down': !toggle }"></i>
</a>
<ul
    class="hidden-item bg-gray-900"
    :class="{'hidden': toggle}"
>
    {{ $slot }}
</ul>
