"use strict";

function Post() {
    return {
        is_adding: false,
        is_editing: false,
        posts: {},

        form: {
            title: "",
            body: "",
            id: "",
        },

        init: function () {
            this.getAllPosts();
        },

        getAllPosts() {
            axios.get(route("post.postList")).then((res) => {
                this.posts = res.data;
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
