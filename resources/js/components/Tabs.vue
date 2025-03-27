<template>
    <div class="tabs-container">
      <div class="btn-group d-flex">
        <button 
          class="btn tab-btn"
          :class="{ 'active-tab': activeTab === 'image' }"
          @click="setActiveTab('image')">
          Image Posts
        </button>
        <button 
          class="btn tab-btn"
          :class="{ 'active-tab': activeTab === 'text' }"
          @click="setActiveTab('text')">
          Text Posts
        </button>
      </div>
  
      <div class="tab-content mt-4">
        <!-- Image Posts -->
        <div v-show="activeTab === 'image'">
          <div class="posts-list">
            <div v-for="post in imagePosts" :key="post.id" class="post-card image-card">
              <div class="post-header">
                <a :href="`/profile/${post.user.id}`">
                    <img :src="getImageUrl(post.user.profile)" alt="Avatar" class="avatar">
                </a>
                <h5 class="username">{{ post.user.username }}</h5>
              </div>
              <img :src="getImageUrl(post)" alt="Post Image" class="post-image">
              <div class="post-caption">
                <p>{{ post.caption }}</p>
              </div>
                <!-- Like, Share, Comment Section -->
                <div class="post-actions">
                    <button class="action-btn like-btn">
                    <i class="fas fa-thumbs-up"></i>  Likes
                    </button>
                    <button class="action-btn share-btn">
                    <i class="fas fa-share"></i>  Shares
                    </button>
                    <button class="action-btn comment-btn">
                        <a :href="`/ip/${post.id}`">
                            <i class="fas fa-comment"></i> Comments
                        </a>
                    </button>
                </div>
            </div>
          </div>
        </div>
  
        <!-- Text Posts -->
        <div v-show="activeTab === 'text'">
          <div class="posts-list">
            <div v-for="post in textPosts" :key="post.id" class="post-card text-card">
              <div class="post-header">
                <a :href="`/profile/${post.user.id}`">
                    <img :src="getImageUrl(post.user.profile)" alt="Avatar" class="avatar">
                </a>
                <h5 class="username">{{ post.user.username }}</h5>
              </div>
              <div class="post-content">
                <p>{{ post.description }}</p>
              </div>
                <!-- Like, Share, Comment Section -->
                <div class="post-actions">
                    <button class="action-btn like-btn">
                    <i class="fas fa-thumbs-up"></i>  Likes
                    </button>
                    <button class="action-btn share-btn">
                    <i class="fas fa-share"></i>  Shares
                    </button>
                    <button class="action-btn comment-btn">
                        <a :href="`/tp/${post.id}`">
                            <i class="fas fa-comment"></i> Comments
                        </a>
                    </button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
props: {
    imagePosts: Array,  // Receive image posts as prop
    textPosts: Array,   // Receive text posts as prop
},
data() {
    return {
    activeTab: "image",  // Default active tab is image posts
    };
},
methods: {
    setActiveTab(tab) {
    this.activeTab = tab;
    },
    // Utility method to construct the correct image URL
    getImageUrl(post) {
    return '/storage/' + post.image;  // Assuming the images are stored in the 'public/storage' folder in Laravel
    },
},
mounted() {
    // Log the props data to the console to inspect the structure
    console.log("Image Posts:", this.imagePosts);
    console.log("Text Posts:", this.textPosts);
},
};
</script>

<style scoped>
/* Add your custom styles here */
.tabs-container {
  width: 100%;
  text-align: center;
}

.btn-group {
  width: 100%;
}

.tab-btn {
  flex: 1;
  padding: 12px;
  font-size: 16px;
  font-weight: bold;
  color: #333;
  background-color: #f8f9fa;
  border: 1px solid #ccc;
  transition: all 0.2s ease-in-out;
}

.tab-btn:hover {
  background-color: #e9ecef;
}

.active-tab {
  background-color: #000;
  color: white;
  border-bottom: 3px solid #000;
}

/* Styles for the Post Cards */
.post-card {
  margin: 15px auto;
  width: 100%;
  max-width: 600px;
  border: 1px solid #ccc;
  border-radius: 10px;
  background-color: white;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.image-card .post-image {
  width: 100%;
  height: auto;
  border-bottom: 1px solid #ddd;
}

.text-card .post-content {
  padding: 20px;
  background-color: #f9f9f9;
}

.post-header {
  padding: 10px 20px;
  display: flex;
  align-items: center;
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.username {
  font-size: 16px;
  font-weight: bold;
  margin: 0;
}

.post-caption {
  padding: 15px;
  font-size: 14px;
  color: #333;
}

/* Style for Action Buttons */
.post-actions {
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  border-top: 1px solid #ddd;
}

/* Common styling for action buttons */
.action-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
  padding: 10px;
}

.action-btn {
  background: none;
  border: none;
  color: #333;
  font-size: 14px;
  display: flex;
  align-items: center;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  padding: 5px 15px;
}

.action-btn i {
  margin-right: 5px; /* Space between the icon and text */
}

.action-btn:hover {
  color: #007bff; /* Hover effect */
}

/* For the Comment button, remove the underline on link */
.action-btn.comment-btn a {
  text-decoration: none;
  color: inherit; /* Inherit the button color */
}

.action-btn.comment-btn:hover {
  color: #007bff; /* Hover effect on comment button */
}

/* Optional: Style each button differently if needed */
.like-btn:hover {
  color: #ff4c4c; /* Red color on hover for like */
}

.share-btn:hover {
  color: #00aaff; /* Blue color on hover for share */
}

.comment-btn:hover {
  color: #28a745; /* Green color on hover for comment */
}
</style>
