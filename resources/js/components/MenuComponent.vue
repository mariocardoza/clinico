<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4  position-fixed">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Clínico</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{this.usuario}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <router-link class="nav-link" to="/home"><i class="nav-icon fas fa-home"></i> Inicio</router-link>
          </li>

          <li class="nav-item has-treeview">
            <router-link class="nav-link" to="/users"><i class="nav-icon fas fa-user"></i> Usuarios</router-link>
          </li>

          <li class="nav-item has-treeview">
            <router-link class="nav-link" to="/roles"><i class="nav-icon fas fa-user"></i> Roles</router-link>
          </li>

          <li class="nav-item has-treeview">
            <router-link class="nav-link" to="/personas"><i class="nav-icon fas fa-user"></i> Personas</router-link>
          </li>

          <li class="nav-item has-treeview">
            <router-link class="nav-link" to="/unidades"><i class="nav-icon fas fa-ruler-combined"></i> Unidades</router-link>
          </li>

        </ul>

      </nav>

      <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
  </aside>
</template>

<script>
    export default {
      data(){
        return{
          usuario:'',
        }
      },
        mounted() {
            console.log('Component menu mounted.');
            console.log(App.persona);
            this.usuario=App.persona.nombre;
        }
    }
</script>
