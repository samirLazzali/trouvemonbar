import { shallowMount } from '@vue/test-utils'
import TheSignup from '@/views/TheSignUp'

describe('TheSignup', () => {
  it('should render properly', () => {
    const wrapper = shallowMount(TheSignup)

    expect(wrapper.html()).toMatchSnapshot()
  })
})
