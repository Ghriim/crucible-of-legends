<template>
  <div id="page-container">
    <UserApp />
  </div>
</template>

<script>
import UserApp from "@user-views/UserApp";
import PublicApp from "@public-views/PublicApp";


export default {
    name: "App",
    components: {PublicApp, UserApp},
}
</script>
