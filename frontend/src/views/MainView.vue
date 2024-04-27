<template>
  <div>
    <div v-if="errors">
      <span v-for="error in errors" :key="error">{{error}}</span>
    </div>
    <BDropdown v-model="selectedAirport" :text="selectedAirport?selectedAirport.name :'Selecciona un aeropuerto'">
      <BDropdownItem v-for="airport in availableAirports" :key="airport.code" @click="selectAirport(airport)">{{airport.code}} -- {{airport.name}}</BDropdownItem>
    </BDropdown>


    {{arrivals}}
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
      availableAirports: getAirportList(),
      arrivals: [],
      selectedAirport: null,
      visibleTab: 1,
      errors:[]
    }
  },
  methods: {
    selectAirport(airport){
      this.selectedAirport = airport
      callApi(this).then(response => {
        this.arrivals = response
      }).catch((exception)=>{
        this.errors.push(exception.message)
        this.arrivals = []
      })
    }
  }
}
</script>

<style scoped>
</style>
