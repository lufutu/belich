<div
    id="menu"
    class="bg-gray-700 flex flex-col justify-between"
    :class="{'is-close': isClose, 'w-16 transition-all duration-100 ease-in-out': isClose, 'w-48 transition-all duration-100 ease-in-out': !isClose}"
    @mouseover="isClose=false"
    @mouseleave="isClose=true"
>
    <div>
        <div class="h-20 bg-blue-500 text-white flex items-center justify-center">
            <a class="block px-5 text-white text-lg h-9 flex items-center justify-center" href="@route('belich.dashboard')">
                <span class="bg-blue-700 rounded-full h-9 w-9 flex items-center justify-center">
                    <x-heroicon-s-home class="w-5 h-5"/>
                </span>
            </a>
        </div>
        <ul class="text-white">
            <li>
                <a href="javascript:;" class="block p-3 border-b border-gray-900 hover:text-orange-400">
                    <i class="fas fa-home fa-fw"></i>
                    <span class="hidden-item">Home</span>
                </a>
            </li>
            <li>
                <a href="javascript:;" @click="toggle=!toggle" class="flex items-center p-3 border-b border-gray-900 hover:text-orange-400">
                    <div class="flex-1">
                        <i class="fas fa-sitemap fa-fw"></i>
                        <span class="hidden-item">Sitemap</span>
                    </div>
                    <i class="hidden-item fas" :class="{'fa-angle-right': toggle, 'fa-angle-down': !toggle }"></i>
                </a>
                <ul class="hidden-item bg-gray-900" :class="{'hidden': toggle}">
                    <li class="border-b border-gray-800">
                        <a href="javascript:;" class="block px-8 py-3 hover:text-orange-400">Page 1</a>
                    </li>
                    <li class="border-b border-gray-800">
                        <a href="javascript:;" class="block px-8 py-3 hover:text-orange-400">Page 2</a>
                    </li>
                    <li class="border-b border-gray-800">
                        <a href="javascript:;" class="block px-8 py-3 hover:text-orange-400">Page 3</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <a href="javascript:;" class="block p-4 text-center bg-gray-800">
        <i class="fas fa-power-off text-red-500"></i>
    </a>
</div>
