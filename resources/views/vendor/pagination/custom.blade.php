@if ($paginator->hasPages())
<div class="blog-pagination">
    <ul class="justify-content-center">
        @if ($paginator->onFirstPage())
        <li>
            <a href="#" tabindex="-1" style="pointer-events: none; color: #6c757d; background-color:white;">Sebelumnya</a>
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}">Sebelumnya</a>
        </li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="page-item disabled">{{ $element }}</li>
        @endif

        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active">
            <a href="#">{{ $page }}</a>
        </li>
        @else
        <li>
            <a href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Selanjutnya</a>
        </li>
        @else
        <li>
            <a href="#" style="pointer-events: none; color: #6c757d; background-color:white;">Selanjutnya</a>
        </li>
        @endif
    </ul>
</div>
@endif
