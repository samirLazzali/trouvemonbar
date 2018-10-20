import { mount } from '@vue/test-utils'
import TheUsers from '@/views/TheUsers.vue'

describe('TheUsers.vue', () => {
  it('renders props.msg when passed', async () => {
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
    firstname: 'test1',
    lastname: 'test1',
    age: 14
  },
  {
    id: 2,
    firstname: 'test2',
    lastname: 'test2',
    age: 94
  },
  {
    id: 3,
    firstname: 'test3',
    lastname: 'test3',
    age: 54
  }
]
