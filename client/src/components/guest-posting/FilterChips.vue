<template>
    <div>
        <VChip v-for="key in Object.keys(filteredChips)" :key="key" class="mr-1 mb-1">
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
        <VChip v-for="(value, index) in filterChipsTopics" :key="index" class="mr-1 mb-1">
            {{ value }}
            <VIcon right small @click="$emit('delete-filter', ['Topics', value])">mdi-close-circle</VIcon>
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
                    if (!['Dofollow', 'Niche Edit Link', 'Home Featured'].includes(key)) {
                        if (this.filterChips[key] !== '') {
                            result[key] = this.filterChips[key];
                        }
                    } else {
                        if (this.filterChips[key] !== 'all') {
                            result[key] = this.filterChips[key];
                        }
                    }
                }
            });
            return result;
        },
        filterChipsTopics() {
            let result = [];
            Object.keys(this.filterChips).filter(key => {
                if (Array.isArray(this.filterChips[key])) {
                    if (key === 'Topics') {
                        if (this.filterChips[key].length) {
                            result = this.filterChips[key];
                        }
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