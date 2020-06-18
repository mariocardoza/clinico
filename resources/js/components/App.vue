<style>
	.v-enter, .v-leave-active{
		transition: opacity .3s;
	}
	.v-enter, .v-leave-to{
		opacity: 0;
	}
</style>
<template>
	<div>
		<transition>
		<router-view></router-view>
		</transition>
	</div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component app mounted.')
        }
    }
</script>