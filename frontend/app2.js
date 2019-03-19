const store = new Vuex.Store({
  state: {
    count: 8,
    title: 'halo',
    placeholder: '',
    autocomplete: '',
    readonly: '',
    components: [],
    types: {},
  },

  mutations: {
    updateComponent (state, components) {
      state.components = components
    },

    updateTypes (state, types) {
      state.types = types
    },

  }
})

Vue.component('input-component', {
  template: '#input-component',

  computed: {
    types(){
      return store.state.types
    }
  },

  data: function(){
    return {
      tooltip: 'add new component',
      dialog: false,
      type: '',
      name: '',
      variable_name: ''
    }
  },

})

Vue.component('data-table', {
  template: '#data-table',

  computed: {
    components(){
      return store.state.components
    }
  },

  data: function(){

      return {
        tooltip: 'add new component',
        search: '',
        headers: [
          { text: 'Name', value: 'name', align: 'center', width: '10%' },
          { text: 'Variable Name', value: 'variable_name' , align: 'center', width: '10%' },
          { text: 'HTML Basic', value: 'html_basic', align: 'center', width: '60%' },
          { text: 'Action', align: 'center', width: '20%' },
        ],
      }
    },
})

new Vue({
  el: '#app2',
  data: function(){
    return {
      drawer: null,
      drawerRight: null,
      right: false,
      left: false,
      components: [],
    }
  },

  mounted() {
    this.init()
    this.newComponent()
  },

  methods: {
    async init(){
      const response = await axios.get('/e-letter/component')
      this.components = response.data
      store.commit('updateComponent', response.data)
    },

    async newComponent(){
      const response = await axios.get('/e-letter/component/list_input')
      store.commit('updateTypes', response.data)

    },
  }
})
