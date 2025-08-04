@if ($paginator->hasPages())
    <nav class="mt-6 flex justify-center">
        <ul class="inline-flex items-center space-x-1 text-sm">
            
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">&laquo;</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">&laquo;</a>
                </li>
            @endif

            {{-- Page Number --}}
            @foreach ($elements as $element)
                {{-- Ellipsis --}}
                @if (is_string($element))
                    <li class="px-3 py-2 rounded-lg bg-gray-100 text-gray-500">{{ $element }}</li>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="px-3 py-2 rounded-lg bg-white border border-gray-200 text-blue-600 hover:bg-blue-100 transition">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">&raquo;</a>
                </li>
            @else
                <li class="px-3 py-2 rounded-lg bg-gray-200 text-gray-500 cursor-not-allowed">&raquo;</li>
            @endif
        </ul>
    </nav>
@endif
