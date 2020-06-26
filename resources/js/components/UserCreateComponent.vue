<template>
	<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Registro de usuarios</h3>
            
          </div>
          <!-- /.card-header -->
          <!-- form start -->

           <div class="card-body">
                <form role="form" v-on:submit.prevent="guardar">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="">Persona</label>
                        <select v-model="persona_id" class="form-control">
                          <option v-for="per in personas" v-bind:value="per.id">{{per.nombre}}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nombre de usuario</label>
                        <input type="text" v-model="username" class="form-control" placeholder="Ingrese nombre de usuario">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Correo electrónico</label>
                        <input type="email" v-model="email" class="form-control" placeholder="correo@ejemplo.com" >
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" v-model="password" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="">Repetir Contraseña</label>
                        <input type="password" v-model="password_confirmation" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <button class="btn btn-primary" type="submit">Guardar</button>
                      <button v-on:click.prevent="volver" class="btn btn-danger" type="button">Volver</button>
                    </div>
                  </div>
                </form>
              </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- Form Element sizes -->
        
        <!-- /.card -->

      </div>
    </div>
</div><!-- /.container-fluid -->
</template>
<script>
    export default {
      data(){
        return {
          username:'',
          email:'',
          persona_id:'',
          password:'',
          password_confirmation:'',
          errores:[],
          personas:[],
        }
      },
      mounted() {
        this.traerPersonas();
      },

      methods:{
        guardar(){
        axios.post('/api/usuarios/',{ username:this.username,email:this.email,persona_id:this.persona_id,password:this.password,password_confirmation:this.password_confirmation})
          .then((response)=>{
                toastr.success("Guardado");
              this.username='';
              this.email='';
              this.persona='';
              this.password='';
              this.password_confirmation='';
              this.$router.push('/users');

          }).catch(e => {
            let esto=this;
              $.each(e.response.data.errors, function(key, value) {
                toastr.error(value);
              });
              
          });
      },
      volver(){
        this.$router.push('/users');
      },
      traerPersonas(){
        axios.get('/api/personas')
          .then((response)=>{
              this.personas=response.data;
              console.log(response);
          });
      },
      }
    }
</script>