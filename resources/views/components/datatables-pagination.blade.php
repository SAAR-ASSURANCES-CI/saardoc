@if(isset($pagination) && $pagination)
<div class="pagination-container">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            @if(isset($pagination['first']))
                <a href="{{ $pagination['first'] }}" class="pagination-link-datatables">
                    {{ __('Premier') }}
                </a>
            @endif
            
            @if(isset($pagination['previous']))
                <a href="{{ $pagination['previous'] }}" class="pagination-link-datatables">
                    {{ __('Précédent') }}
                </a>
            @endif
        </div>
        
        <div class="flex items-center space-x-1">
            @if(isset($pagination['pages']))
                @foreach($pagination['pages'] as $page => $url)
                    @if($page == $pagination['current'])
                        <span class="pagination-link-datatables active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link-datatables">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        </div>
        
        <div class="flex items-center space-x-2">
            @if(isset($pagination['next']))
                <a href="{{ $pagination['next'] }}" class="pagination-link-datatables">
                    {{ __('Suivant') }}
                </a>
            @endif
            
            @if(isset($pagination['last']))
                <a href="{{ $pagination['last'] }}" class="pagination-link-datatables">
                    {{ __('Dernier') }}
                </a>
            @endif
        </div>
    </div>
</div>
@endif
