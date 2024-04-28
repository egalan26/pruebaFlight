import airportList from '../assets/airportList.json'

export function fetchEveryArrival(self) {

    return self.$axios.get('/fetchArrivals', {
        headers:{
            'Authorization': 'Bearer logged' // TODO create a real authentication system
        },
        params: {
            airportCode: self.selectedAirport,
            startTime: self.timestampStartDate,
            endTime: self.timestampEndDate,
        }
    })
}

export function getAirportList() {

    /**
     * There is no endpoint to retrieve the airport list from opensky.
     * In the future, we can change this method for it to call an actual (correct) endpoint
     */
    return airportList.map((el) => {
        return {'value': el.code, 'text': el.name}
    })
}

