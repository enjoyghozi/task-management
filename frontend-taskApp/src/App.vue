<template>
	<Nav />
	<main class="container mt-5 w-100 m-auto">
		<RouterView />
	</main>
</template>

<script setup>
import Nav from './components/Nav.vue';
</script>

<style lang="scss" scoped>
html,
body {
	height: 100%;
}

.form-signin {
	max-width: 330px;
	padding: 1rem;
}

.form-signin .form-floating:focus-within {
	z-index: 2;
}

.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
