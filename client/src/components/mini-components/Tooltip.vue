<template>
    <VTooltip :top="top" :bottom="bottom" :left="left" :right="right">
        <template v-slot:activator="{ on, attrs }">
            <VIcon
                small
                v-bind="attrs"
                v-on="on"
            >
                {{ icon }}
            </VIcon>
        </template>
        <span>{{ message }}</span>
    </VTooltip>
</template>

<script>
export default {
    name: 'Tooltip',
    props: {
        message: { required: true },
        icon: {
            default: 'mdi-information-outline'
        },
        align: {
            default: 'top'
        }
    },
    computed: {
        top() {
            return this.align === 'top';
        },
        left() {
            return this.align === 'left';
        },
        right() {
            return this.align === 'right';
        },
        bottom() {
            return this.align === 'bottom';
        }
    }
}
</script>

<style scoped>

</style>