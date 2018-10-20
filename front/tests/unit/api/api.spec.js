import mockAxios from 'jest-mock-axios'
import Api from '../../../src/api/index'
// mock is in __mock__ directory

describe('Api', () => {
  beforeEach(() => {
    Api.install(MockVue)
  })

  it('should return a list of users', done => {
    const mockVue = new MockVue()

    mockVue.$api.getUsers()
      .then(msg => {
        expect(msg).toBe('awesome response')
        done()
      })

    expect(mockAxios.get).toHaveBeenCalledWith('/api/users')

    mockAxios.mockResponse({ data: 'awesome response' })
  })
})

class MockVue {}
