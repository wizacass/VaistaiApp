<template>
  <div>
    <nav class="navbar is-dark is-bold is-fixed-top" role="navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="/">Home</a>
        <a
          role="button"
          class="navbar-burger"
          :class="{'is-active' : isMenuShown}"
          aria-label="menu"
          aria-expanded="false"
          v-on:click="toggleMenu"
        >
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>
      <div class="navbar-menu" :class="{'is-active' : isMenuShown}">
        <div class="navbar-start">
          <a class="navbar-item" href="#">TBA</a>
          <a class="navbar-item" href="#">TBA</a>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  methods: {
    toggleMenu: function(event) {
      console.log("Menu toggled!");
      this.isMenuShown = !this.isMenuShown;
    }
  },
  data: function() {
    return {
      isMenuShown: false
    };
  }
};
</script>
