<template>
  <tr>
    <th id="user_id">{{ user.id }}</th>
    <td>
      <div v-if="!isCreating">
        <span v-if="!isEditing ">{{ user.name }}</span>
        <input id="user_name" v-if="isEditing" ref="user_name" type="text"
               v-bind:value="user.name">
      </div>
      <div v-else>
        <input id="user_name" ref="user_name" type="text">
      </div>
    </td>
    <td>
      <div v-if="!isCreating">
        <span v-if="!isEditing">{{ user.email }}</span>
        <input id="user_email" v-if="isEditing" ref="user_email" type="text"
               v-bind:value="user.email">
      </div>
      <div v-else>
        <input id="user_email" ref="user_email" type="text">
      </div>
    </td>
    <td >
      <div v-if="!isCreating">
        <span v-if="!isEditing">{{ user.phone }}</span>
        <input id="user_phone" v-if="isEditing" ref="user_phone" type="text"
               v-bind:value="user.phone">
      </div>
      <div v-else>
        <input id="user_phone" ref="user_phone" type="text">
      </div>
    </td>
    <td>
      <div v-if="!isCreating">
        <span v-if="!isEditing">{{ user.is_active }}</span>
        <input id="user_is_active" v-if="isEditing" ref="user_is_active" type="checkbox"
               v-bind:value="user.is_active">
      </div>
      <div v-else>
        <input id="user_is_active" v-if="isCreating" ref="user_is_active" type="checkbox">
      </div>
    </td>
    <td>
      <div v-if="!isCreating">
        <span v-if="!isEditing">{{ user.date_of_birth }}</span>
        <input id="user_date_of_birth" v-if="isEditing" ref="user_date_of_birth" type="text"
               v-bind:value="user.date_of_birth">
      </div>
      <div v-else>
        <input  id="user_date_of_birth" ref="user_date_of_birth" type="text">
      </div>
    </td>
    <td id="user_created_at" class="w3-opacity">{{ user.created_at |  moment("dddd, MMMM Do YYYY") }}</td>
    <td id="user_updated_at" class="w3-opacity">{{ user.updated_at |  moment("dddd, MMMM Do YYYY") }}</td>
    <td>
      <a id="start_user_edit" v-if="!isEditing && !isCreating" v-on:click="edit()">Edit</a>
      <a id="user_edit" v-if="isEditing" v-on:click="saveUser(user.id)">Save</a>
    </td>
    <td>
      <a id="start_user_create" v-if="!isEditing && !isCreating" v-on:click="create()">Create</a>
      <a id="user_create" v-if="isCreating" v-on:click="createUser()">Create</a>
    </td>
    <td>
      <a v-if="!isEditing && !isCreating" id="user_delete" v-on:click="deleteUser(user.id)">Delete</a>
    </td>
  </tr>
</template>

<script>
import gql from "graphql-tag";

const deleteUserMutation = gql`
  mutation deleteUserMutation($id : Int!) {
    user : deleteUser( id : $id){
      id
    }
  }
`;

const editUserMutation = gql`
mutation UserMutation($id : Int,$name : String!, $email : String!, $phone : String!, $is_active : Boolean, $date_of_birth : String) {
    user : user( id : $id, name : $name, email : $email, phone : $phone , is_active : $is_active, date_of_birth : $date_of_birth ) {
      id
      name
      email
      phone
      is_active
      date_of_birth
    }
    }
`;

const createUserMutation = gql`
mutation UserMutation($name : String!, $email : String!, $phone : String!, $is_active : Boolean, $date_of_birth : String) {
    user : user( name : $name, email : $email, phone : $phone , is_active : $is_active, date_of_birth : $date_of_birth ) {
      id
      name
      email
      phone
      is_active
      date_of_birth
    }
    }
`;

export default {
  data() {
    return {
      isEditing: false,
      isCreating: false
    }
  },
  props: ['user'],
  methods: {
    edit() {
      this.isEditing = true;
    },

    create() {
      this.isCreating = true;
    },

    deleteUser(id) {
      this.$apollo.mutate({
        mutation: deleteUserMutation,
        variables: {
          id: id,
        },
        fetchPolicy: 'no-cache'
      })
      .then((response) => {
        this.$emit('errors',[])
        this.$emit('refresh');
      })
      .catch((error) => {
        this.$emit('errors',error)
      });
    },

    saveUser(id) {
      this.$apollo.mutate({
        mutation: editUserMutation,
        variables: {
          id: id,
          name: this.$refs.user_name.value,
          email: this.$refs.user_email.value,
          phone: this.$refs.user_phone.value,
          is_active: Boolean(this.$refs.user_is_active.value),
          date_of_birth: this.$refs.user_date_of_birth.value,
        },
        fetchPolicy: 'no-cache'
      })
      .then((response) => {
        this.isEditing = false;
        this.$emit('errors',[])
        this.$emit('refresh');
      })
      .catch((error) => {
        this.$emit('errors',error)
      });
    },
    createUser() {
      this.$apollo.mutate({
        mutation: editUserMutation,
        variables: {
          name: this.$refs.user_name.value,
          email: this.$refs.user_email.value,
          phone: this.$refs.user_phone.value,
          is_active: Boolean(this.$refs.user_is_active.value),
          date_of_birth: this.$refs.user_date_of_birth.value,
        },
        fetchPolicy: 'no-cache'
      })
      .then((response) => {
        this.isEditing = false;
        this.$emit('errors',[])
        this.$emit('refresh');

      })
      .catch((error) => {
        this.$emit('errors',error)
      });
    }
  }
}
</script>

<style scoped>

</style>
