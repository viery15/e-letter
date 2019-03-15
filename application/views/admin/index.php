<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link  rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.8/dist/vue.js"></script>
    <title></title>
  </head>
  <body>
    <div id="app">
      <div class="container" style="max-width:93%">
        <div class="row">
          <div class="col-md-12">
            <br /><br />
            <button class="btn btn-sm btn-info">Create New Component</button><br /><br />
            <table class="table table-striped table-bordered">
              <tr>
                <th style="text-align:center" v-for='column in columns'>{{column}}</th>
                <th style="text-align:center">Action</th>
              </tr>
              <tr v-for='component in components'>
                <td width='20%'>{{component.name}}</td>
                <td width='20%'>{{component.variable_name}}</td>
                <td>{{component.html_basic}}</td>
                <td style="text-align:center" width='15%'>
                  <button class="btn btn-sm btn-warning">Update</button>
                  <button v-on:click="deleteComponent(component.id)" class="btn btn-sm btn-danger">Delete</button>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
new Vue({
  el: '#app',
  mounted() {
    this.init();
  },
  data: {
    columns: ['Name', 'Variable Name', 'HTML Basic'],
    components: [],
  },
  methods: {
    async init(){
      const response = await axios.get('/e-letter/component')
      this.components = response.data
    },

    deleteComponent(id){
      axios.delete('/e-letter/component/delete/' + id)
      .then(response => {
        this.init();
      });
    },

  }
});
</script>
