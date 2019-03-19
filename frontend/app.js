const store = new Vuex.Store({
  state: {
    count: 8,
    title: 'halo',
    placeholder: '',
    autocomplete: '',
    readonly: '',
  },

  mutations: {
    updatePlaceholder (state, placeholder) {
      state.placeholder = placeholder
    },

    updateAutocomplete (state, autocomplete) {
      state.autocomplete = autocomplete
    },

    updateReadonly (state, readonly) {
      state.readonly = readonly
    }
  }
})

Vue.component('input-text', {
  template: '#input-text',

  computed: {
    title () {
	    return store.state.title
    },

    autocomplete: {
      get () {
        return store.state.autocomplete
      },
      set (value) {
        store.commit('updateAutocomplete', value)
      }
    },

    placeholder: {
      get () {
        return store.state.placeholder
      },
      set (value) {
        store.commit('updatePlaceholder', value)
      }
    },

    readonly: {
      get () {
        return store.state.readonly
      },
      set (value) {
        store.commit('updateReadonly', value)
      }
    },
  },
});

new Vue({
  el: '#app',

  computed: {
    title () {
	    return store.state.title
    }
  },

  data: function(){
    return {
      columns: ['Name', 'Variable Name', 'HTML Basic'],
      components: [],
      modal_header: '',
      data_input: [],
      selected_type: '',
      inputComponent: {},
      alert: false,
      attributs: [{
        attribut: '',
        value: '',
        count: 1
        }
      ],
      count: 1
    }
  },

  mounted() {
    this.init()
  },

  methods: {
    async init(){
      const response = await axios.get('/e-letter/component/index2')
      this.components = response.data
      $(this.$refs.vuemodal).hide()
    },

    deleteComponent(id){
      axios.delete('/e-letter/component/delete/' + id)
      .then(response => {
        this.init()
      });
    },

    destroy(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {

        if (result.value) {
          this.deleteComponent(id)
          Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Data deleted successful',
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
    },

    addComponent(){
      const newComponent = new URLSearchParams()
      newComponent.append('name', this.inputComponent.name)
      newComponent.append('variable_name', this.inputComponent.variable_name)
      newComponent.append('type', this.inputComponent.type)
      for (var i = 0; i < this.attributs.length; i++) {
        newComponent.append(this.attributs[i].attribut, this.attributs[i].value)
      }

      axios.post('/e-letter/component/create', newComponent)
      .then((response) => {
        this.init()
        $('#modal-form').modal('hide');
        Swal.fire({
          position: 'top-end',
          type: 'success',
          title: 'Data saved successful',
          showConfirmButton: false,
          timer: 1500
        })
      })
      .catch((e) => {
        console.log(e)
      })
    },

    async newComponent(){
      this.modal_header = 'New Component'
      const response = await axios.get('/e-letter/component/list_input')
      this.data_input = response.data
      this.attributs = [{
        attribut: '',
        value: '',
        count: 1
        }
      ]
      this.inputComponent = {}
    },

    updateComponent(){
      this.modal_header = 'Update Component'
    },

    onChange(event) {
      this.selected_type = event.target.value
      this.inputComponent.type = event.target.value
    },

    addAttribut() {
      this.attributs.push({
        attribut: '',
        count: ++this.count
      });
    }
  }
});
