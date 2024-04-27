<template>
  <div>
  </div>
</template>

<script>
import {callApi, getAirportList} from "@/repository/apiService";

export default {
  name: 'MainView',
  props: {
    msg: String
  },
  data() {
    return {
      airports: getAirportList(),
      visibleTab: 1
    }
  },
  mounted() {
    callApi(this).then(response => {
      this.arrivals = response
    })
  }
}
</script>

<style scoped>
</style>
