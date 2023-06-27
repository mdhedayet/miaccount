<template>
  <div class="container mx-auto">
    <table class="min-w-full bg-white border-gray-300 shadow-lg rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-6 py-4 text-left text-gray-600 font-semibold uppercase tracking-wider">Group Group/Account Head
          </th>
          <th class="px-6 py-4 text-right text-gray-600 font-semibold uppercase tracking-wider">Total Amounts</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(level_one, index) in totalAmountsReport" :key="index">
          <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ level_one?.name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-end">{{ level_one?.total_amounts }}</td>
          </tr>
          <template v-for="(level_two, index) in level_one?.sub_groups" :key="index">
            <tr>
              <td class="px-20 py-4 whitespace-nowrap">{{ level_two.name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-end">{{ level_two.total_amounts }}</td>
            </tr>
            <template v-for="(group_three, index) in level_two?.child_groups" :key="index">
              <tr>
                <td class="px-36 py-4 whitespace-nowrap">{{ group_three?.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-end">{{ group_three?.total_amounts }}</td>
              </tr>
              <template v-for="(level_three_acc_head, index) in group_three?.account_heads" :key="index">
                <tr>
                  <td class="px-48 py-4 whitespace-nowrap">{{ level_three_acc_head?.name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-end">{{ level_three_acc_head?.total_amounts }}</td>
                </tr>
              </template>
            </template>
            <template v-for="(level_two_acc_head, index) in level_two?.account_heads" :key="index">
              <tr>
                <td class="px-36 py-4 whitespace-nowrap">{{ level_two_acc_head.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-end">{{ level_two_acc_head.total_amounts }}</td>
              </tr>
            </template>
          </template>
          <template v-for="(level_one_acc_head, index) in level_one?.account_heads" :key="index">
            <tr>
              <td class="px-20 py-4 whitespace-nowrap">{{ level_one_acc_head?.name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-end">{{ level_one_acc_head?.total_amounts }}</td>
            </tr>

          </template>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import App from '../layouts/App.vue'
import axios from 'axios'
export default {
  components: { App },
  data() {
    return {
      totalAmountsReport: [],
    }
  },
  mounted() {
    this.getTotalAmountsReport()
  },
  methods: {
    getTotalAmountsReport() {
      axios
        .get('api/v1/accounts/total-amounts-report')
        .then((response) => {
          this.totalAmountsReport = response.data.data
        })
        .catch((error) => console.error(error))
    },
  },

}
</script>

<style scoped>

tr:nth-child(even) {
  background-color: #f2f2f2
}

</style>
