<template>
  <div>
    <nav class="navbar is-dark is-bold is-fixed-top" role="navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="/">
          <em class="fas fa-home"></em>
        </a>
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
          <a class="navbar-item" href="/factories">Factories</a>
          <a class="navbar-item" href="/warehouses">Wholesale</a>
          <a class="navbar-item" href="/networks">Pharmaceutical Networks</a>
          <a class="navbar-item" href="/pharmacies">Pharmacies</a>
          <a class="navbar-item" href="/employees">Employees</a>
          <a class="navbar-item" href="/positions">Positions</a>
        </div>
        <div class="navbar-end">
          <a class="navbar-item" href="/report">Report</a>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  methods: {
    toggleMenu: function(event) {
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
