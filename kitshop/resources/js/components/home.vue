<template>
  <div>
    <div class="input-body input-wrapper">
      <input
        v-model="signup"
        class="input body-md input-body"
        id="signup"
        name="signup"
        placeholder="Email Address"
      />

      <button
        v-on:click="validateEmail(signup)"
        type="submit"
        style="text-decoration: none"
        class="
          button-container
          is-base is-fullwidth-mobile
          button-text
          is-light
        "
      >
        Sign up
      </button>
    </div>
    <p class="is-centered" v-if="emailFail" style="color: red">
      Something went wrong
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      emailFail: false,
      signup: "",
      redirect: "",
    };
  },
  //   props: ['emailFail'],

  methods: {
    validateEmail() {
      axios
        .post("/newsletter", {
          // emailFail: this.emailFail,
          signup: this.signup,
          redirect: this.redirect,
        })
        .then((response) => {
          this.emailFail = response.data.emailFail;
          if (response.data.redirect) {
            window.location = response.data.redirect;
          } else {
            console.log(response);
          }
        })

    },
  },
};
</script>

<style scoped>
.page-title {
  background: gray;
  padding: 10px;
  text-align: center;
  width: 50%;
  color: white;
}
.body-content {
  border: 1px solid;
  width: 50%;
  padding: 9px;
  text-align: center;
}
</style>