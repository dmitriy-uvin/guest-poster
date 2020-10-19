<template>
    <div class="container">
        <h1>Import Platforms</h1>
        <p class="mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

        <div class="row align-center">
            <VCol
                cols="12"
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
            <VCol cols="12" md="8" class="">
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
                <VBtn depressed @click="downloadFile" outlined>
                    Download Template
                </VBtn>
            </VCol>
        </div>
        <VBtn
            depressed
            color="primary"
            @click="history = []" v-if="history.length"
            class="mb-4"
        >
            Clear History
        </VBtn>
        <h3 v-if="history.length">History</h3>
        <VRow>
            <VCol cols="12">
                <VAlert
                    transition="scroll-y-transition"
                    border="right"
                    colored-border
                    :type="item.type"
                    elevation="2"
                    v-for="(item, index) in reverseHistory"
                    :key="index"
                >
                    <span v-html="item.msg"></span>
                </VAlert>
            </VCol>
        </VRow>

    </div>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/platforms/types/actions';
import notificationMixin from '@/mixins/notificationMixin';
import { pusher } from '@/services/pusher/pusherService';
export default {
    name: 'ImportComponent',
    mixins: [notificationMixin],
    data: () => ({
        importRules: [
            v => (v && v.type === 'text/csv') || 'File CSV is required'
        ],
        fileTable: [],
        uploadLoading: false,
        history: [],
    }),
    methods: {
        ...mapActions('platforms', {
            importPlatforms: actions.IMPORT_PLATFORMS,
            downloadImportFile: actions.DOWNLOAD_IMPORT_FILE_TEMPLATE
        }),
        async onUpload() {
            if (this.$refs.file_input.validate()) {
                try {
                    this.uploadLoading = true;
                    const formData = new FormData();
                    formData.append('platforms_table', this.fileTable);
                    await this.importPlatforms(formData);
                    this.history.push({
                        msg: "Import platforms process started! Don't leave the page!",
                        type: 'success'
                    });
                    this.uploadLoading = false;
                } catch (error) {
                    this.history.push({
                        msg: error,
                        type: 'error'
                    });
                    this.uploadLoading = false;
                }
            }
        },
        async downloadFile() {
            await this.downloadImportFile();
        }
    },
    async created() {
        const channel = pusher.subscribe('platform-import');
        channel.bind('platform-import-created', (data) => {
            this.history.push({
                msg: data.message,
                type: data.type
            });
        });
    },
    beforeDestroy() {
        pusher.unsubscribe('platform-import');
    },
    computed: {
        reverseHistory() {
            return this.history.slice().reverse();
        }
    }
}
</script>

<style scoped>

</style>