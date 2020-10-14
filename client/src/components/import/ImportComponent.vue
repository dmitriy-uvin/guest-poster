<template>
    <div class="container">
        <h1>Import Platforms</h1>
        <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

        <div class="row align-center">
            <VCol
                cols="4"
                md="4"
            >
                <VFileInput
                    ref="file_input"
                    clearable
                    dense
                    prepend-icon="mdi-table"
                    class="mt-2"
                    accept="text/csv"
                    :rules="importRules"
                    v-model="fileTable"
                    show-size
                    label="Upload CSV, XLSX file"
                >
                </VFileInput>
            </VCol>
            <VCol cols="5" class="">
                <VBtn
                    color="blue-grey"
                    class="ma-2 white--text"
                    @click="onUpload"
                >
                    Upload
                    <v-icon
                        right
                        dark
                    >
                        mdi-cloud-upload
                    </v-icon>
                </VBtn>
            </VCol>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
export default {
    name: 'ImportComponent',
    data: () => ({
        importRules: [
            v => (v && v.type === 'text/csv') || 'File CSV is required'
        ],
        fileTable: []
    }),
    methods: {
        ...mapActions('platforms', {
            importPlatforms: actions.IMPORT_PLATFORMS,
        }),
        async onUpload() {
            if (this.$refs.file_input.validate()) {
                const formData = new FormData();
                formData.append('platforms_table', this.fileTable);
                const response = await this.importPlatforms(formData);
                console.log(response);
                // console.log(this.fileTable);
            }
        }
    }
}
</script>

<style scoped>

</style>