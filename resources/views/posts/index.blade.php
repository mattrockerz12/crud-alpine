@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" x-data="Post()">
            <div class="card">
                <div class="card-header">
                    Manage Posts
                </div>
                <template x-if="!is_adding && !is_editing">
                    <div class="card-body">
                        <a @click="Adding()" href="javascript:void(0)" class="btn btn-primary btn-sm">Add Post</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Body</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="post in posts" :key="post.id">
                                    <tr>
                                        <th scope="row" x-text="post.id"></th>
                                        <td x-text="post.author_name"></td>
                                        <td x-text="post.title"></td>
                                        <td x-text="post.body"></td>
                                        <td>
                                            <div class='btn-group'>
                                                <a @click="editPost(post.id)" href="javascript:void(0)" class="btn btn-primary btn-sm">Edit</a>
                                                <a @click="Delete(post.id)" href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>

                <template x-if="is_adding">
                    <div class="card-body">
                        <a @click="is_adding = ! is_adding" href="javascript:void(0)" class="btn btn-primary btn-sm">Back</a>
                        <form @submit.prevent="addPost">
                            @csrf
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"" name="title" x-model="form.title">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" x-model="form.body"></textarea>
                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="my-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </template>
                <template x-if="is_editing">
                    <div class="card-body">
                        <a @click="is_editing = ! is_editing" href="javascript:void(0)" class="btn btn-primary btn-sm">Back</a>
                        <form  @submit.prevent="updatePost(form.id)">
                            @csrf
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control @error('title') is_invalid @enderror" name="title" x-model="form.title">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" x-model="form.body"></textarea>
                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="my-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/posts.js') }}"></script>
@endpush
@endsection
