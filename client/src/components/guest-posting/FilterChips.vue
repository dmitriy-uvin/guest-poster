<template>
    <div>
        <VChip v-for="key in Object.keys(filteredChips)" :key="key" class="mr-1">
            {{ key }}:
            <span v-if="filteredChips[key].from" class="ml-1">
                from {{ filteredChips[key].from }}
            </span>
            <span v-if="filteredChips[key].to" class="ml-1">
                to {{ filteredChips[key].to }}
            </span>
            <span v-if="typeof filteredChips[key] === 'string'" class="ml-1">
                {{ filteredChips[key] }}
            </span>
            <VIcon right small @click="$emit('delete-filter', key)">mdi-close-circle</VIcon>
        </VChip>
    </div>
</template>

<script>
export default {
    name: 'FilterChips',
    props: {
        filterChips: {
            required: true
        },
        filtersApplied: {
            required: true
        }
    },
    computed: {
        filteredChips() {
            const result = {};
            Object.keys(this.filterChips).filter(key => {
                // if (Array.isArray(this.filterChips[key])) {
                //     if (this.filterChips[key].length) {
                //         result[key] = this.filterChips[key];
                //     }
                // }
                if (typeof this.filterChips[key] === 'object') {
                    if (this.filterChips[key].from || this.filterChips[key].to) {
                        result[key] = this.filterChips[key];
                    }
                }
                if (typeof this.filterChips[key] === 'string') {
                    if (this.filterChips[key] !== '') {
                        result[key] = this.filterChips[key];
                    }
                }
            });
            return result;
        }
    }
}
</script>

<style scoped>

</style>