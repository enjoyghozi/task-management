<template>
  <div class="w-100 m-auto">
		<div class="row vh-100 justify-content-center align-items-center">
			<div class="py-4 border shadow-lg">
				<Form @submit.prevent="submit" class="d-grid gap-2">
					<h1 class="h3 mb-3 fw-normal" v-if="$route.path === '/task/create'">Create Task</h1>
          <h1 class="h3 mb-3 fw-normal" v-else>Edit Task</h1>

					<div class="form-floating">
						<Field v-model="data.title" name="title" type="text" class="form-control"
							:rules="validateTitle" />
						<label for="floatingInput">Title</label>
						<ErrorMessage class="text-danger" name="title" />
					</div>
					<div class="form-floating">
						<Field v-model="data.description" name="description" type="description" class="form-control" placeholder="description"
							:rules="validateDescription" />
						<ErrorMessage class="text-danger" name="description" />
						<label for="floatingDescription">Description</label>
					</div>
					<button class="btn btn-primary w-100 py-2 mt-1" type="submit" @click="submit()">Save</button>
				</Form>
			</div>
		</div>
	</div>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import axios from 'axios';
import router from '../../router';

  export default {
    name: "create-task",
    components: {
      Form,
      Field,
      ErrorMessage
    },
    data() {
      return {
        data: {
          title: '',
          description: '',
        }
      }
    },

    methods: {
      validateTitle(value) {
        if (!value) {
          return 'This field is required';
        }
        return true;
      },

      validateDescription(value) {
        if (value > 255) {
          return 'Description must be less than 255 characters';
        }
        return true;
      },

      submit() {
        axios.post('http://127.0.0.1:8000/api/auth/task', {
          title: this.data.title,
          description: this.data.description,
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
          }
        }) 
        .then(function (response) {
          router.push('/task');
        })
        .catch(function (error) {
          console.log(error);   
        })
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>