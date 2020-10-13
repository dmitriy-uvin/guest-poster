<template>
    <div class="order-footer" :class="{ 'd-block': chosenPlatformsCounter }">
        <div class="container">
            <VRow class="justify-space-between">
                <div class="">
                    <VBtn color="#e1eeff" depressed @click="onUnselectAll">Unselect All</VBtn>
                </div>
                <div class="">
                    <VBtn
                        color="red"
                        @click="onPlatformsDelete"
                        dark
                    >
                        Delete
                        <VIcon right>mdi-delete</VIcon>
                    </VBtn>
                </div>
            </VRow>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DeletePlatformsFooter',

    props: {
        chosenPlatformsIds: {
            required: true
        }
    },
    methods: {
        onUnselectAll() {
            this.$emit('unselect-all');
        },
        onPlatformsDelete() {
            this.$emit('platforms-delete', this.chosenPlatformsIds);
        }
    },
    computed: {
        chosenPlatformsCounter() {
            return this.chosenPlatformsIds.length;
        },
    }
}
</script>

<style scoped>
.order-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    box-shadow:
        0px 2px 4px 4px rgba(0, 0, 0, 0.2),
        0px 4px 5px 5px rgba(0, 0, 0, 0.14),
        0px 1px 10px 4px rgba(0, 0, 0, 0.12);
    display: none;
    background: white;
}
</style>