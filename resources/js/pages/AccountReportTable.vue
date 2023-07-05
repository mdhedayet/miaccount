<template>
  <div class="container mx-auto">
    <table class="min-w-full bg-white border-gray-300 shadow-lg rounded-lg overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-6 py-4 text-left text-gray-600 font-semibold uppercase tracking-wider">Acc Head id</th>
          <th class="px-6 py-4 text-left text-gray-600 font-semibold uppercase tracking-wider">G. Lvl 1</th>
          <th class="px-6 py-4 text-left text-gray-600 font-semibold uppercase tracking-wider">G. Lvl 2</th>
          <th class="px-6 py-4 text-left text-gray-600 font-semibold uppercase tracking-wider">G. Lvl 3</th>
          <th class="px-6 py-4 text-left text-gray-600 font-semibold uppercase tracking-wider">Acc Head</th>
          <th class="px-6 py-4 text-right text-gray-600 font-semibold uppercase tracking-wider">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(account_head, key) in totalAmountsReport.data" :key="key">
            <td class="px-6 py-4">{{ account_head.account_head_id }}</td>
            <td class="px-6 py-4">{{ account_head.group_level_1 }}</td>
            <td class="px-6 py-4">{{ account_head.group_level_2 }}</td>
            <td class="px-6 py-4">{{ account_head.group_level_3 }}</td>
            <td class="px-6 py-4">{{ account_head.account_head_name }}</td>
            <td class="px-6 py-4 text-right">{{ account_head.total }}</td>
        </tr>

      </tbody>
    </table>

    <!-- pagination -->
    <div class="flex justify-center items-center mt-4">
      <div class="flex flex-col">
        <div class="flex text-gray-700">
          <div
          class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l cursor-pointer"
          v-if="totalAmountsReport.meta?.current_page > 1"
          @click="getTotalAmountsReport(totalAmountsReport.meta?.current_page - 1)"
          >
          Prev
        </div>
        <div class=" text-gray-800 font-bold py-2 px-4 mx-2">
          Page {{ totalAmountsReport.meta?.current_page }} of {{ totalAmountsReport.meta?.last_page }}
        </div>
          <div
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r cursor-pointer"
            v-if="totalAmountsReport.meta?.current_page < totalAmountsReport.meta?.last_page"
            @click="getTotalAmountsReport(totalAmountsReport.meta?.current_page + 1)"
          >
            Next
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      totalAmountsReport: [],
    };
  },
  mounted() {
    this.getTotalAmountsReport();
  },
  methods: {
    getTotalAmountsReport(page = 1) {
      axios
        .get('api/v1/accounts/total-amounts-table-view?page=' + page)
        .then((response) => {
          this.totalAmountsReport = response.data
        })
        .catch((error) => console.error(error))
    },
  },
};
</script>

<style  scoped>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

th,
td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
