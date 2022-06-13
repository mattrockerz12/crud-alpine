@extends('layouts.app')

@section('content')
    <div x-data='Post()'>
        <div class='container'>
            <div class='row mb-2'>
                <template x-for='post in posts' :key='post.id'>
                    <div class='col-md-6'>
                        <div class='row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative'>
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary" x-text='post.title'></strong>
                                <h3 class="mb-0" x-text='post.title'></h3>
                                <div class="mb-1 text-muted" x-text='post.created_at'></div>
                                <p class="card-text mb-auto" x-text='post.body'></p>
                                <a href="#" class="stretched-link">Continue reading</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/posts.js') }}"></script>
    @endpush
@endsection

