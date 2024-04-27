import airportList from '../assets/airportList.json'

export function callApi(self) {
    let airport = self.selectedAirport
    return self.$axios.get('/home', {params: {airportCode:airport.code}})
}

export function getAirportList() {

    /**
     * There is no endpoint to retrieve the airport list from opensky.
     * In the future, we can change this method for it to call an actual (correct) endpoint
     */
    return airportList
}

