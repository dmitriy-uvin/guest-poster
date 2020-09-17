<template>
    <div>
        <VBtn color="red" fab class="float-btn-action" @click="onAddPlatform">
            <VIcon color="white">mdi-plus</VIcon>
        </VBtn>
    </div>
</template>

<script>
export default {
    name: 'AdminGuestPosting',
    methods: {
        onAddPlatform() {
            this.$router.push({ name: 'AddPlatform' })
        }
    }
}
</script>

<style scoped>
.float-btn-action {
    position: absolute;
    bottom: 20px;
    right: 20px;
}
</style>