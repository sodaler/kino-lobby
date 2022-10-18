@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <livewire:filter-movies/>
</div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var elem = document.querySelector('.grid');
        var infScroll = new InfiniteScroll(elem, {
            path: '/filter/?page=@{{#}}',
            append: '.result',
            status: '.page-load-status',
            // history: false,
        });
    </script>
@endsection
