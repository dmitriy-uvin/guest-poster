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
                        @click="onSaveName"
                    >
                        Save
                    </VBtn>
                    <VBtn
                        color="#eaf3ff"
                        @click="showDialog = false"
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
import { validationMixin } from 'vuelidate';
import { required } from 'vuelidate/lib/validators';
export default {
    name: 'SaveFilterNameDialog',
    props: {
        visibility: {
            required: true
        }
    },
    validations: {
        name: { required }
    },
    mixins: [validationMixin],
    data: () => ({
       name: ''
    }),
    methods: {
        onSaveName() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                try {
                    this.$emit('save-name', this.name);
                    this.name = '';
                    this.$v.$reset();
                    this.showDialog = false;
                } catch(error) {
                    this.showDialog = true;
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