// import axios from 'axios'

export const keyword = {
  getKeywords () {
    return new Promise(resolve => {
      resolve(['cinéma', 'théâtre', 'concerts', 'voiture', 'cuisine', 'patisserie'])
    })
  }
}
