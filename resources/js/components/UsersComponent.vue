<template>
  
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        </div>
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Listado de usuarios</h3>
            
          </div>
          <!-- /.card-header -->
          <!-- form start -->

            <div class="card-body table-responsive">
              <button v-if="$can('create_user')" type="button" class="btn btn-info float-right" v-on:click.prevent="nuevo_usuario">
                Nuevo
              </button>
             
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Username</th>
                    <th>Rol</th>
                    <th>Correo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user,index) in users">
                    <td>{{index+1}}</td>
                    <td>
                      <span>{{user.persona.nombre}}</span>
                    </td>
                    <td>
                      <input v-if="editMode" type="text" class="form-control" v-model="user.username">
                      <span v-else>{{user.username}}</span></td>
                    </td>
                    <td>
                      <span>{{user.roles[0].name}}</span>
                    </td>
                    <td>
                      <input v-if="editMode" type="text" class="form-control" v-model="user.email">
                      <span v-else>{{user.email}}</span></td>
                    <td>
                      <div v-if="$can('edit_user')">
                        <button v-if="editMode" class="btn btn-success" v-on:click="update_user(index,user.id)"><i class="fas fa-spinner"></i></button>
                        <button class="btn btn-warning" v-on:click.prevent="edit_user"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" v-on:click.prevent="borrar"><i class="fas fa-trash"></i></button>

                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Form Element sizes -->
        
        <!-- /.card -->

      </div>
      <!--/.col (left) -->
      <!-- right column -->
    
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

  <!-- modales aqui -->

</template>

<script>

    export default {
      data(){
        return {
          users:[],
          editMode:false,
        }
      },
        mounted() {
            this.loadUsers();
        },

        methods:{
          nuevo_usuario(){
            this.$router.push('users/create');
          },

          edit_user(){
            this.editMode=true;
          },
          borrar(){

          },
          update_user(index,id){
            let params={
                    username:this.users[index].username,
                    email:this.users[index].email,
                };
                axios.put(`api/usuarios/${id}`,params)
                .then((response)=>{
                    this.editMode=false;
                    this.loadUsers();
                    toastr.success("Modificado con éxito");
                })
                .catch(function (error) {
                  console.log(error);
                  toastr.error("Ocurrió un error con el servidor");
                });
          },
          loadUsers(){
            axios.get('api/usuarios')
            .then((response)=>{
                this.users=response.data
                console.log(response.data);
            });
          }
        }
    }
</script>
