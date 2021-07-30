<template>
    
</template>

<script>
export default {

    created() {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
         Toast.fire({
         icon: 'success',
         title: 'Successfully logout'
     })
     this.$router.push({name:'/'})
    }

}
</script>


<style scoped>

</style>
