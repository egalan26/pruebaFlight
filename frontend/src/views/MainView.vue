<template>
  <div class="mainContainer">
    <div class="errorContainer" v-if="errors">
      <span v-for="error in errors" :key="error">{{ error }}</span>
    </div>
    <div class="filterContainer">

      <h6>Selecciona aeropuerto</h6>
      <BFormSelect v-model="selectedAirport" :options="availableAirports">
      </BFormSelect>


      <h6>Selecciona fechas de inicio y final de búsqueda</h6>
      <div class="datepickerClass">
        <VueDatePicker model-type='timestamp' v-model="selectedDate.start"></VueDatePicker>
        <VueDatePicker model-type='timestamp' v-model="selectedDate.end"></VueDatePicker>
      </div>

      <BButton @click="selectAirport()">Buscar</BButton>
    </div>

    <div class="resultContainer">
      <BTable :items="arrivals">      </BTable>
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
    selectAirport() {
      fetchEveryArrival(this).then(response => {
        this.arrivals = response.data
      }).catch((exception) => {
        this.errors.push(exception.response.data)
        this.arrivals = []
      })
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

.filterContainer{
  display:flex;
  flex-direction: column;
  height: 400px;
  justify-content: space-evenly;
}

.mainContainer div[class$='Container']{
  margin: 20px;
}

</style>
