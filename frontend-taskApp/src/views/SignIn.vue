<template>
	<div class="form-signin w-100 m-auto">
		<div class="row vh-100 justify-content-center align-items-center">
			<div class="py-4 border shadow-lg">
				<Form @submit.prevent="submit" class="d-grid gap-2">
					<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

					<div class="form-floating">
						<Field v-model="data.email" name="email" type="email" class="form-control" placeholder="name@example.com"
							:rules="validateEmail" />
						<label for="floatingInput">Email address</label>
						<ErrorMessage class="text-danger" name="email" />
					</div>
					<div class="form-floating">
						<Field v-model="data.password" name="password" type="password" class="form-control" placeholder="Password"
							:rules="validatePassword" />
						<ErrorMessage class="text-danger" name="password" />
						<label for="floatingPassword">Password</label>
					</div>
					<div class="">
						<p>Don't have an account? <RouterLink to="/register">Sign Up</RouterLink>
						</p>
					</div>
					<button class="btn btn-primary w-100 py-2 mt-1" type="submit" @click="submit()">Sign in</button>
				</Form>
			</div>
		</div>
	</div>
</template>

<script lang="ts">
import { Form, Field, ErrorMessage } from 'vee-validate';
import axios from 'axios';
import router from '../router';

export default {
	name: "signin",

	components: {
		Form,
		Field,
		ErrorMessage
	},

	data() {
		return {
			data: {
				email: '',
				password: ''
			}
		}
	},

	methods: {
		validateEmail(value) {
			// if the field is empty
			if (!value) {
				return 'This field is required';
			}
			// if the field is not a valid email
			const regex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
			if (!regex.test(value)) {
				return 'This field must be a valid email';
			}
			// All is good
			return true;
		},

		validatePassword(value) {
			// if the field is empty
			if (!value) {
				return 'This field is required';
			}

			if (value.length < 8) {
				return 'Password must be at least 8 characters';
			}

			// if (!/[A-Z]/.test(value)) {
			// 	return 'Password must contain at least one uppercase letter';
			// }

			if (!/[a-z]/.test(value)) {
				return 'Password must contain at least one lowercase letter';
			}

			if (!/[0-9]/.test(value)) {
				return 'Password must contain at least one number';
			}
			// All is good
			return true;
		},

		submit() {
			axios.post('http://127.0.0.1:8000/api/auth/login', this.data)
				.then(function (response) {
					localStorage.setItem('name', response.data.access_token.name);
					localStorage.setItem('email', response.data.access_token.email);
					localStorage.setItem('role', response.data.access_token.role);
					localStorage.setItem('token', response.data.access_token.token);
					router.push('/');
				})
				.catch(function (error) {
					console.log(error);
				});
		}
	},

	mounted() {
		this.userName = localStorage.getItem('name');
		if (this.userName) {
			router.push('/');
		}
	}
}
</script>

<style lang="scss" scoped></style>