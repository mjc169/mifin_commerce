import { defineStore } from 'pinia';
import { useFetchPosts } from '@/composables/useFetchPosts';

export const usePostsStore = defineStore('posts', () => {
  const { posts, loading, error } = useFetchPosts();
  return { posts, loading, error };
});