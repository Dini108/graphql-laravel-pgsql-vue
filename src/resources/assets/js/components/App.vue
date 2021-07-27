<template>
	<div class="w3-content" style="max-width:1400px">
		<app-header></app-header>
		<router-view></router-view>
	</div>
</template>

<script>
import AppHeader from './partials/AppHeader.vue';

export default {
  components : {
  	AppHeader
  }
}
</script>

<style scoped>

</style>