<template>
    <VDialog
        v-model="showDialog"
        max-width="500px"
    >
        <VCard class="pt-3">
            <VCardText>
                <VCol cols="12">
                    <VTextField
                        outlined
                        label="Filter name"
                        v-model="name"
                        :hide-details="!nameErrors.length"
                        :error-messages="nameErrors"
                    />
                </VCol>
                <VContainer>
                    <VBtn
                        color="primary"
                        depressed
                        class="mr-3"
                        @click="onRenameClick"
                    >
                        Rename
                    </VBtn>
                    <VBtn
                        color="#eaf3ff"
                        @click="onCancelClick"
                        depressed
                    >
                        <span style="color: #2f80ed">Cancel</span>
                    </VBtn>
                </VContainer>
            </VCardText>
        </VCard>
    </VDialog>
</template>

<script>
import { mapActions } from 'vuex';
import * as actions from '@/store/modules/filter/types/actions';
import { validationMixin } from 'vuelidate';
import { required } from 'vuelidate/lib/validators';
import notificationMixin from '@/mixins/notificationMixin';
export default {
    name: 'RenameFilterNameDialog',
    props: {
        visibility: {
            required: true
        },
        filter: {
            required: true
        }
    },
    data: () => ({
        name: ''
    }),
    created() {
        this.name = this.filter.name;
    },
    validations: {
        name: { required }
    },
    mixins: [validationMixin, notificationMixin],
    methods: {
        ...mapActions('filter', {
            renameUserFilter: actions.RENAME_USER_FILTER
        }),
        onCancelClick() {
            this.showDialog = false;
            this.name = '';
            this.$v.$reset();
        },
        async onRenameClick() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    await this.renameUserFilter({
                        id: this.filter.id,
                        name: this.name
                    });
                    this.setNotification({
                        type: 'success',
                        message: 'Filter was renamed!'
                    });
                    this.showDialog = false;
                    this.$v.$reset();
                } catch (error) {
                    this.setNotification({
                        type: 'error',
                        message: error
                    });
                }
            }
        }
    },
    computed: {
        showDialog: {
            get() {
                return this.visibility;
            },
            set(value) {
                if (!value) {
                    this.$emit('close-dialog');
                }
            }
        },
        nameErrors() {
            const errors = [];
            if (!this.$v.name.$dirty) {
                return errors;
            }
            !this.$v.name.required &&
            errors.push('Name is required!');
            return errors;
        }
    }
}
</script>

<style scoped>

</style>