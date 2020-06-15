<template>
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
                <h4>User {{user_id}}</h4>
          </div>
        </div>
    </div><!-- /.container-fluid -->
</template>

<script>
    export default {
         data (){
          return {
            user_id:null
          }
        },

        mounted(){
          this.user_id=this.$route.params.id;
        }

    }
</script>
