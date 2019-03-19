<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet"> -->
    <link  rel="stylesheet" href="<?= base_url() ?>css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="<?= base_url() ?>font-awesome/css/font-awesome.min.css"/>
    <!-- <link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet"> -->
    <script type="text/javascript" src="<?= base_url() ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.8/dist/vue.js"></script>
    <script src="https://unpkg.com/vuex@3.1.0/dist/vuex.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <title>e-Letter</title>
  </head>
  <body>
    <div id="app">
      <div class="container" style="max-width:93%">
        <div class="row">
          <div class="col-md-12">
            <br /><br />
            <button v-on:click="newComponent()" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-form">Create New Component</button><br /><br />
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
                  <button v-on:click="destroy(component.id)" class="btn btn-md btn-danger"><i class="fa fa-trash"> </i></button>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div id="modal-form" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <!-- Modal content-->
          <div class="modal-content ">
            <div class="modal-header">
              <h5 class="modal-title">{{modal_header}}</h5>
              <button type="button" class="pull-right close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <h6>Basic Setting</h6><hr />
                  <form id='input-component'>
                  <div class="form-group">
                    <label for="usr">Name: * </label>
                    <input autocomplete="off" v-model="inputComponent.name" type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="usr">Variable Name: * </label>
                    <input autocomplete="off" v-model="inputComponent.variable_name" type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="sel1">Input type: * </label>
                    <select v-on:change="onChange($event)" class="form-control" v-model="inputComponent.type">
                      <option value="" disabled selected>Select input type</option>
                      <option v-for='(value, key) in data_input' v-bind="key">{{key}}</option>
                    </select>
                  </div>
                  </form>
                </div>

                <div class="col-md-6">
                  <h6>Attribut Setting</h6><hr />
                  <div class="row" v-for="attribut in attributs">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="usr">Attribut {{attribut.count}}: </label>
                        <input :placeholder="'attribut ' + attribut.count" v-model="attribut.attribut" autocomplete="off" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="usr">Value {{attribut.count}} :  </label>
                        <input :placeholder="'value ' + attribut.count" v-model="attribut.value" autocomplete="off" type="text" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button v-on:click="addAttribut()" class="btn btn-success btn-sm center"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button v-on:click="addComponent()" type="button" class="btn btn-save btn-success">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>

    </div>
  </body>
</html>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script> -->

<!-- type text number  -->
<template id="input-text">
  <form>
    <div class="form-group">
      <label for="readonly">Placeholder: </label>
      <input v-model="placeholder" autocomplete="off" type="text" class="form-control">
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="readonly">Auto Complete: </label><br />
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" name="autocomplete" v-model="autocomplete" value="on"/>On
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" name="autocomplete" v-model="autocomplete" value="off"/>Off
            </label>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="readonly">Readonly: </label><br />
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" v-model="readonly" value="readonly"/>True
            </label>
          </div>
          <div class="form-check-inline">
            <label class="form-check-label">
              <input type="radio" v-model="readonly" value="false"/>False
            </label>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script src="<?= base_url() ?>frontend/app.js"></script>
