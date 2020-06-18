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
            <h3 class="card-title">Listado de personas</h3>
            
          </div>
          <!-- /.card-header -->
          <!-- form start -->

            <div class="card-body table-responsive">
              <button v-if="$can('create')" type="button" class="btn btn-info float-right" v-on:click.prevent="nueva_persona">
                Nuevo
              </button>
             
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>DUI</th>
                    <th>NIT</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(persona,index) in personas">
                    <td>{{index+1}}</td>
                    <td>{{persona.nombre}}</td>
                    <td>{{persona.dui}}</td>
                    <td>{{persona.nit}}</td>
                    <td>{{persona.telefono}}</td>
                    <td>{{persona.direccion}}</td>
                    <td></td>
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
          personas:[],
          editMode:false,
        }
      },
        mounted() {
            this.loadPersonas();
        },

        methods:{
          nueva_persona(){
            this.$router.push('personas/create');
          },

          edit_persona(){
            this.editMode=true;
          },
          borrar(){

          },
          update_user(index,id){
            let params={
                    nombre:this.personas[index].nombre,
                    dui:this.personas[index].dui,
                    nit:this.personas[index].nit,
                    telefono:this.personas[index].telefono,
                    direccion:this.personas[index].direccion,
                };
                axios.put(`api/personas/${id}`,params)
                .then((response)=>{
                    this.editMode=false;
                    this.loadPersonas();
                    toastr.success("Modificado con éxito");
                })
                .catch(function (error) {
                  console.log(error);
                  toastr.error("Ocurrió un error con el servidor");
                });
          },
          loadPersonas(){
            axios.get('api/personas')
            .then((response)=>{
                this.personas=response.data
                console.log(response);
            });
          }
        }
    }
</script>
