<template>
	<div class="form-signin w-100 m-auto">
		<div class="row vh-100 justify-content-center align-items-center">
			<div class="py-4 border shadow-lg">
				<Form @submit.prevent="submit" class="d-grid gap-2">
					<h1 class="h3 mb-3 fw-normal">Please sign up</h1>
					<div class="form-floating">
						<Field v-model="data.name" name="name" type="name" class="form-control" placeholder="Example Name"
							:rules="validateName" />
						<ErrorMessage class="text-danger" name="name" />
						<label for="floatingInput">Name</label>
					</div>
					<div class="form-floating">
						<Field v-model="data.email" name="email" type="email" class="form-control" placeholder="name@example.com"
							:rules="validateEmail" />
						<ErrorMessage class="text-danger" name="email" />
						<label for="floatingInput">Email address</label>
					</div>
					<div class="form-floating">
						<Field v-model="data.password" name="password" type="password" class="form-control" placeholder="Password"
							:rules="validatePassword" />
						<ErrorMessage class="text-danger" name="password" />
						<label for="floatingPassword">Password</label>
					</div>
					<p>Already have an account? <RouterLink to="/login">Sign In</RouterLink></p>
					<button class="btn btn-primary w-100 py-2 mt-3" type="submit" @click="submit">Sign up</button>
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
	name: "signup",

	components: {
		Form,
		Field,
		ErrorMessage
	},

	data() {
		return {
			data: {
				name: '',
				email: '',
				password: ''
			}
		}
	},

	methods: {
		validateName(value) {
			// if the field is empty
			if (!value) {
				return 'This field is required';
			}
			// All is good
			return true;
		},

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

			if (!/[A-Z]/.test(value)) {
				return 'Password must contain at least one uppercase letter';
			}

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
			axios.post('http://127.0.0.1:8000/api/auth/register', this.data)
				.then(function (response) {
					console.log(response);
					router.push('/login');
				})
				.catch(function (error) {
					console.log(error);
				})
		}
	}
}
</script>

<style lang="scss" scoped></style>