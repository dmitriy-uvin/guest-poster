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
                    :loading="uploadLoading"
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
        <VBtn
            depressed
            color="primary"
            @click="errors = []" v-if="errors.length"
            class="mb-4"
        >
            Clear Errors
        </VBtn>
        <VAlert
            transition="scroll-y-transition"
            border="right"
            colored-border
            type="error"
            elevation="2"
            v-for="(error, index) in reverseErrors"
            :key="index"
        >
            {{ error }}
        </VAlert>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import notificationMixin from '@/mixins/notificationMixin';

export default {
    name: 'ImportComponent',
    mixins: [notificationMixin],
    data: () => ({
        importRules: [
            v => (v && v.type === 'text/csv') || 'File CSV is required'
        ],
        fileTable: [],
        errors: [],
        uploadLoading: false
    }),
    methods: {
        ...mapActions('platforms', {
            importPlatforms: actions.IMPORT_PLATFORMS,
        }),
        async onUpload() {
            if (this.$refs.file_input.validate()) {
                try {
                    this.uploadLoading = true;
                    const formData = new FormData();
                    formData.append('platforms_table', this.fileTable);
                    const response = await this.importPlatforms(formData);
                    console.log(response);
                    this.setNotification({
                        type: 'success',
                        message: 'Platforms was imported!'
                    });
                    this.uploadLoading = false;
                } catch (error) {
                    this.errors = [
                        ...this.errors,
                        error
                    ];
                    this.uploadLoading = false;
                }
            }
        }
    },
    computed: {
        reverseErrors() {
            return this.errors.slice().reverse();
        }
    }
}
</script>

<style scoped>

</style>