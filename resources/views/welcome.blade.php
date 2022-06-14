@extends('layouts.app')

@section('content')
    <div x-data='Post()'>
        <div class='container'>
            <div class='row mb-2'>
                <template x-if="!is_single">
                    <template x-for='post in posts' :key='post.id'>
                        <div class='col-md-6'>
                            <div class='row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative'>
                                <div class="col p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary" x-text='post.title'></strong>
                                    <h3 class="mb-0" x-text='post.title'></h3>
                                    <div class="mb-1 text-muted" x-text='post.created_at'></div>
                                    <p class="card-text mb-auto" x-text='post.body'></p>
                                    <a @click="getPost(post.id)" href="javascript:void(0)" class="stretched-link">Continue reading</a>
                                </div>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
            <template x-if='is_single'>
                <div class='row justify-content-center'>
                    <div>
                        <div class='card'>
                            <div class='card-body'>
                                <a @click="is_single = ! is_single" href="javascript:void(0)" class="btn btn-primary btn-sm">Back</a>
                                <h4>Display Comments</h4>
                                <hr />
                                <strong x-text='post_single.author_name'></strong>
                                <template x-for='comment in post_single.comments'>
                                        <h3 x-text='comment.body'></h3>
                                </template>
                                <h4>Add comment</h4>
                                <form @submit.prevent="addComment">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control" name="body" x-model="form.body"></textarea>
                                        <input type="hidden" x-model='form.post_id'  />
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Add Comment" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/posts.js') }}"></script>
    @endpush
@endsection

