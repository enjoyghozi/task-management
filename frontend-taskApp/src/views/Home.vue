<template>
	<div class="bg-body-secondary border border-1 p-5 rounded shadow">
    <h1>Welcome {{ userName }}</h1>
    <p class="lead">Effortlessly organize, track, and complete your tasks with the Task Management App. Designed for productivity and simplicity, it helps individuals and teams stay focused and achieve their goals.</p>
    <a class="btn btn-lg btn-primary" href="/task" role="button">Get started &raquo;</a>
  </div>
</template>

<script>
import router from '../router';

export default {
	data() {
		return {
			userName: ''
		}
	},

	mounted() {
		this.userName = localStorage.getItem('name');
		if (!this.userName) {
			router.push('/login');
		}
	},
}
</script>