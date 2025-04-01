<template>
      <button @click="toggleLike" :class="{'btn-outline-primary': !liked, 'btn-primary': liked}" class="action-btn like-btn btn btn-sm">
        <i class="fas fa-thumbs-up"></i> {{ likeCount }} Likes
      </button>
</template>

<script>
export default {
props: ['postId', 'postType', 'initialLiked', 'initialLikeCount'],
data() {
    return {
    liked: this.initialLiked,
    likeCount: this.initialLikeCount
    };
},
methods: {
    async toggleLike() {
    try {
        // Send request to toggle like (like/unlike)
        const response = await axios.post(`/like/${this.postType}/${this.postId}`);

        // Update like count and liked state based on response
        this.liked = response.data.liked;
        this.likeCount = response.data.like_count;
    } catch (error) {
        console.error("There was an error while liking the post:", error);
    }
    }
}
};
</script>
