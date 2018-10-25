@if ($paginator->hasPages())
    <div class="dataTables_paginate paging_simple_numbers" id="data-table-fixed-header_paginate">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="paginate_button previous disabled" id="data-table-fixed-header_previous">
                <a href="#" aria-controls="data-table-fixed-header" data-dt-idx="0" tabindex="0">&lsaquo;</a>
            </li>
        @else
            <li class="paginate_button previous" id="data-table-fixed-header_previous" >
                <a href="{{ $paginator->previousPageUrl() }}"  data-dt-idx="0" tabindex="0">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="paginate_button disabled"><a href="#" aria-controls="data-table-fixed-header" data-dt-idx="1" tabindex="0">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button active" ><a href="#" aria-controls="data-table-fixed-header" data-dt-idx="1" tabindex="0">{{ $page }}</a></li>
                    @else
                        <li class="paginate_button"><a href="{{ $url }}" aria-controls="data-table-fixed-header" data-dt-idx="1" tabindex="0">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button next" id="data-table-fixed-header_next">
                <a href="{{ $paginator->nextPageUrl() }}" aria-controls="data-table-fixed-header" data-dt-idx="2" tabindex="0">&rsaquo;</a>
            </li>
        @else
            <li class="paginate_button next disabled" id="data-table-fixed-header_next">
                <a href="#" aria-controls="data-table-fixed-header" data-dt-idx="2" tabindex="0">&rsaquo;</a></li>
            </li>
        @endif
    </ul>
    </div>
@endif

{{--<div class="dataTables_paginate paging_simple_numbers" id="data-table-fixed-header_paginate">--}}
    {{--<ul class="pagination">--}}
        {{--<li class="paginate_button previous disabled" id="data-table-fixed-header_previous"><a href="#"--}}
                                                                                               {{--aria-controls="data-table-fixed-header"--}}
                                                                                               {{--data-dt-idx="0"--}}
                                                                                               {{--tabindex="0">Previous</a>--}}
        {{--</li>--}}
        {{--<li class="paginate_button active"><a href="#" aria-controls="data-table-fixed-header" data-dt-idx="1"--}}
                                              {{--tabindex="0">1</a></li>--}}
        {{--<li class="paginate_button next disabled" id="data-table-fixed-header_next"><a href="#"--}}
                                                                                       {{--aria-controls="data-table-fixed-header"--}}
                                                                                       {{--data-dt-idx="2"--}}
                                                                                       {{--tabindex="0">Next</a></li>--}}
    {{--</ul>--}}
{{--</div>--}}
