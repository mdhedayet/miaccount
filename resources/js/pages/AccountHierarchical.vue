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
        <template v-for="(level_one, index) in allTotalAmountsReport?.data" :key="index">
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
    <!-- pagination -->
    <div class="flex justify-center items-center mt-4">
      <div class="flex flex-col">
        <div class="flex text-gray-700">
          <div
          class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l cursor-pointer"
          v-if="allTotalAmountsReport.meta?.current_page > 1"
          @click="getTotalAmountsReport(allTotalAmountsReport.meta?.current_page - 1)"
          >
          Prev
        </div>
        <div class=" text-gray-800 font-bold py-2 px-4 mx-2">
          Page {{ allTotalAmountsReport.meta?.current_page }} of {{ allTotalAmountsReport.meta?.last_page }}
        </div>
          <div
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r cursor-pointer"
            v-if="allTotalAmountsReport.meta?.current_page < allTotalAmountsReport.meta?.last_page"
            @click="getTotalAmountsReport(allTotalAmountsReport.meta?.current_page + 1)"
          >
            Next
          </div>
        </div>
      </div>
  </div>
  </div>

</template>

<script>
import App from '../layouts/App.vue'
import axios from 'axios'
export default {
  components: { App },
  data() {
    return {
      allTotalAmountsReport: [],
    }
  },
  mounted() {
    this.getTotalAmountsReport()
  },
  methods: {
    getTotalAmountsReport(page = 1) {
      axios
        .get('api/v1/accounts/total-amounts-report?page=' + page)
        .then((response) => {
          this.allTotalAmountsReport = response.data
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
