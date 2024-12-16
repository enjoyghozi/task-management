<template>
  <div class="container w-100">
    <RouterLink to="/task/create" class="btn btn-primary" type="button">Create Task</RouterLink>
    <table class="table table-dark">
      <thead class="table-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task, index in task" :key="task.id" class="table-active">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{ task.title }}</td>
          <td>{{ task.description }}</td>
          <td v-if="task.is_status == 1">Completed</td>
          <td v-else>Not Completed</td>
          <td>
            <RouterLink :to="`/task/${task.id}/edit`" class="btn btn-primary">Edit</RouterLink>
          </td>
        </tr>
      </tbody>
    </table>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
// export default {
//   name: "Task",
// }

let task = ref([]);
let pageData = ref([]);

const editMode = ref(false);

onMounted(async () => {
  getTasks();
  changePage();
  if (route.path == "/task/create") {
    editMode.value = false;
  } else {
    editMode.value = true;
  }
});

const getTasks = async () => {
  let response = await axios.get("http://127.0.0.1:8000/api/auth/task", {
    headers: {
      Authorization: `Bearer ${localStorage.getItem("token")}`,
    },
  })
    .then((response) => {
      task.value = response.data.data;
    });
}

const changePage = async (page) => {
  const response = await axios.get(`http://127.0.0.1:8000/api/auth/task?page=${page}`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem("token")}`,
    }
  });
  console.log(response.data.data);
  task.value = response.data.data;
}
</script>

<style lang="scss" scoped></style>