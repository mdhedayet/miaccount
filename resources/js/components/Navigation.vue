<template>
  <nav class="bg-white border-b border-gray-200 p-4 mb-4">
    <div class="container mx-auto flex justify-center md:justify-between">
      <router-link :to="{name: 'AccountHierarchical'}" class="hidden md:flex text-xl font-semibold place-items-center space-x-2">
        <span>MIACCOUNT</span>
      </router-link>
      <ul class="list flex items-center text-gray-500 text-sm font-semibold">
        <li>
          <router-link :to="{name: 'AccountHierarchical'}" class="hover:text-gray-700 p-2 rounded flex items-center space-x-2">
            <span>Total Amounts Report (Hierarchical View)</span>
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'AccountReport'}" class="hover:text-gray-700 p-2 rounded flex items-center space-x-2">
            <span>Total Amounts Report (Table View)</span>
          </router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
}
</script>
<style scoped>
.router-link-exact-active {
  color: #1a202c;
  font-weight: 600;
}
</style>
