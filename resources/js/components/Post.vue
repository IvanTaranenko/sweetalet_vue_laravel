<template>
    <div class="p-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Title</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="post in posts" :key="post.id" class="border-t">
                    <td class="py-4 px-4">{{ post.id }}</td>
                    <td class="py-4 px-4">{{ post.title }}</td>
                    <td class="py-4 px-4">{{ post.description }}</td>
                    <td class="py-4 px-4">
                        <button
                            @click="deletePost(post.id)"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import axios from 'axios';

export default {
    data() {
        return {
            headers: ['ID', 'Title', 'Description', 'Action'],
            posts: [],
        };
    },
    methods: {
        fetchPosts() {
            axios
                .get('/api/post')
                .then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        deletePost(postId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this post!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(`/api/post/${postId}`)
                        .then(() => {
                            this.posts = this.posts.filter(post => post.id !== postId);
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: 'The post has been deleted.',
                            });
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Failed to delete the post.',
                            });
                        });
                }
            });
        },
    },
    mounted() {
        this.fetchPosts();
    },
};
</script>
