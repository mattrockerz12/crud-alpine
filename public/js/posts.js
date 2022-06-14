"use strict";

function Post() {
    return {
        is_adding: false,
        is_editing: false,
        is_single: false,
        posts: [],
        post_single: {},
        comments: {},

        form: {
            title: "",
            body: "",
            id: "",
            post_id: ""
        },

        init: function () {
            this.getAllPosts();
            this.getAllComments();
        },

        getAllPosts() {
            axios.get(route("post.postList")).then((res) => {
                this.posts = res.data;
            });
        },

        getAllComments() {
            axios.get(route('comment.commentList')).then((res) => {
                this.comments = res.data;
            });
        },

        getPost(id) {
            axios.get(route('post.show', id)).then((res) => {
                this.getAllPosts();
                this.getAllComments();
                this.post_single = res.data;
                this.is_single = true;
                this.form.post_id = id;
            });
        },

        addPost() {
            axios.post(route("post.store"), this.form).then((res) => {
                this.is_adding = false;
                this.getAllPosts();
                alert("Post added successfully");
                this.form = {};
            });
        },

        addComment() {
            axios.post(route('comment.store'), this.form).then((res) => {
                this.getAllComments();
                this.getAllPosts();
                this.is_single = true;
                alert("Comment added Successfully");
                this.form =  {};
            });
        },

        editPost(id) {
            this.form = {};
            axios.get(route("post.edit", id)).then((res) => {
                this.form = res.data;
                this.is_editing = true;
            });
        },

        updatePost(id) {
            axios.post(route("post.update", id), this.form).then((res) => {
                this.is_editing = false;
                this.getAllPosts();
                alert("Post updated successfully");

                this.form = {};
            });
        },

        Single() {
            this.is_single = false;
        },

        Edit() {
            this.is_editing = true;
            this.is_adding = false;
        },

        Adding() {
            this.is_editing = false;
            this.is_adding = true;
            this.form = {};
        },

        Delete(id) {
            if (confirm("Are you sure you want to delete this post?")) {
                axios.post(route("post.delete", id)).then((res) => {
                    this.is_adding = false;
                    this.getAllPosts();
                });
            }
        },
    };
}
