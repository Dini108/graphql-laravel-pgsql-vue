<template>
  <div class="w3-row">
    <div class="w3-col col-lg-12 ">
      <template v-if="loading">
        Loading ...
      </template>
      <template v-else>
        <table class="table table-bordered">
          <thead>
          <th v-on:click="getUsersPerPage(page,'id')">id</th>
          <th v-on:click="getUsersPerPage(page,'name')">name</th>
          <th v-on:click="getUsersPerPage(page,'email')">email</th>
          <th v-on:click="getUsersPerPage(page,'phone_number')">phone</th>
          <th v-on:click="getUsersPerPage(page,'is_active')">is_active</th>
          <th v-on:click="getUsersPerPage(page,'birthdate')">birthdate</th>
          <th v-on:click="getUsersPerPage(page,'created_at')">created_at</th>
          <th v-on:click="getUsersPerPage(page,'updated_at')">updated_at</th>
          <th>edit</th>
          <th>create</th>
          <th>delete</th>
          </thead>
          <tbody>
          <user-list-item @errors="getErrorsFromChildren($event)" @refresh="getUsersPerPage" v-for="user in usersPerPage.users" :key="user.id"
                          :user="user"></user-list-item>
          </tbody>
        </table>
      </template>
      <paginate
          :page-count="page_count"
          :click-handler="getUsersPerPage"
          :initial-page="page - 1"
          :prev-text="'&lt;'"
          :next-text="'&gt;'"
          :container-class="'pagination w3-margin'"
          :page-class="'page-item'"
          :prev-class="'page-item'"
          :prev-link-class="'page-link'"
          :next-class="'page-item'"
          :next-link-class="'page-link'"
          :page-link-class="'page-link'">
      </paginate>
    </div>
    <div v-if="errors.length != 0" id="errors" style="color: red">
      {{ errors }}
    </div>
  </div>

</template>

<script>
import gql from 'graphql-tag';
import UserListItem from './UserListItem.vue';

const usersPerPageQuery = gql`
  query usersPerPageQuery($page : Int, $limit: Int, $order: String, $order_direction: String){
    usersPerPage( page : $page, limit : $limit, order : $order, order_direction : $order_direction){
      total
      per_page
      users : data {
        id name email phone date_of_birth is_active created_at updated_at
      }
    }
  }
`;


export default {
  components: {
    UserListItem
  },
  data: () => ({
    page: 1,
    limit: 5,
    loading: true,
    errors: []
  }),
  mounted: function () {
    this.getUsersPerPage(this.$route.query.page || 1);
  },
  computed: {
    page_count: function () {
        return Math.ceil(this.usersPerPage.total / this.limit);
    }
  },
  methods: {
    getUsersPerPage(page = null, order = null, order_direction = null) {
      this.loading = true;
      if (page === null) {
        page = this.$route.query.page
      } else {
        page = parseInt(page);
      }

      if (this.$route.query.order !== null && order === null) {
        order = this.$route.query.order
      }

      this.$apollo.query({
        query: usersPerPageQuery,
        variables: {
          page: page,
          limit: this.limit,
          order: order ?? '',
          order_direction: order_direction ?? ''
        },
        fetchPolicy: 'network-only'
      })
      .then((response) => {
        response = JSON.parse(JSON.stringify(response));
        this.usersPerPage = response.data.usersPerPage;

        /* Nem szép */
        this.usersPerPage.users = this.usersPerPage.users.map(function(obj) {
          if (obj.phone) {
            obj.phone = JSON.parse(obj.phone).phone_number
          }
          return obj;
        });
        console.log(this.usersPerPage.users);
        this.page = page;
        this.loading = false;
        this.$router.push({query: {page, order}});
      })
      .catch((error) => {
        this.errors = error;
      });
    },
    getErrorsFromChildren(errors){
      this.errors = errors;
    },
  }
};
</script>