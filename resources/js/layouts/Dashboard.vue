<template>
  <main>
    <navigation></navigation>
    <div class="container mx-auto">
      <router-view></router-view>
    </div>
  </main>
</template>

<script>
import Navigation from '@/js/components/Navigation'

export default {
  components: {
    Navigation,
  },
}
</script>
