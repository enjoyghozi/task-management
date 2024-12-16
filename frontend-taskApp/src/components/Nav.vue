<template>
	<!-- <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4" v-if="$route.path !== '/login' && $route.path !== '/register'">
		<div class="container-fluid">
			<div>
				<RouterLink class="navbar-brand" :class="{ active: $route.path === '/' }" to="/">Dashboard</RouterLink>
				<RouterLink class="navbar-brand" :class="{ active: $route.path === '/task' }" to="/task">Task</RouterLink>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
				aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div>
				<ul class="navbar-nav me-auto mb-2 mb-md-0">
					<li class="nav-item">
						<a class="nav-link" href="#" @click="logout()">Sign Out</a>
					</li>
				</ul>
			</div>
		</div>
	</nav> -->

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"
		v-if="$route.path !== '/login' && $route.path !== '/register'">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">TaskApp</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<div class="d-flex flex-column flex-lg-row">
						<a class="nav-link" :class="{ active: $route.path === '/' }" href="/">Dashboard</a>
						<a class="nav-link" :class="{ active: $route.path === '/task' }" href="/task">Task</a>
					</div>
				</div>
				<div class="container d-flex gap-3 w-100 justify-content-end">
					<a class="sign-out text-decoration-none" href="#">{{ userName }}</a>
					<a class="sign-out text-decoration-none" href="#" @click="logout()">Sign Out</a>
				</div>
			</div>
		</div>
	</nav>
</template>

<script>
import axios from 'axios';
import router from '../router';
// import router from '../router';
export default {
	name: "Nav",

	data() {
		return {
			userName: localStorage.getItem('name')
		}
	},

	methods: {
		logout() {
			localStorage.removeItem('name');
			localStorage.removeItem('email');
			localStorage.removeItem('role');
			localStorage.removeItem('token');
			router.push('/login');
		}
	}
}
</script>

<style scoped>
.navbar-brand.active {
	color: #ffdfa4;
	border-radius: 5px;
}

.sign-out {
	color: #c9c8c8;
}

.sign-out:hover {
	color: #f5f5f5;
}
</style>