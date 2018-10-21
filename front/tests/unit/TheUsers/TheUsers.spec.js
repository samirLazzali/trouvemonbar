import { mount } from '@vue/test-utils'
import TheUsers from '@/views/TheUsers.vue'

describe('TheUsers.vue', () => {
  it('should render a table of users', async () => {
    const wrapper = mount(TheUsers, {
      mocks: {
        $api: {
          getUsers () {
            return Promise.resolve(users)
          }
        }
      }
    })

    await wrapper.vm.$nextTick()

    expect(wrapper.html()).toMatchSnapshot()
  })
})

const users = [
  {
    id: 1,
    email: 'test1',
    hash: 'test1',
    pseudo: 'test1',
    role: 'USER'
  },
  {
    id: 2,
    email: 'test2',
    hash: 'test2',
    pseudo: 'test2',
    role: 'USER'
  },
  {
    id: 3,
    email: 'test3',
    hash: 'test3',
    pseudo: 'test3',
    role: 'ADMIN'
  }
]
