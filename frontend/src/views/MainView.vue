<template>
  <div class="mainContainer">
    <div class="filterContainer">

      <h6>Select an airport</h6>
      <BFormSelect v-model="selectedAirport" :options="availableAirports">
      </BFormSelect>


      <h6>Select date time range (max 7 days apart)</h6>
      <div class="datepickerClass">
        <VueDatePicker model-type='timestamp' v-model="selectedDate.start" ></VueDatePicker>
        <VueDatePicker model-type='timestamp' v-model="selectedDate.end"></VueDatePicker>
      </div>

      <BButton @click="searchAirport()">Search</BButton>
      <BButton @click="searchAirport('EDDF', 1517227200, 1517230800)">Quick (predefined) search</BButton>
    </div>

    <div class="resultContainer">
      <BTable :items="arrivals" busyLoadingText="Cargando datos..."></BTable>
      <div class="errorContainer" v-if="errors">
        <span v-for="error in errors" :key="error">{{ error }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import {fetchEveryArrival, getAirportList} from "@/repository/apiService";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'


export default {
  name: 'MainView',
  components: {VueDatePicker},
  data() {
    return {
      availableAirports: getAirportList(),
      arrivals: [],
      selectedAirport: null,
      visibleTab: 1,
      errors: [],
      selectedDate: {
        start: null,
        end: null
      }
    }
  },
  computed: {
    timestampStartDate() {

      return this.selectedDate.start / 1000;
    },
    timestampEndDate() {
      return this.selectedDate.end / 1000;
    }
  },
  methods: {
    searchAirport(airport, start, end) {
      this.errors = []
      this.validate()
      this.errors.length === 0 && fetchEveryArrival(this, airport, start, end).then(response => {
        this.arrivals = response.data
      }).catch((exception) => {
        this.errors.push(exception.response.data)
        this.arrivals = []
      })
    },
    validate() {
      if (!this.selectedAirport) {
        this.errors.push('You have to select an airport from the list')
      }
      if (!this.selectedDate.start){
        this.errors.push('You have to select a date to begin with')
      }
      if (!this.selectedDate.end){
        this.errors.push('You have to select a date to end with')
      }
    }
  }
}
</script>

<style scoped>
.datepickerClass {
  display: flex;
  flex-direction: row;
  justify-content: space-evenly;
}

.filterContainer {
  display: flex;
  flex-direction: column;
  height: 400px;
  justify-content: space-evenly;
}

.mainContainer div[class$='Container'] {
  margin: 20px;
}
.errorContainer{
  display: flex;
  flex-direction: column;
}
</style>
