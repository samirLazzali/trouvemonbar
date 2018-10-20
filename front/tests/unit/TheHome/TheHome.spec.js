import { mount } from '@vue/test-utils'
import TheHome from '@/views/TheHome.vue'

describe('TheHome.vue', () => {
  it('should render properly', async () => {
    const wrapper = mount(TheHome)

    expect(wrapper.html()).toMatchSnapshot()
  })
})
