<?php $this->load->view('admin/partials/style.php') ?>
<?php $this->load->view('admin/partials/script.php') ?>
<div id="app2">
  <v-app id="inspire">
    <v-toolbar
      color="#1867c0"
      dark
      fixed
      app
      clipped-right
    >
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>e-Letter</v-toolbar-title>
      <v-spacer></v-spacer>
    </v-toolbar>
    <v-navigation-drawer
      v-model="drawer"
      fixed
      app
    >
      <v-list dense>
        <v-list-tile @click.stop="left = !left">
          <v-list-tile-action>
            <v-icon>dns</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Component Input</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-list dense>
        <v-list-tile @click.stop="left = !left">
          <v-list-tile-action>
            <v-icon>receipt</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Letter Format</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-list dense>
        <v-list-tile @click.stop="left = !left">
          <v-list-tile-action>
            <v-icon>exit_to_app</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Logout</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-navigation-drawer
      v-model="left"
      temporary
      fixed
    ></v-navigation-drawer>
    <v-content>
      <v-container grid-list-md text-xs-left>
        <v-layout row wrap>
          <v-flex xs12>

              <input-component></input-component>
            
          </v-flex>
          <v-flex xs12>
            <data-table></data-table>
          </v-flex xs12>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</div>


<?php $this->load->view('admin/component/component') ?>
<script src="<?= base_url() ?>frontend/app2.js"></script>
